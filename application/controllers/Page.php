<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        // Load some helpers
        $this->load->helper('language');
        $this->load->helper('url');

        // Load some external models
        $this->load->library('session');
        $this->load->library('plugin');
        $this->load->library('email');
    }

    public function index()
    {
        $request = $this->uri->segment(2, 0);

        // Check if the requested page exists in the plugin page list
        if(isset($this->plugin->_pages[$request])) {
            $config = $this->plugin->_pages[$request];

            $data = array(
                'config' => $this->config->config
            );

            // Check if a POST has been sent
            if(isset($_POST) && !empty($_POST)) {
                require_once $this->plugin->_pluginDir . $config['load'] . '/' . $config['post_handler'];
                exit;
            }

            if(isset($_GET) && !empty($_GET)) {
                require_once $this->plugin->_pluginDir . $config['load'] . '/' . $config['get_handler'];
            }

            // Load the requested view from the plugin
            $this->load->view('../plugins/' . $config['load'] . '/' . $config['view'], $data);
        }


    }
}
	
?>
