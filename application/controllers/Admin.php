<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin
 * @property  adminlib $adminlib
 * @property  downloads $downloads
 * @property  language $language
 * @property  templates $templates
 * @property  socials $socials
 * @property  backgrounds $backgrounds
 * @property  uploadlib $uploadlib
 * @property  users $users
 * @property  logs $logs
 * @property  themes $themes
 * @property  updates $updates
 */
class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        // Load some external models
        $this->load->model('language');
        $this->load->model('uploads');
        $this->load->model('downloads');
        $this->load->model('templates');

        $this->load->library('plugin');
        $this->load->library('AdminLib');
        $this->load->library('session');

        if($this->uri->segment(2) != 'login') {
            $this->adminlib->authenticated();
        }
    }

    public function index()
    {
        // Data to pass to the views
        $data = array(
            'settings'  => $this->config->config,
            'stats'     => array(
                'total_uploads' => $this->uploads->getTotal(),
                'total_uploads_active' => $this->uploads->getTotal('ready'),
                'total_uploads_destroyed' => $this->uploads->getTotal('destroyed'),
                'total_downloads' => $this->downloads->getTotal(),
                'last_upload' => $this->uploads->getLastUpload(),
                'most_downloaded' => $this->downloads->getMostDownloaded(),
                'total_size' => $this->adminlib->getDiskUsage()
            )
        );

        // Load the language helper
        $this->load->helper('language');

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/home', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    public function login()
    {
        $data = array(
            'settings'  => $this->config->config
        );

        // If form is being submitted
        if(isset($_POST) && !empty($_POST)) {
            if($this->adminlib->authenticate($this->input->post('email'), $this->input->post('password'))) {
                header('Location: '.$this->config->item('site_url') . 'admin/index');
                exit;
            }
            else
            {
                $data['login'] = false;
            }
        }

        $this->load->view('admin/login', $data);
    }

    public function logout()
    {
        $this->adminlib->logout();

        $this->load->helper('url');

        header('Location: '.$this->config->item('site_url') . 'admin/index');
        exit;
    }

    public function uploads()
    {
        $this->load->library('UploadLib');
        $this->load->helper('url');

        // Handle the delete function
        if($this->uri->segment(5) == 'delete') {
            // Deleting the upload by upload ID
            $this->uploadlib->deleteUpload($this->uri->segment(6));
            header('Location: '.$this->config->item('site_url') . 'admin/uploads');
        }

        // Get the page number
        $page = $this->uri->segment(4);
        if(empty($page)) {
            $page = 0;
        }
        $start = ($page * 20);

        $data = array(
            'settings'      => $this->config->config,
            'page'          => $page,
            'total_uploads' => $this->uploads->getTotal(),
            'uploads'       => $this->uploads->getAll($start, 20),
            'file_status'   => array(
                'ready'         => '<i class="fa fa-check"></i> Ready',
                'destroyed'     => '<i class="fa fa-times"></i> Destroyed',
                'processing'    => '<i class="fa fa-refresh"></i> Processing',
                'inactive'      => '<i class="fa fa-ban"></i> Inactive (Will be destroyed soon)',
            )
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/uploads', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    public function downloads()
    {
        // Get the page number
        $page = $this->uri->segment(4);
        if(empty($page) || $this->uri->segment(3) != 'page') {
            $page = 0;
        }
        $start = ($page * 20);

        // View data
        $data = array(
            'settings'  => $this->config->config,
            'page'      => $page,
            'total'     => $this->downloads->getTotal(),
            'downloads' => $this->downloads->getAll($start, 20)
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/downloads', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    public function users()
    {
        $this->load->model('users');
        $this->load->helper('url');

        // POST processing
        if($this->input->post('action') == 'edit_user') {
            $form_data['email']       = $this->input->post('email');
            $form_data['password']    = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            // Update user by ID
            $this->users->updateByID($form_data, $this->input->post('id'));

            header('Location: '.$this->config->item('site_url') . 'admin/users');
        }
        elseif($this->input->post('action') == 'add_user') {
            $form_data['email']       = $this->input->post('email');
            $form_data['password']    = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $this->users->add($form_data);

            header('Location: '.$this->config->item('site_url') . 'admin/users');
        }
        if($this->uri->segment(5) == 'delete') {
            $this->users->deleteByID($this->uri->segment(6));
        }

        // Get the page number
        $page = $this->uri->segment(4);
        if(empty($page) || $this->uri->segment(3) != 'page') {
            $page = 0;
        }
        $start = ($page * 20);

        // View data
        $data = array(
            'settings'  => $this->config->config,
            'page'      => $page,
            'total'     => $this->users->getTotal(),
            'users'     => $this->users->getAll($start, 20)
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        if($this->uri->segment(3) == 'edit') {
            $data['user'] = $this->users->getByID($this->uri->segment(4));
            $this->load->view('admin/edituser', $data);
        } elseif($this->uri->segment(3) == 'add') {
            $this->load->view('admin/adduser', $data);
        } else {
            $this->load->view('admin/users', $data);
        }

        $this->load->view('admin/_elem/footer', $data);
    }

    public function address(){
        $this->load->model('address');
        $this->load->helper('url');

        // POST processing
        if($this->input->post('action') == 'edit_user') {
            $form_data['email']       = $this->input->post('email');
           
            // Update user by ID
            $this->address->updateByID($form_data, $this->input->post('id'));

            header('Location: '.$this->config->item('site_url') . 'admin/address');
        }
        elseif($this->input->post('action') == 'add_user') {
            $form_data['email']       = $this->input->post('email');

            $this->address->add($this->input->post('email'));

            header('Location: '.$this->config->item('site_url') . 'admin/address');
        }
        if($this->uri->segment(5) == 'delete') {
            $this->address->deleteByID($this->uri->segment(6));
        }

        // Get the page number
        $page = $this->uri->segment(4);
        if(empty($page) || $this->uri->segment(3) != 'page') {
            $page = 0;
        }
        $start = ($page * 20);

        // View data
        $data = array(
            'settings'  => $this->config->config,
            'page'      => $page,
            'total'     => $this->address->getTotal(),
            'users'     => $this->address->getAll($start, 20)
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        if($this->uri->segment(3) == 'edit') {
            $data['user'] = $this->address->getByID($this->uri->segment(4));
            $this->load->view('admin/editaddress', $data);
        } elseif($this->uri->segment(3) == 'add') {
            $this->load->view('admin/addaddress', $data);
        } else {
            $this->load->view('admin/address', $data);
        }

        $this->load->view('admin/_elem/footer', $data);
    }

    public function backgrounds()
    {
        $this->load->model('backgrounds');

        // Handle the POST action
        if(isset($_POST)) {
            if($this->input->post('add') == 1) {
                $this->adminlib->addBackground($_FILES['file'], $_POST);
            }
        }

        // Handle the delete function
        if($this->uri->segment(3) == 'delete') {
            $this->adminlib->deleteBackground($this->uri->segment(4));
        }

        // Data to be sent to the view
        $data = array(
            'settings'      => $this->config->config,
            'backgrounds'   => $this->backgrounds->getAll()
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/backgrounds', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    public function settings()
    {
        // Load models
        $this->load->model('settings');

        // Get the current page
        $page = $this->uri->segment(3);

        // Just set page to general if it's empty
        if(empty($page)) {
           $page = 'general';
        }

        // Check if a post is being sent
        if(isset($_POST)) {
            if($this->input->post('save') == 1)
            {
                // Start saving data from the page
                $this->adminlib->save($page, $_POST);
            }
        }

        // Data to be passed to the views
        $data = array(
            'settings' => $this->settings->getAll()[0]
        );

        // Init data extra array
        $data_extra = array();

        // Load extra data for specific pages
        switch($page) {
            case 'mailtemplates':
                $data_extra = array(
                    'languages' => $this->language->getAll(),
                    'templates' => $this->templates
                );
            break;
            case 'social':
                $this->load->model('socials');

                $data_extra = array(
                    'social' => $this->socials->getAll()
                );
            break;
            case 'language':
                if($this->uri->segment(4) == 'delete') {
                    $this->language->delete($this->uri->segment(5));
                }
                elseif($this->uri->segment(4) == 'default') {
                    $this->language->makedefault($this->uri->segment(5));
                }

                $data_extra = array(
                    'settings' => $this->settings->getAll()[0],
                    'languages' => $this->language->getAll()
                );
            break;
        }

        // Merge all data together
        $data = array_merge($data, $data_extra);

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/settings/' . $page, $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    public function themes()
    {
        $this->load->model('themes');
        $this->load->helper('url');

        // Process POST
        if(isset($_POST) && !empty($_POST)) {
            $this->adminlib->addTheme($this->input->post());
        }

        // Different actions
        if($this->uri->segment(3) != '') {
            $this->adminlib->themeAction($this->uri->segment(3), $this->uri->segment(4));
        }

        // View data
        $data = array(
            'settings'  => $this->config->config,
            'themes'    => $this->themes->getAll()
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/themes', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    public function plugins()
    {
        $this->load->library('plugin');

        $data = array(
            'settings'  => $this->config->config,
            'plugins'   => $this->plugin->_plugins
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/plugins', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    public function system()
    {
        $this->load->helper('url');
        $this->load->model('updates');

        if(isset($_POST['action'])) {
            if($_POST['action'] == 'update') {
                if($this->adminlib->runUpdate($_POST)) {
                    header('Location: '.$this->config->item('site_url') . 'admin/system');
                }
            }
            elseif($_POST['action'] == 'manual_update') {
                $data = array(
                    "purchase_code" => $_POST['purchase_code'],
                    "ip" => $_SERVER['SERVER_ADDR']
                );

                header('Location: '.json_decode($this->adminlib->callProxibolt('update', $data))->url);
            }
        }

        $data = array(
            'settings'       => $this->config->config,
            'latest_version' => json_decode($this->adminlib->callProxibolt('version')),
            'pb_message'     => json_decode($this->adminlib->callProxibolt('message')),
            'updates'        => $this->updates->getAll('0', '5')
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/system', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    public function update()
    {
        if(!$this->adminlib->isUpToDate())
        {
            $this->adminlib->runUpdateFiles();

            echo 'Update finished';
        }
        else
        {
            echo 'System is already on the latest version';
        }
    }

    public function logs()
    {
        $this->load->model('logs');

        // Get the page number
        $page = $this->uri->segment(4);
        if(empty($page) || $this->uri->segment(3) != 'page') {
            $page = 0;
        }
        $start = ($page * 20);

        // View data
        $data = array(
            'settings'  => $this->config->config,
            'page'      => $page,
            'total'     => $this->logs->getTotal(),
            'logs'      => $this->logs->getAll($start, 20)
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/logs', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    /**
     *
     */
    function personal()
    {
        $this->load->model('accounts');

        if(isset($_POST)) {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            $this->accounts->updateByID($data, $this->input->post('id'));
        }

        // View data
        $data = array(
            'settings'  => $this->config->config,
            'account' => $this->accounts->getByID($this->session->userdata('admin_id'))
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        $this->load->view('admin/personal', $data);

        $this->load->view('admin/_elem/footer', $data);
    }

    function pluginpage() {
        $this->load->helper('url');
        $this->load->helper('sql');

        // Get the page number
        $page = $this->uri->segment(3);

        $data = array(
            'settings'       => $this->config->config
        );

        // Loading views
        $this->load->view('admin/_elem/header', $data);
        $this->load->view('admin/_elem/navbar', $data);
        $this->load->view('admin/_elem/sidebar', $data);

        if(isset($this->plugin->_adminpages[$page])) {
            //require_once dirname(__FILE__) . '/../plugins/' . $this->plugin->_adminpages[$page]['load'] . '/' . $this->plugin->_adminpages[$page]['view'] . '.php';
            $this->load->view('../plugins/' . $this->plugin->_adminpages[$page]['load'] . '/' . $this->plugin->_adminpages[$page]['view'], $data);
        }

        $this->load->view('admin/_elem/footer', $data);
    }
}
