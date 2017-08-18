<?php defined('BASEPATH') or exit('No Direct Script Allowed');

class Model_user extends CI_Model
{
    var $table = 'admin';
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('upload');
    }
    
    public function save($data=array(), $id=null)
    {
        // pre($id);
        $unique_id = unique_id($this->table);
        $save_data = array();
        $save_data_status = array();
        
        if(!empty($_FILES['foto_user']['name'])){
            $file = mox_upload('foto_user', 'assets/images/user');
    		$file_thumbs = mox_upload('foto_user', 'assets/images/user/thumbs');	
            if(isset ($file))
            {
                $image = mox_resize($file, $this->width, $this->height);
    			$image_thumbs = mox_resize($file_thumbs, $this->width/4, $this->height/4);
    			$data['foto_user'] = $image['file_name'];
    			$data['foto_user'] = $image_thumbs['file_name'];
            }
        }
        // data for table admin
        if(!empty ($data['username'])) $save_data['admin_username'] = $data['username'];
        if(!empty ($data['email'])) $save_data['admin_email'] = $data['email'];
        if(!empty ($data['phone'])) $save_data['admin_phone'] = $data['phone'];
        if(!empty ($data['password'])) $save_data['admin_password'] = sha1($data['password']);
        if(!empty ($data['description_user'])) $save_data['user_description'] = $data['description_user'];
        if(!empty ($data['flag'])) $save_data['flag'] = $data['flag'];

        // data for table privileges status
        if(!isset($data['status'])) $data['status'] = array();
        if(isset($data['status'])) {
            // set variable array
            $status = $data['status'];
            $section = access_menu();
            $filter1 = array();
            $filter2 = array();
            $filter3 = array();

            // pre($data);

            foreach($status as $r => $v){
                $filter1[] = explode(",", $v, 2);

                foreach($filter1 as $rows => $values) {
                    $filter2[$rows]['id'] = $values['0'];
                    $filter2[$rows]['value'] = $values['1'];
                }
                
            }

            foreach($filter2 as $row => $value) {
                $filter3[$value['id']]['section_id'] = $value['id'];
                $filter3[$value['id']]['status'][] = array($value['value']);
            }
            
            
            foreach($filter3 as $row => $value) {
                // firstly, set all status data and give a static value
                $save_data_status[$row]['section_id'] = $value['section_id'];
                $save_data_status[$row]['admin_id'] = $id;
                $save_data_status[$row]['privileges_status_read'] = 0;
                $save_data_status[$row]['privileges_status_update'] = 0;
                $save_data_status[$row]['privileges_status_delete'] = 0;

                foreach($value['status'] as $r => $v) {
                    if($v[0] == 1) {
                        $save_data_status[$row]['privileges_status_read'] = 1;
                    }
                    if($v[0] == 2) {
                        $save_data_status[$row]['privileges_status_update'] = 1;
                    }
                    if($v[0] == 3){
                        $save_data_status[$row]['privileges_status_delete'] = 1;
                    }
                }
                
            }
            // reset array index start from 0
            $save_data_status = array_values($save_data_status);

            // for all uncheck section give 0
            if(count($save_data_status) != count($section)){
                $key_array = array();

                // merge array order by save_data_status
                $unite_array = array_merge($save_data_status, $section);
                
                // remove duplicate order by section id
                foreach($unite_array as $rows => $values) {
                    if(!in_array($values['section_id'], $key_array)) {
                        $key_array[$rows] = $values['section_id'];
                        $save_data_status[$rows] = $values;
                    }
                }

                // find an incomplete
                foreach($save_data_status as $rows => $values) {
                    if(!isset($values['privileges_status_read']) || !isset($values['privileges_status_update']) || !isset($values['privileges_status_delete'])) {
                        // equated with status data variable template for an uncheck data
                        $save_data_status[$rows]['admin_id'] = $id;
                        $save_data_status[$rows]['privileges_status_read'] = 0;
                        $save_data_status[$rows]['privileges_status_update'] = 0;
                        $save_data_status[$rows]['privileges_status_delete'] = 0;
                        if(isset($save_data_status[$rows]['section_name'])) unset($save_data_status[$rows]['section_name']);
                        if(isset($save_data_status[$rows]['section_parent'])) unset($save_data_status[$rows]['section_parent']);
                    }
                } 
            }  
        }   
        
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
            // update table admin
            $this->db->where($this->table .'_id', $id);
            $this->db->update($this->table, $save_data);
            
            // update table privileges status
            foreach($save_data_status as $rows => $values) {
                // cek to database privileges status
                $query = $this->db->query("SELECT * FROM privileges_status WHERE flag = 1 AND admin_id = {$values['admin_id']} AND section_id = {$values['section_id']}")->row_array();
                // update table if privileges status equal with values or add table if privileges status not equal 
                if(isset($query)) {
                    // update table privileges status
                    $this->db->where('admin_id', $values['admin_id']);
                    $this->db->where('section_id', $values['section_id']);
                    $this->db->update('privileges_status', $values);
                }else{
                    // add table privileges status
                    $this->db->insert('privileges_status', $values);
                }
            }
            // For History in table log
            $save_data = $this->db->get_where($this->table, array($this->table .'_id' => $id))->row_array();
            save_history($save_data, $this->table, $id);
            
        }     
    }
    
    public function get($id = false)
    {
        if(!$id){
            //$query = $this->db->order_by($this->table .'_id', 'DESC')->get_where($this->table, array('flag<'=>3, 'privileges_id !='=>1));
            $query = $this->db->query("SELECT {$this->table}.unique_id, {$this->table}.{$this->table}_id, {$this->table}.privileges_id, {$this->table}.admin_username, privileges.privileges_name, {$this->table}.flag FROM {$this->table} INNER JOIN privileges WHERE {$this->table}.flag < 3 AND {$this->table}.privileges_id != 1 AND privileges.privileges_id = {$this->table}.privileges_id");
            $result = $query->result_array();
        }else{
            $query = $this->db->where($this->table .'_id', $id)->get_where($this->table);
            $result = $query->row_array();
        }
        
        return $result;
            
    }

    public function get_section()
    {
        $query = $this->db->query("SELECT * FROM section WHERE section_parent > '0'");

        $result = $query->result_array();

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