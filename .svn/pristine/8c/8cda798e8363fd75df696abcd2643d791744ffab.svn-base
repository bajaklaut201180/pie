<?php defined('BASEPATH') or exit('No Direct Script Allowed');

class Model_log extends CI_Model
{
    var $table = 'log';
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('upload');
    }
    
    public function get($id = false)
    {
        if(!$id){
            $query = $this->db->order_by($this->table .'_id', 'DESC')->get_where($this->table);
            $result = $query->result_array();
        }else{
            $query = $this->db->where($this->table .'_id', $id)->get_where($this->table);
            $result = $query->row_array();
        }
        return $result;
            
    }
}