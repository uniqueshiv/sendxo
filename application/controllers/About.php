<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property users $users
 * @property  authlib $authlib
 */
class About extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        // Load some external models
        $this->load->model('language');
        $this->load->model('themes');
        $this->load->model('backgrounds');
	    $this->load->model('socials');
        $this->load->model('users');
        $this->load->model('notifications');

        // Load the helpers
        $this->load->helper('language');
        $this->load->helper('url');

        $this->load->library('AuthLib');
        $this->load->library('session');
    }

    /**
     *
     */
 
    public function index()
    {
        $notif_all = "";
        if(! empty($this->session->droppy_premium)){
            $notif_all = $this->notifications->getByUserID($this->session->droppy_premium, false);
        }

        $data = array(
            'settings'    => $this->config->config,
		   'socials'       => $this->socials->getAll(),
		   'language_list' => $this->language->getAll(),
            'backgrounds' => $this->backgrounds->getAllOrderID(),
            'noad'        => true,
            'notifications' => $notif_all
        );

        if(isset($_POST) && !empty($_POST)) {
            if($this->authlib->authUser($this->input->post())) {
                redirect('/');
            }
            else
            {
                $data['result'] = false;
            }
        }
	$this->load->view('themes/' . $this->config->item('theme') . '/_elem/header', $data);
        $this->load->view('themes/' . $this->config->item('theme') . '/about', $data);

        $this->load->view('themes/' . $this->config->item('theme') . '/_elem/footer', $data);
    }

}
