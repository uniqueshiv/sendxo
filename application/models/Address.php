<?php

class Address extends CI_Model {
    /**
     * Will add new email to the droppy_address_emails table
     * @param type $user_id
     * @param type $email
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function test(){
        echo "hello te";
    }

    function add($email) {
        $data = array(
            'email'       => $email,
        );
        $query = $this->db->insert('droppy_address_emails', $data);

        if($query) {
            return true;
        }
        return false;
    }

    /**
     * Get a row by ID
     *
     * @param $id
     * @return bool
     */
    
    function getAllAddress($upload_id){
       
        $this->db->select('*');
        $this->db->from('droppy_address_emails');
        $this->db->order_by('id','DESC');
        $query = $this->db->get()->result();
	
        return $query;
    }

    /**
     * Delete a row by ID
     *
     * @param $id
     * @return bool
     */
    function deleteByID($id) {
        $this->db->delete('droppy_address_emails', array('id' => $id));

        return true;
    }

     /**
     * Will return total amount of rows
     *
     * @return int
     */
    function getTotal() {
        $this->db->select('id');
        $this->db->from('droppy_address_emails');

        $query = $this->db->get();

        return $query->num_rows();
    }

     /**
     * Will return all rows
     * @param int $start
     * @param int $limit
     * @return array|bool
     */
    function getAll($start = 0, $limit = 0) {
        $this->db->select('*');
        $this->db->from('droppy_address_emails');
        if($limit > 0) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /**
     * Update row by ID
     *
     * @param $data
     * @param $id
     * @return bool
     */
    function updateByID($data, $id) {
        $this->db->where('id', $id);
        if($this->db->update('droppy_address_emails', $data)) {
            return true;
        }
        return false;
    }


     /**
     * Select an row by ID
     *
     * @param $id
     * @return array|bool
     */
    function getByID($id) {
        $this->db->select('*');
        $this->db->from('droppy_address_emails');
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();  

        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }









}