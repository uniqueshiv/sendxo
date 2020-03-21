<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property completehandler $completehandler
 */
class Upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('uploads');
        $this->load->model('files');
    }

    /**
     * Index action
     */
    function index()
    {
        if(!isset($_POST) || empty($_POST)) {
            header('Location: '.$this->config->item('site_url'));
            exit;
        }

        // Get all settings from the DB
        $settings = $this->config->config;

       
        // Get upload ID from post
        $upload_id  = $this->input->post('upload_id');
        $file_uid   = $this->input->post('file_uid');

        // Define upload settings
        $config['upload_path']          = FCPATH . $settings['upload_dir'] . 'temp/';
        $config['blocked_file_types']   = $settings['blocked_types'];
        $config['max_file_size']        = ($settings['max_size'] * 1024 * 1024);
        $config['max_number_of_files']  = $settings['max_files'];
        $config['upload_id']            = $upload_id;
        $config['file_id']              = md5($file_uid);

        // Init the upload library
        $this->load->library("UploadHandler", $config);

        // Process the upload and fetch a response
        $upload_response = $this->uploadhandler->get_response();
//  print_r($this->input->post());
       
        // Store upload in droppy_files table
        if (is_array($upload_response)) {
            // Check each uploaded file
            foreach ($upload_response['files'] as $file) {
                if(isset($file->url) && !empty($file->url)) {
                    // Add file to the database
                    $this->files->add($upload_id, $config['file_id'], $file->name, $file->size);
                }
            }
        }
        exit;
    }

    /**
     * Register the upload
     */
    function register()
    {
        $this->load->model('receivers');
        $this->load->model('address');

        $post_data = $this->input->post(NULL, TRUE);
        $post_data['language'] = (!empty($this->session->userdata('language')) ? $this->session->userdata('language') : $this->config->item('language'));

        if(!empty($post_data['password'])) {
            $post_data['password'] = password_hash($post_data['password'], PASSWORD_DEFAULT);
        }

        $error = false;

        // Do some form validation before accepting the new upload
        if(!empty($post_data['share']) && !empty($post_data['destruct']))
        {
            if ($post_data['share'] == 'mail')
            {
                if(!empty($post_data['email_from']) && count($post_data['email_to']) > 0 && !empty($post_data['email_to'][0]))
                {
                    foreach ($post_data['email_to'] as $email)
                    {
                        $this->receivers->add($post_data['upload_id'], $email, md5(time() . rand() . rand()));
                    }
                }
                else
                {
                    $error = true;
                }
            }

        }
        else
        {
            $error = true;
        }

        // Return ok or not ok based on results
        if(!$error)
        {
           
            $this->uploads->register($post_data);
            $this->address->add($post_data['email_to'][0]);
            echo json_encode(array('response' => 'ok'));
        }
        else
        {
            echo json_encode(array('response' => 'fields'));
        }
    }

    /**
     * Upload complete action
     */
    function complete()
    {
        // Load upload complete handler
        $this->load->library('CompleteHandler');

        // Fetch post data
        $post_data = $this->input->post(NULL, TRUE);

        $files = $this->files->getByUploadID($post_data['upload_id']);

        $post_data['total_files'] = 0;
        $post_data['total_size'] = 0;
        foreach ($files as $file) {
            $post_data['total_files']++;
            $post_data['total_size'] += $file['size'];
        }

        // Complete the upload
        if($this->completehandler->complete($post_data)) {
            $this->uploads->complete($post_data);
        }
    }

    /**
     * Generates new upload ID
     */
    function genid()
    {
        // Generate upload ID
        $upload_id = $this->uploads->genUploadID();
        // Store the upload ID in a session
        $this->session->set_userdata('upload_id', $upload_id);

        // Output the upload ID
        echo json_encode(array('upload_id' => $upload_id));
    }
	
	/***
	* Delete Uploaded file by WEBNINJAZ 16 MARCH 2020
	*/
	function deletefile($uploadedid){
		if(!empty($uploadedid)){
			$delete = $this->uploads->deletefile($uploadedid);
			if($delete){
				header('Location: '.$this->config->item('site_url').'login');
				exit;
			}
		} 
		
	}
	
}