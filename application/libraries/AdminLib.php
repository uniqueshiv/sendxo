<?php

/**
 * Class AdminLib
 */
class AdminLib
{
    /**
     * @var CI_Controller
     */
    protected $CI;

    /**
     * AdminLib constructor.
     */
    public function __construct() {
        $this->CI =& get_instance();

        $this->CI->load->model('uploads');
    }

    /**
     * Returns the total disk usage used in MB
     *
     * @return float
     */
    public function getDiskUsage() {
        $total = $this->CI->uploads->getTotalStorageUsed();

        return round($total / 1048576, 2);
    }

    /**
     * Authenticate the user
     * @param $email
     * @param $password
     * @return bool
     */
    public function authenticate($email, $password) {
        $this->CI->load->model('accounts');

        // If login correct
        $check = $this->CI->accounts->login($email);
        if(is_array($check)) {
            if(password_verify($password, $check['password']))
            {
                // Start creating a session
                $this->CI->load->library('session');

                // Session data to be set
                $session_data = array(
                    'admin' => TRUE,
                    'admin_id' => $check['id'],
                    'admin_email' => $email
                );

                $this->CI->session->set_userdata($session_data);

                // Session created, return data.
                return true;
            }
        }
        return false;
    }

    /**
     * Save entered settings
     *
     * @param $page
     * @param $data
     */
    public function save($page, $data) {
        unset($data['save']);

        switch($page) {
            case 'general':
            case 'termsabout':
            case 'advertising':
            case 'contact':
                $this->CI->load->model('settings');
                $this->CI->settings->save($data);
            break;
            case 'mail':
                if(empty($data['smtp_password'])) {
                    unset($data['smtp_password']);
                }

                $this->CI->load->model('settings');
                $this->CI->settings->save($data);
            break;
            case 'social':
                $this->CI->load->model('socials');
                $this->CI->socials->save($data);
            break;
            case 'mailtemplates':
                $this->CI->load->model('templates');
                $this->CI->templates->save($data);
            break;
            case 'language':
                $this->CI->load->model('Language');
                $this->CI->language->save($data);
            break;
        }
    }

    public function pageAction() {

    }

    /**
     * Add new background
     *
     * @param $file
     * @param $data
     * @return bool
     */
    public function addBackground($file, $data) {
        $this->CI->load->model('backgrounds');

        if(move_uploaded_file($file['tmp_name'], FCPATH . 'assets/backgrounds/' . $file['name'])) {
            $data = array(
                'src' => 'assets/backgrounds/' . $file['name'],
                'url' => $data['url'],
                'duration' => $data['duration']
            );

            if($this->CI->backgrounds->add($data)) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Delete existing background
     *
     * @param $id
     */
    public function deleteBackground($id) {
        $this->CI->load->model('backgrounds');

        $background = $this->CI->backgrounds->getByID($id);
        if(!empty($background)) {
            if(file_exists(FCPATH . $background->src))
            {
                unlink(FCPATH . $background->src);
            }
            $this->CI->backgrounds->delete($id);
        }
    }

    /**
     * Add new theme
     *
     * @param $data
     * @return bool
     */
    public function addTheme($data) {
        $this->CI->load->model('themes');

        $data['status'] = 'stopped';

        if($this->CI->themes->add($data)) {
            return true;
        }
        return false;
    }

    /**
     * Perform theme actions based on action
     *
     * @param $action
     * @param $value
     * @return bool
     */
    public function themeAction($action, $value) {
        $this->CI->load->model('themes');

        switch ($action) {
            case 'activate':
                $this->CI->themes->updateAll(array('status' => 'stopped'));
                $this->CI->themes->updateByID(array('status' => 'ready'), $value);
            break;
            case 'suspend':
                $this->CI->themes->updateByID(array('status' => 'stopped'), $value);
            break;
            case 'delete':
                $this->CI->themes->deleteByID($value);
            break;
        }

        return true;
    }

    /**
     * Check if the user is authenticated
     *
     * @return bool
     */
    public function authenticated() {
        $this->CI->load->model('settings');

        // If isn't authenticated
        if(!$this->CI->session->userdata('admin')) {
            $redirect = $this->CI->settings->getAll()[0]['site_url'] . 'admin/login';
            header('Location: '.$redirect);
            die();
        }
        return false;
    }

    /**
     * Logout the admin user
     */
    public function logout() {
        $unset = array('admin', 'admin_email');

        $this->CI->session->unset_userdata($unset);
    }

    /**
     * Send data to the Proxibolt API
     *
     * @param $type
     * @param array $data
     * @return bool|string
     */
    public function callProxibolt($type, $data = array()) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= $key . '=' . $value . '&';
        }
        rtrim($fields, '&');

        $ch = curl_init('https://api.proxibolt.com/droppy/' . $type);

        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        $content = curl_exec( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        return $content;
    }

    /**
     * Downloads the update file from the Proxibolt server
     *
     * @param $file_url
     * @return string
     */
    private function downloadUpdateFile($file_url) {
        $file_path = FCPATH . 'droppy_' . json_decode($this->callProxibolt('version'))->version . '.zip';
        $file = fopen($file_path, 'w');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file_url);
        // cURL options
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        // Set file handler option
        curl_setopt($ch, CURLOPT_FILE, $file);
        // Execute cURL
        curl_exec($ch);
        // Close cURL
        curl_close($ch);
        // Close file
        fclose($file);

        return $file_path;
    }

    /**
     * Runs the update
     *
     * @param $data
     * @return bool
     */
    public function runUpdate($data) {
        // Check if the system is out of date
        if(!$this->isUpToDate())
        {
            $data = array(
                "purchase_code" => $data['purchase_code'],
                "ip" => $_SERVER['SERVER_ADDR']
            );

            $return = json_decode($this->callProxibolt('update', $data));

            // Check if update request was successful
            if ($return->type == 'success')
            {
                // Download the update file from the Proxibolt server
                $update_file = $this->downloadUpdateFile($return->url);

                $zip = new ZipArchive;

                // Extract the update file
                if ($zip->open($update_file) === TRUE)
                {
                    $zip->extractTo(FCPATH);
                    $zip->close();
                }

                // Remove the downloaded zip file
                unlink($update_file);

                // Run the update files (If there are any)
                $this->runUpdateFiles();

                return TRUE;
            }
        }
        return false;
    }

    public function runUpdateFiles() {
        // Check if update provided any SQL file to run
        if (file_exists(FCPATH . 'update.sql'))
        {
            $sql = file_get_contents(FCPATH . 'update.sql');

            $query_array = explode(";", $sql);
            foreach ($query_array as $query)
            {
                if ( ! empty($query))
                {
                    $query = utf8_encode($query);
                    $this->CI->db->query($query);
                }
            }

            unlink(FCPATH . 'update.sql');
        }

        // Check if update library exists
        if(file_exists(APPPATH . 'libraries/UpdateLib.php')) {
            $this->CI->load->library('UpdateLib');
            $this->CI->updatelib->run();
        }
    }

    /**
     * Checks if Droppy is using the latest update
     *
     * @return bool
     */
    public function isUpToDate() {
        $cur_version = $this->CI->config->item('version');
        $api = json_decode($this->callProxibolt('version'));

        if(isset($api->version) && ($api->version > $cur_version)) {
            return false;
        }
        return true;
    }
}