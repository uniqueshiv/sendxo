<?php

/**
 * Class UpdateLib
 */
class UpdateLib
{
    /**
     * @var CI_Controller
     */
    protected $CI, $version;

    /**
     * AdminLib constructor.
     */
    public function __construct() {
        $this->CI =& get_instance();

        $this->version = '2.1.9';
    }

    public function run() {
        $current_version = $this->CI->config->item('version');

        $update_dir = APPPATH . 'update';

        if($current_version < '2.0.2')
        {
            $this->runSQL($update_dir . '/update_2.0.2.sql');
        }
        if($current_version < '2.1.4')
        {
            $this->runSQL($update_dir . '/update_2.1.4.sql');
        }
        if($current_version < '2.1.9')
        {
            $this->runSQL($update_dir . '/update_2.1.9.sql');
        }

        $this->updateVersion();
    }

    private function runSQL($path) {
        if (file_exists($path))
        {
            $sql = file_get_contents($path);

            $query_array = explode(";", $sql);
            foreach ($query_array as $query)
            {
                if ( ! empty($query))
                {
                    $query = utf8_encode($query);
                    $this->CI->db->query($query);
                }
            }

            unlink($path);
        }
    }

    private function updateVersion() {
        $this->CI->db->query("INSERT INTO `droppy_updates` (`version`, `type`, `date`) VALUES ('".$this->version."', '', CURRENT_TIMESTAMP);");
        $this->CI->db->query("UPDATE droppy_settings SET version = '".$this->version."' LIMIT 1;");
    }
}