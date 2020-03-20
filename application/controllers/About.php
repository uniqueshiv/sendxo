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

        // Load the helpers
        $this->load->helper('language');
        $this->load->helper('url');

        $this->load->library('AuthLib');
    }

    /**
     *
     */
    public function index()
    {
        $data = array(
            'settings'    => $this->config->config,
		   'socials'       => $this->socials->getAll(),
		   'language_list' => $this->language->getAll(),
            'backgrounds' => $this->backgrounds->getAllOrderID(),
            'noad'        => true
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
