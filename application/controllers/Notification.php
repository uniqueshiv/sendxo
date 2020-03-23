<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {
	
	public function __construct() {
        parent::__construct();

        $this->load->model('language');
        $this->load->model('themes');
        $this->load->model('backgrounds');
	    $this->load->model('socials');
        $this->load->model('users');
        $this->load->model('notifications');

        // Load the helpers
        $this->load->helper('language');
        $this->load->helper('url');

        // Load Auth library
        $this->load->library('session');
    }

    /**
     * Menyediakan informasi notifikasi baru untuk user yang login.
     * User_model->get_last_notif() mengembalikan id notifikasi lama, sehingga notifikasi baru
     * di dapat jika ada id yang lebih besar dari last_notif.
     *
     * Fungsi ini dipanggil secara berkala via AJAX.
     * @return json [array notifikasi]
     */
    public function index() {
        $notif_all = $allnotification = "";
        if(! empty($this->session->droppy_premium)){
            $notif_all = $this->notifications->getByUserID($this->session->droppy_premium, false);
            $allnotification = $this->notifications->getAllNotificationsById($this->session->droppy_premium);
        }

        $data = array(
            'settings'    => $this->config->config,
            'socials'       => $this->socials->getAll(),
            'language_list' => $this->language->getAll(),
             'backgrounds' => $this->backgrounds->getAllOrderID(),
             'noad'        => true,
             'notifications' => $notif_all,
            'allnotifications' => $allnotification
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

        $this->notifications->updateStatusByUserId($this->session->droppy_premium);
        
	    $this->load->view('themes/' . $this->config->item('theme') . '/_elem/header', $data);
        $this->load->view('themes/' . $this->config->item('theme') . '/notification', $data);
        $this->load->view('themes/' . $this->config->item('theme') . '/_elem/footer', $data);

        

    } 

    public function create() {
        // if ("POST" === $this->input->server('REQUEST_METHOD')) {
        //     $this->Notification_model->create();
        // }
    }
}