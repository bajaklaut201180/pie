<?php defined('BASEPATH') or exit('No Direct Script Allowed');

class Model_section extends CI_Model
{
    var $table = 'section';
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('upload');
    }
    
    public function save($data=array(), $id=null)
    {
        $unique_id = unique_id($this->table);
        $save_data = array();
        
        if(!empty ($data['name_section'])) $save_data['section_name'] = $data['name_section'];
        if(!empty ($data['parent_section'])) $save_data['section_parent'] = $data['parent_section'];
        if(!($data['parent_section'])) $save_data['section_parent'] = 0;
        if(!empty($data['flag'])) $save_data['flag'] = $data['flag'];
        

        if(!$id)
        {
            // insert to database
            $save_data['unique_id'] = $unique_id;
            $this->db->insert($this->table, $save_data);
            
            // For History in table log
            $save_data = $this->db->get_where($this->table, array($this->table . '_id' => $this->db->insert_id()))->row_array();
            save_history($save_data, $this->table);
        }
        else
        {
            // update database
            $this->db->where($this->table .'_id', $id);
            $this->db->update($this->table, $save_data);
            
            // For History in table log
            $save_data = $this->db->get_where($this->table, array($this->table .'_id' => $id))->row_array();
            save_history($save_data, $this->table, $id);
            
        }     
    }
    
    public function get($id = false)
    {
        if(!$id){
            $query = $this->db->order_by($this->table .'_parent', 'asc')->get_where($this->table, array('flag<'=>3));
            $results = $query->result_array();
            
            foreach($results as $row => $value)
            {
                if($value['section_parent']==0){
                    $value['section_parent'] = '[parent]';
                }else{
                    foreach($results as $r => $v){
                        if($value['section_parent'] == $v['section_id']) $value['section_parent'] = $v['section_name'];
                    }
                }
                $result[] = $value;
            }
            
        }else{
            $query = $this->db->where($this->table .'_id', $id)->get_where($this->table);
            $result = $query->row_array();
        }
        
        return $result;
            
    }
      
    public function delete($item_id=array())
    {
        if(is_array($item_id))
        {
            // Delete selected rows by replacing value of flag be 3
            $query = $this->db->where_in($this->table .'_id', $item_id);
            $this->db->update($this->table,array('flag'=>3));
            
            // For History in table log 
            /*
            foreach($item_id as $row=>$value){
                $save_data = $this->db->get_where($this->table, array($this->table .'_id' => $value))->row_array();
                $this->save_history($save_data, $item_id);
            }
            */

        }
        else
        {
            // Delete rows by replacing value of flag be 3
            $this->db->where($this->table .'_id', $item_id);
            $this->db->update($this->table, array('flag'=>3));

            $save_data = $this->db->get_where($this->table, array($this->table .'_id' => $item_id))->row_array();
            save_history($save_data, $this->table, $item_id);
            
            return true;
        }   
    }
}