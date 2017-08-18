<?php defined('BASEPATH') or exit('No Direct Script Allowed');

class Model_login extends CI_Model
{
    var $table = "admin";
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function validate($post)
    {
        $result = array();
        $data = array();
        
        // check username to database
        $this->db->where('admin_username', $post['username']);
        $query = $this->db->get($this->table);
        $result_query = $query->result_array();

        if($result_query){
            // if username available, check password
            $this->db->where('admin_username', $post['username']);
            $this->db->where('admin_password', sha1($post['password']));
            $query = $this->db->get($this->table);
            $result_query = $query->row_array();
            
            if($result_query){
                // login success
                $data['check_login'] = array(
                    "status" => 1, 
                    "message" => "Congratulation, your username and password is valid"
                );
                $data['user'] = $result_query;
            }else{
                // password didnt match
                $data['check_login'] = array(
                    "status" => 0, 
                    "message" => "Sorry, password didnt match with username"
                );
            }
        }else{
            // username not available on db
            $data['check_login'] = array(
                "status" => 0, 
                "message" => "Sorry, username not available"
            );
        }
        
        $result = $data;
        return $result;
        
    }
    
    public function set_access($admin_id=false)
    {   
        // $navigasi = array();
        // grab table admin to get privileges id & table privileges status to filter menu navigasi access
        $admin = $this->db->get_where('admin', array('admin_id' => $admin_id))->row_array();
        $privileges_id = $admin['privileges_id'];

        $navigasi = get_parent();
        $privileges_status = $this->db->query("SELECT privileges_status.admin_id, section.section_id, section.section_parent, section.section_name, privileges_status.privileges_status_read, privileges_status.privileges_status_update, privileges_status.privileges_status_delete FROM privileges_status INNER JOIN section ON privileges_status.section_id = section.section_id WHERE privileges_status.admin_id = $admin_id")->result_array();

        
        foreach($navigasi as $row => $value) {
            foreach($privileges_status as $row_child => $value_child) {
                 if($value['section_id'] == $value_child['section_parent']) {
                    // superadmin
                    if($privileges_id == 1) {
                        
                    }
                    // administrator
                    if($privileges_id == 2) {
                        // remove user section
                        if($value_child['section_name'] == 'User') {
                            unset($value_child);
                        }
                    }
                    // special
                    if($privileges_id > 2) {
                        
                    }

                    // add child to navigasi
                    if(!empty($value_child)) $navigasi[$row]['child'][] = $value_child;
                }
            }
        }
        
        return $navigasi;
    }
}