<?php

/**
 * Uploads library
 *
 * @version 1.0
 * @author Proxibolt
 */
class UploadLib {
    private $CI;

    /**
     * Upload constructor.
     */
    function __construct()
    {
        $this->CI =& get_instance();
    }


    public function markDelete($upload_id)
    {
        $upload = $this->CI->uploads->getByUploadID($upload_id);

        if ($upload !== FALSE)
        {
            $new_time = (time() + 10800);

            $this->CI->uploads->updateStatusByUploadID('inactive', $upload_id);
            $this->CI->uploads->updateExpireTime($new_time, $upload_id);

            return true;
        }
        return false;
    }

    /**
     * Delete upload from storage and mark destroyed in database
     *
     * @param $upload_id
     * @return bool
     */
    public function deleteUpload($upload_id)
    {
        // Load models
        $this->CI->load->model('uploads');
        $this->CI->load->model('files');

        $this->CI->load->helper('file_helper');

        $upload = $this->CI->uploads->getByUploadID($upload_id);

        // Check if upload exists
        if ($upload !== FALSE)
        {
            // If single file uploaded
            if ($upload['count'] == 1)
            {
                // Single file
                $files = $this->CI->files->getByUploadID($upload_id);

                foreach ($files as $file)
                {
                    $file_name = $file['secret_code'] . '-' . $file['file'];
                    $path = FCPATH . $this->CI->config->item('upload_dir') . $file_name;
                }
            }
            else
            {
                // Zip file
                $file_name = $this->CI->config->item('name_on_file') . '-' . $upload_id . '.zip';
                $path = FCPATH . $this->CI->config->item('upload_dir') . $file_name;
            }

            // Check if the file exists
            if (file_exists($path))
            {
                // Destroy it
                unlink($path);
            }

            // Check if there's any external storage plugin installed
            $this->CI->load->library('plugin');
            if ($this->CI->plugin->pluginLoaded('upload'))
            {
                $upload_plugin = $this->CI->plugin->_plugins['upload'];

                require_once $this->CI->plugin->_pluginDir . $upload_plugin['load'] . '/' . $upload_plugin['handler_library'];

                $handlerLibrary = new HandlerLibrary();

                $handlerLibrary->delete($file_name);
            }

            // Mark upload destroyed when file has been deleted
            $this->CI->uploads->updateStatusByUploadID('destroyed', $upload_id);

            // Check if the share type is email
            if($upload['share'] == 'mail') {
                // Send email to uploader
                $this->CI->load->library('email');

                // Send email to uploader
                $this->CI->email->sendEmail('destroyed', array('upload_id' => $upload['upload_id']), array($upload['email_from']), $upload['lang']);
            }

            return true;
        }
        return false;
    }
}