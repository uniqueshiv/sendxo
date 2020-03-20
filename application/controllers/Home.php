<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property authlib $authlib
 */
class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        // Load some external models
        $this->load->model('language');
        $this->load->model('themes');
        $this->load->model('socials');
        $this->load->model('backgrounds');
        $this->load->model('rename');
        // Load the helpers
        $this->load->helper('language');
        $this->load->helper('url');

        // Load Auth library
        $this->load->library('AuthLib');
        $this->load->library('Plugin');
        $this->load->library('Mobile_Detect');
    }

    public function index()
    {
        $this->load->helper('cookie');

        if(!$this->authlib->pageAllowed('upload')) {
            redirect('/login');
        }

        // Data to pass through to views
        $data = array(
            'settings'      => $this->config->config,
            'socials'       => $this->socials->getAll(),
            'language_list' => $this->language->getAll(),
            'backgrounds'   => $this->backgrounds->getAllOrderID(),
            'custom_tabs'   => $this->plugin->_tabs,
            'mobile'        => false
        );

        // Mobile Detect library
        $detect = new Mobile_Detect();

        // Loading views
        if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS())
        {
            $data['mobile'] = true;
            $this->load->view('themes/' . $this->config->item('theme') . '/_elem/header-mobile', $data);
        }
        else
        {
            $this->load->view('themes/' . $this->config->item('theme') . '/_elem/header', $data);
        }
        $this->load->view('themes/' . $this->config->item('theme') . '/_elem/socials', $data);

        if($this->config->item('accept_terms') == 'yes' && empty(get_cookie('terms'))) {
            $this->load->view('themes/' . $this->config->item('theme') . '/terms', $data);
        }
        else
        {
            $this->load->view('themes/' . $this->config->item('theme') . '/upload', $data);
        }

        $this->load->view('themes/' . $this->config->item('theme') . '/_elem/modals', $data);
        $this->load->view('themes/' . $this->config->item('theme') . '/_elem/footer', $data);
    }

    public function download()
    {
        if(!$this->authlib->pageAllowed('download')) {
            redirect('/login');
        }

        // Load helpers
        $this->load->helper('cookie');

        // Load models
        $this->load->model('uploads');
        $this->load->model('files');
        $this->load->model('receivers');
        
        // Get upload id and unique id from URL
        $upload_id  = $this->uri->segment(1, 0);
        $unique_id  = $this->uri->segment(2, 0);

        // Fetch upload data based on download id
        $upload_data = $this->uploads->getByUploadID($upload_id);

        $data = array(
            'settings'    => $this->config->config,
            'socials'     => $this->socials->getAll(),
            'upload_id'   => $upload_id,
            'unique_id'   => $unique_id,
            'backgrounds' => $this->backgrounds->getAllOrderID(),
            'custom_tabs'   => $this->plugin->_tabs,
            'mobile'        => false
        );

        $allowed = false;

        // Check if there's any upload data returned
        if($upload_data) {
            $data['data'] = $upload_data;
            $data['files'] = $this->files->getByUploadID($upload_id);
            $data['renameFiles'] = $this->rename->getAllRenameData($upload_id);
            // Check if upload has share type mail
            if(isset($upload_data['share']) && $upload_data['share'] == 'mail') {
                // Share type is mail, check if unique ID exists
                if(!empty($unique_id) && (is_array($this->receivers->getByUploadAndPrivateID($upload_id, $unique_id)) || $upload_data['secret_code'] == $unique_id)) {
                    $allowed = true;
                }

                // Do not allow downloading file twice when the immediate file destruction is enabled
                if($upload_data['destruct'] == 'yes' && $this->receivers->checkAlreadyDownloaded($upload_id, $unique_id)) {
                    $allowed = false;
                }
            }
            else
            {
                $allowed = true;
            }

            // Download not allowed
            if(!$allowed) {
                unset($data['data']);
            }
        }

        // Mobile Detect library
        $detect = new Mobile_Detect();


        
        //echo $this->db->last_query();die();

        // Loading views
        if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS())
        {
            $data['mobile'] = true;
            $this->load->view('themes/' . $this->config->item('theme') . '/_elem/header-mobile', $data);
        }
        else
        {
            $this->load->view('themes/' . $this->config->item('theme') . '/_elem/header', $data);
        }
        $this->load->view('themes/' . $this->config->item('theme') . '/_elem/socials', $data);

        if($this->config->item('accept_terms') == 'yes' && empty(get_cookie('terms'))) {
            $this->load->view('themes/' . $this->config->item('theme') . '/terms', $data);
        }
        else
        {
            $this->load->view('themes/' . $this->config->item('theme') . '/download', $data);
        }

        $this->load->view('themes/' . $this->config->item('theme') . '/_elem/modals', $data);
        $this->load->view('themes/' . $this->config->item('theme') . '/_elem/footer', $data);
    }
}
