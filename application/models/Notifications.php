<?php

class Notifications extends CI_Model {
    /**
     * Will add new email to the droppy_notifications table
     * @param type $user_id
     * @param type $email
     */

    // function add($title,$detail) {
    //     $data = array(
    //         'title'       => $title,
    //         'detail'     => $detail
    //     );
    //     $query = $this->db->insert('droppy_notifications', $data);

    //     if($query) {
    //         return true;
    //     }
    //     return false;
    // }

    /**
     * Get a row by ID
     *
     * @param $id
     * @return bool
     */
    
    // function getAllAddress($upload_id){
       
    //     $this->db->select('*');
    //     $this->db->from('droppy_notifications');
    //     $this->db->order_by('id','DESC');
    //     $query = $this->db->get()->result();
	
    //     return $query;
    // }

    /**
     * Delete a row by ID
     *
     * @param $id
     * @return bool
     */
    // function deleteByID($id) {
    //     $this->db->delete('droppy_notifications', array('id' => $id));

    //     return true;
    // }

     /**
     * Will return total amount of rows
     *
     * @return int
     */
    // function getTotal() {
    //     $this->db->select('id');
    //     $this->db->from('droppy_notifications');

    //     $query = $this->db->get();

    //     return $query->num_rows();
    // }

     /**
     * Will return all rows
     * @param int $start
     * @param int $limit
     * @return array|bool
     */
    // function getAll($start = 0, $limit = 0) {
    //     $this->db->select('*');
    //     $this->db->from('droppy_notifications');
    //     if($limit > 0) {
    //         $this->db->limit($limit, $start);
    //     }

    //     $query = $this->db->get();

    //     if($query->num_rows() > 0) {
    //         return $query->result_array();
    //     }
    //     return false;
    // }

    // function get_table(){
    //     $table = 'droppy_notifications';
    //     return $table;
    // }

    // function get($order_by){
    //     $table = $this->get_table();
    //     $this->db->order_by($order_by);
    //     $query = $this->db->get($table);
    //     return $query;
    // }

    /**
     * Will return all rows
     * @param int $start
     * @param int $limit
     * @return array|bool
     */
    // function getWithLimit($limit, $offset, $order_by) {
    //     $table = $this->get_table();
    //     $this->db->limit($limit,$offset);
    //     $this->db->order_by($order_by);
    //     $query = $this->db->get($table);
    //     return $query;
    // }

    /**
     * Update row by ID
     *
     * @param $data
     * @param $id
     * @return bool
     */
    // function updateByID($data, $id) {
    //     $this->db->where('id', $id);
    //     if($this->db->update('droppy_notifications', $data)) {
    //         return true;
    //     }
    //     return false;
    // }


     /**
     * Select an row by ID
     *
     * @param $id
     * @return array|bool
     */
   // function getByID($id) {
    //     $this->db->select('*');
    //     $this->db->from('droppy_notifications');
    //     $this->db->where('id', $id);
    //     $this->db->limit(1);

    //     $query = $this->db->get();  

    //     if($query->num_rows() > 0) {
    //         return $query->row_array();
    //     }
    //     return false;
    // }



   
	public function __construct() {
        parent::__construct();
        $this->load->model('users');
    }

    public function getAll() {
        $query = $this->db->get('droppy_notifications');
        return $query->result();
    }

    public function getByUserID($id, $last_notification_id=0, $limit=true) {
        
        $this->db->order_by('created_at', 'DESC');
        if ($limit) {
            $this->db->from('droppy_notifications');
            $this->db->where('user_id', $id);
            $this->db->where('status', 'true');
            $this->db->where('id >', $last_notification_id);
            $this->db->limit(8);
            $query = $this->db->get();
        } else {
            $query = $this->db->get_where('droppy_notifications', ['user_id' => $id]);
        }
        return $query->result_array();
    }

    public function getAllNotificationsById($id) {
    	$this->db->order_by('created_at', 'DESC');
        $query = $this->db->get_where('droppy_notifications', ['user_id' => $id], 20);
        return $query->result();
    }

    public function create($data) {
        $this->db->insert('droppy_notifications', $data);
    }

    public function updateStatusByUserId($id){

        $appointment_id = 0;
        $status = array('status' => false);    
        // $this->db->where('id', $appointment_id);
        // $this->db->update('ea_appointments', $appointment);

        $this->db->where('user_id', $id);
        if($this->db->update('droppy_notifications', array('status'=>'false'))) {
            return true;
        }
        return false;
        
    }
}
