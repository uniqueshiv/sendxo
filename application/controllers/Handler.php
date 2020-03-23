<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property receivers $receivers
 * @property downloads $downloads
 * @property completehandler $completehandler
 */
class Handler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }

    /**
     * Return translation items in json
     */
    public function getJsTranslation()
    {
        $this->lang->load('main_lang', $this->session->userdata('language'));

        $translation = array(
            'download_started'  => $this->lang->line('download_started'),
            'fill_fields'       => $this->lang->line('fill_fields'),
            'upload_error'      => $this->lang->line('upload_error'),
            'wrong_pass'        => $this->lang->line('wrong_pass'),
            'file_blocked'      => $this->lang->line('file_blocked'),
            'max_files'         => $this->lang->line('max_files'),
            'copy_url'          => $this->lang->line('copy_url'),
            'seconds'           => $this->lang->line('msg_seconds'),
            'minutes'           => $this->lang->line('msg_minutes'),
            'hours'             => $this->lang->line('msg_hours'),
            'remaining'         => $this->lang->line('msg_remaining'),
            'uploaded_of'       => $this->lang->line('uploaded_of'),
            'are_sure'          => $this->lang->line('are_you_sure'),
            'too_large'         => $this->lang->line('file_too_large'),
            'message_sent'      => $this->lang->line('message_sent'),
            'invalid_email'     => $this->lang->line('invalid_email')
        );

        echo json_encode($translation);
    }

    public function acceptterms() {
        $this->load->helper('cookie');
        $this->load->helper('url');

        $return_url = $this->input->get('url');

        set_cookie('terms', 'true', time() + 31556926);

        // Return OK
        redirect(urldecode($return_url));
    }

    /**
     * Change language function
     */
    public function changeLanguage()
    {
        $this->load->helper('url');
        $this->load->library('session');

        // Get the requested language from the POST
        $language = strtolower($this->uri->segment(3));

        // Store the requested language in the session
        $this->session->set_userdata('language', $language);

        // Return OK
        redirect($this->config->item('site_url'));
    }

    /**
     * Process download request
     */
    public function download()
    {
        $this->load->model('uploads');
        $this->load->model('receivers');
        $this->load->model('files');
        $this->load->model('downloads');

        $this->load->helper('download');
        $this->load->helper('string');

        $this->load->library('UploadLib');
        $this->load->library('session');

        // Post data
        $post = $this->input->post(NULL, TRUE);


        // Check if there's any id provided
        if(!empty($post['download_id'])) {
            $download_id = $post['download_id'];

            // Retrieve download info
            $download = (array) $this->uploads->getByUploadID($download_id);

            // Check if download exists and is active
            if($download !== false && $download['status'] == 'ready') {
                $receiver['email'] = '';
                if($download['share'] == 'mail') {
                    $receiver = (array) $this->receivers->getByUploadAndPrivateID($post['download_id'], $post['private_id']);
                }

                // Check if allowed to download
                if($download['share'] == 'link' || ($download['share'] == 'mail' && (isset($receiver['upload_id']) || $post['private_id'] == $download['secret_code']))) {
                    // Check password entered correctly (If password is set)
                    if(empty($download['password']) || (!empty($download['password']) && (md5($post['password']) == $download['password'] || password_verify($post['password'], $download['password'])))) {
                        // If upload was uploaded with share method mail
                        // And if email hasn't been sent yet
                        if ($download['share'] == 'mail' && !$this->receivers->checkAlreadyDownloaded($download['upload_id'], $receiver['private_id'])) {
                            // Load email library
                            $this->load->library('email');

                            // Send email to uploader

                            //print_r($this->email);
                            // $this->email->sendEmail('downloaded', array('upload_id' => $post['download_id'], 'download_email' => $receiver['email']), array($download['email_from']), $download['lang']);
                        }

                        // Log the download
                        $this->downloads->insert(array(
                            'download_id' => $download['upload_id'],
                            'time' => time(),
                            'ip' => $this->input->ip_address(),
                            'email' => $receiver['email']
                        ));

                        if(! empty($this->session->droppy_premium)){
                            $this->load->model('notifications');
                            $data = array(
                                "user_id" => $this->session->droppy_premium,
                                "title"   =>  "File downloaded successfull "
                            );
                            $this->notifications->create($data);
                        }
                

                        // Check if upload destruction was enabled
                        if(strtoupper($download['destruct']) == 'YES') {
                            $total_downloads  = $this->downloads->getTotalByUploadID($download_id);
                            $total_recipients = count($this->receivers->getByUploadID($download_id));

                            // Check if the total downloads meets the total recipients count
                            if($total_downloads >= $total_recipients) {
                                $this->uploadlib->markDelete($download_id);
                            }
                        }

                        // Load the plugin library
                        $this->load->library('plugin');

                        $upload_dir = $this->config->item('upload_dir');
                        if ($download['count'] > 1) {
                            $filename = $this->config->item('name_on_file') . '-' . $download['upload_id'] . '.zip';

                            $file_path = FCPATH . $upload_dir . $filename;

                            // ZIP

                            // Check if there's any "upload" plugin installed
                            if($this->plugin->pluginLoaded('upload')) {
                                $upload_plugin = $this->plugin->_plugins['upload'];

                                // Include the plugin library and init it.
                                require_once $this->plugin->_pluginDir . $upload_plugin['load'] . '/' . $upload_plugin['handler_library'];

                                $handlerLibrary = new HandlerLibrary();

                                // Download the file from the external source
                                $handlerLibrary->download($download_id, $filename, $filename, $download['encrypt'], $download['size']);
                            }
                            elseif(!empty($download['encrypt']))
                            {
                                $this->load->library('CompleteHandler');

                                force_download($filename, $file_path, false, true, $download['encrypt'], $download['size']);
                            }
                            else
                            {
                                force_download($filename, $file_path);
                            }
                        } else {
                            $file = $this->files->getByUploadID($download['upload_id']);

                            $file_path = FCPATH . $upload_dir . $file[0]['secret_code'] . '-' . $file[0]['file'];

                            // Single file

                            // Check if there's any "upload" plugin installed
                            if($this->plugin->pluginLoaded('upload')) {
                                $upload_plugin = $this->plugin->_plugins['upload'];

                                // Include the plugin library and init it.
                                require_once $this->plugin->_pluginDir . $upload_plugin['load'] . '/' . $upload_plugin['handler_library'];

                                $handlerLibrary = new HandlerLibrary();

                                // Download the file from the external source
                                $handlerLibrary->download($download_id, $file[0]['file'], $file[0]['secret_code'] . '-' . $file[0]['file'], $download['encrypt'], $download['size']);
                                if(! empty($this->session->droppy_premium)){
                                    $this->load->model('notifications');
                                    $data = array(
                                        "user_id" => $this->session->droppy_premium,
                                        "title"   =>  "File ".$file[0]['file']."download successfull",
                                    );
                                    $this->notifications->create($data);
                                }
                            }
                            elseif(!empty($download['encrypt'])) {
                                $this->load->library('CompleteHandler');

                                force_download($file[0]['file'], $file_path, false, true, $download['encrypt'], $download['size']);
                            }
                            else
                            {
                                force_download($file[0]['file'], $file_path);
                            }
                        }
                    }
                    else
                    {
                        header('Location: '.urldecode($_POST['url']) . '?error=wrong_pass');
                    }
                }
            }
        }
    }

    public function renameFile(){
        $this->load->model('rename');
        $data = $this->input->post();
        if(isset($data['data']['updated_file']) && !empty($data['data']['updated_file']) && !empty($data['data']['download_id'])){
            $query = $this->rename->add($data['data']['download_id'], $data['data']['updated_file']);
            if($query){
                print_r(array('message'=>"successfully rename file!"));
            }else{
                print_r(array("message" =>"something error!"));
            }
        }
    }

    public function contact() {
        $this->load->library('email');
        $this->load->helper('recaptcha');

        // Post data
        $post = $this->input->post(NULL, TRUE);

        if(!empty($post['contact_email']) && !empty($post['contact_subject']) && !empty($post['contact_message'])) {
            if(empty($this->config->item('recaptcha_secret')) || validate_recaptcha($post['g-recaptcha-response'], $this->config->item('recaptcha_secret'))) {
                $this->email->reply_to($post['contact_email']);
                $this->email->sendEmailClean(nl2br(htmlspecialchars($post['contact_message'])), 'Contact: ' . $post['contact_subject'], array($this->config->item('contact_email')));

                echo json_encode(array('result' => 'success'));
                exit;
            }
            echo json_encode(array('result' => 'recaptcha'));
            exit;
        }
        echo json_encode(array('result' => 'fields'));
        exit;
    }
}