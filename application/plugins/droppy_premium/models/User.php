<?php

class PremiumUser {
    private $CI, $db, $_tablename;

    function __construct()
    {
        $this->_tablename = 'droppy_pm_users';

        // Get codeigniter
        $this->CI =& get_instance();
        // Set DB to codeigniter DB variable
        $this->db = $this->CI->db;
    }

    function getAll($start = 0, $total = 0) {
        $this->db->select('*');
        $this->db->from($this->_tablename);
        $this->db->limit($total, $start);
        $this->db->order_by('id', 'desc');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
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

    function getBySubID($id) {
        $this->db->select('*');
        $this->db->from($this->_tablename);
        $this->db->where('sub_id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function getBySubIDAndID($id, $sub_id) {
        $this->db->select('*');
        $this->db->from($this->_tablename);
        $this->db->where('id', $id);
        $this->db->where('sub_id', $sub_id);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function getByEmail($email) {
        $this->db->select('*');
        $this->db->from($this->_tablename);
        $this->db->where('email', $email);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function updateByID($data, $id) {

    }

    function updateBySubID($data, $id) {
        $this->db->where('sub_id', $id);
        if($this->db->update($this->_tablename, $data)) {
            return true;
        }
        return false;
    }

    function updateByEmail($data, $email) {
        $this->db->where('email', $email);
        if($this->db->update($this->_tablename, $data)) {
            return true;
        }
        return false;
    }

    function insert($data) {
        if($this->db->insert($this->_tablename, $data)) {
            return true;
        }
        return false;
    }

    function deleteByID($id) {
        $this->db->delete($this->_tablename, array('id' => $id));
    }

    function deleteBySubID($id) {
        $this->db->delete($this->_tablename, array('sub_id' => $id));
    }
}