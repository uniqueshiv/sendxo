<?php

class PremiumUploads {
    private $CI, $db, $_tablename;

    function __construct()
    {
        $this->_tablename = 'droppy_uploads';

        // Get codeigniter
        $this->CI =& get_instance();
        // Set DB to codeigniter DB variable
        $this->db = $this->CI->db;
    }

    function getByID($id) {
        $this->db->select('*');
        $this->db->from($this->_tablename);
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function getBySessionID($id) {
        $this->db->select('*');
        $this->db->from($this->_tablename);
        $this->db->where('pm_email', $id);
        $this->db->where('status', 'ready');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
}