<?php

class Rename extends CI_Model {
    /**
     * Will add new files to the droppy_files table
     * @param type $upload_id
     * @param type $file_id
     * @param type $file_name
     * @param type $size
     * @return boolean
     */

    function add($upload_id, $file) {
        $data = array(
            'upload_id'     => $upload_id,
            'file'          => $file,
        );
        $query = $this->db->insert('droppy_renames', $data);

        if($query) {
            return true;
        }
        return false;
    }

    public function getAllRenameData($upload_id){
        // $this->db->select('upload_id,file');
        // $this->db->from('droppy_renames');
        // $this->db->where('upload_id', $upload_id);
        // $query = $this->db->get();
        // $row = $query->row_array(); 
        // //print_r($row);

        // $this->db->select('upload_id');
        // $query = $this->db->get('droppy_renames');
        $this->db->select('*');
        $this->db->from('droppy_renames');
        $this->db->order_by('id','DESC');
        $query = $this->db->get()->result();
	
        return $query;
        
    }



}