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
        $this->db->where('username_admin', $post['username']);
        $query = $this->db->get($this->table);
        $result_query = $query->result_array();

        if($result_query){
            // if username available, check password
            $this->db->where('username_admin', $post['username']);
            $this->db->where('password_admin', md5($post['password']));
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
    
    public function set_access($id_privileges)
    {   
        //check id on db privileges
        if($privileges_if == 1){
            // super admin
        }else if($privileges_id == 2){
            // administrator
        }else{
            // special
        }
    }
}