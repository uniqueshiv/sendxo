<?php

class PremiumSettings {
    private $CI, $db, $_tablename;

    function __construct()
    {
        $this->_tablename = 'droppy_pm_settings';

        // Get codeigniter
        $this->CI =& get_instance();
        // Set DB to codeigniter DB variable
        $this->db = $this->CI->db;
    }

    function getSettings() {
        $this->db->select('*');
        $this->db->from($this->_tablename);
        $this->db->where('id', 1);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function getDroppySettings() {
        $this->db->select('*');
        $this->db->from('droppy_settings');
        $this->db->where('id', 1);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function checkSettings() {
        if($this->db->table_exists($this->_tablename)) {
            return true;
        }
        return false;
    }

    function update($data) {
        $this->db->where('id', 1);
        if($this->db->update($this->_tablename, $data)) {
            return true;
        }
        return false;
    }

    function installPremium() {
        return run_sql_file(dirname(__FILE__) . '/../install.sql', $this->db);
    }
}