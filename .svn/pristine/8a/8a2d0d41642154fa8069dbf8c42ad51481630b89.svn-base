<?php defined('BASEPATH') or exit('No Direct Script Allowed');

class Model_banner extends CI_Model
{
    var $table = 'banner';
    
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
        
        if(!empty($_FILES['foto_banner']['name'])){
            $file = mox_upload('foto_banner', 'assets/images/banner');
    		$file_thumbs = mox_upload('foto_banner', 'assets/images/banner/thumbs');	
            if(isset ($file))
            {
                $image = mox_resize($file, $this->width, $this->height);
    			$image_thumbs = mox_resize($file_thumbs, $this->width/4, $this->height/4);
    			$data['foto_banner'] = $image['file_name'];
    			$data['foto_banner'] = $image_thumbs['file_name'];
            }
        }
        
        if(!empty ($data['name_banner'])) $save_data['banner_name'] = $data['name_banner'];
        if(!empty ($data['caption_banner'])) $save_data['banner_caption'] = $data['caption_banner'];
        if(!empty ($data['url'])) $save_data['url'] = $data['url'];
        if(!empty ($data['foto_banner'])) $save_data['banner_image'] = $data['foto_banner'];
        if(!empty ($data['description_banner'])) $save_data['banner_description'] = $data['description_banner'];
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
            $query = $this->db->order_by($this->table .'_id', 'DESC')->get_where($this->table, array('flag<'=>3));
            $result = $query->result_array();
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