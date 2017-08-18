<?php if(!defined('BASEPATH')) exit ('No Direct Script Access Allowed');

if(!function_exists('checking_session')) {
    function checking_session()
    {
        $ci =& get_instance();

        if(!isset($ci->session->userdata()['check_login']['status'])) {
             redirect(base_url('piecms'));
        }
    }
}

if(!function_exists('get_parent')) {
    function get_parent()
    {
        $ci =& get_instance();

        $navigasi = array();
        $result = $ci->db->select('section_id')->select('section_name')->select('section_parent')->get('section')->result_array();

        foreach($result as $row => $value) {
            if($value['section_parent'] == 0) {
                $navigasi[] = $value;
            }
        }

        $result = $navigasi;
        return $result;
        // pre($result);
    }
}


if(!function_exists('access_menu')) {
    function access_menu()
    {
        $ci =& get_instance();

        $navigasi = array();
        $result = $ci->db->select('section_id')->select('section_name')->select('section_parent')->get('section')->result_array();
        
        // get check parent navigasi
        foreach($result as $row => $value){
            // get child nav
            if($value['section_parent'] > 0) {
                foreach($result as $row_child => $value_child) {
                    if($value['section_parent'] == $value_child['section_id']) {
                        if($value_child['section_parent'] == 0) {
                            $child_nav[] = $value;
                        }
                    }
                }
                
            }

        }

        $result = $child_nav;

        return $result;
    }
}

if(!function_exists('get_privileges')) {
    function get_privileges()
    {
        $ci =& get_instance();

        $navigasi = array();
        $result = $ci->db->get('privileges')->result_array();
        

        return $result;
    }
}

if(!function_exists('get_privileges_status')) {
    function get_privileges_status($id)
    {
        $ci =& get_instance();

        $navigasi = array();
        $ci->db->where('admin_id', $id);
        $result = $ci->db->get('privileges_status')->result_array();
        

        return $result;
    }
}

if(!function_exists('check_table')){
    function check_table()
    {
        $ci =& get_instance();
        $result = $ci->db->list_tables();
        
        return $result;
    }
}

if(!function_exists('action_log')){
    function action_log($action, $db, $val = '#', $name, $desc)
	{
		$ci =& get_instance();
		
		$data = array(
				'log_admin_id' => /*$ci->session->userdata('admin_id')*/'1',
				'log_action' => $action,
				'log_db' => $db,
				'log_value' => $val,
				'log_name' => $name,
				'log_desc' => $desc,
				'log_ip' => $ci->input->ip_address()
			);
	
		$result = $ci->db->insert('log', $data);
        return $result;
	}
}

if(!function_exists('save_history')){
    function save_history($data=array(), $table, $id=null)
    {
        if(!$id){ 
            action_log('ADD', $table, $data[$table .'_id'], $data[$table .'_name'], 'ADDED ' .$table .' ( ' .$data[$table .'_name'] .' )');
        }else{ 
            //log updated
            if($data['flag'] == 3){
                action_log('UPDATED', $table, $data[$table .'_id'], $data[$table .'_name'], 'DELETED ' .$table .' ( ' .$data[$table .'_name'] .' )');
            }else{
                action_log('UPDATED', $table, $data[$table .'_id'], $data[$table .'_name'], 'MODIFY ' .$table .' ( ' .$data[$table .'_name'] .' )');
            }
        }    
    }
}

if(!function_exists('unique_id')){
	function unique_id($table_name)
	{
		$ci =& get_instance();
		$last_entry = $ci->db->select('unique_id')->order_by('unique_id', 'desc')->get($table_name)->row_array();
		
		$unique_id = ($last_entry) ? $last_entry['unique_id'] + 1 : 1;
		
		return $unique_id;
	}
}

if(!function_exists('pre')){
    function pre($array = array()){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        exit();
    }
}

if(!function_exists('developies_upload')){
    function developies_upload($file, $folder, $type='jpg|jpeg|png'){
        $ci = & get_instance();
        
        $config = array(
            'upload_path'       => $folder,
            'allowed_types'     => $type
        );
        $ci->load->library('upload');
        $ci->upload->initialize($config);
        
        if($ci->upload->do_upload($file)){
            return $ci->upload->data();
        }
        else
        {
            exit();
        }
    }
}

if ( ! function_exists('developies_resize')){
	function developies_resize($image, $width, $height, $folder = '', $orientation = 'single', $keep_ratio = TRUE){
		if ($image){
            if($orientation=='single'){
                if ($image['image_width'] > $width || $image['image_height'] > $height){
                    $config = array(
                    	'height'		=> $height,
                    	'width'			=> $width,
                    	'source_image'	=> $image['full_path'],
                    	'new_image'		=> $image['file_path'].$folder,
                    	'maintain_ratio'=> $keep_ratio
                    );
                }else{
                    $config = array(
                    	'height'		=> $image['image_height'],
                    	'width'			=> $image['image_width'],
                    	'source_image'	=> $image['full_path'],
                    	'new_image'		=> $image['file_path'].$folder,
                    	'maintain_ratio'=> $keep_ratio
                    );
                }
            }else{
                if($image['image_width']>$image['image_height']){
                    if ($image['image_width'] > $width || $image['image_height'] > $height){
                        $config = array(
                        	'height'		=> $height,
                        	'width'			=> $width,
                        	'source_image'	=> $image['full_path'],
                        	'new_image'		=> $image['file_path'].$folder,
                        	'maintain_ratio'=> $keep_ratio
                        );
                    }else{
                        $config = array(
                        	'height'		=> $image['image_height'],
                        	'width'			=> $image['image_width'],
                        	'source_image'	=> $image['full_path'],
                        	'new_image'		=> $image['file_path'].$folder,
                        	'maintain_ratio'=> $keep_ratio
                        );
                    }
                }else{
                    if ($image['image_width'] > $height || $image['image_height'] > $width){
                        $config = array(
                			'height'		=> $width,
                			'width'			=> $height,
                			'source_image'	=> $image['full_path'],
                			'new_image'		=> $image['file_path'].$folder,
                			'maintain_ratio'=> $keep_ratio
                		);
                    }else{
                        $config = array(
                        	'height'		=> $image['image_height'],
                        	'width'			=> $image['image_width'],
                        	'source_image'	=> $image['full_path'],
                        	'new_image'		=> $image['file_path'].$folder,
                        	'maintain_ratio'=> $keep_ratio
                        );
                    }
                }
            }
            if($config){
                $ci =& get_instance();
    			$ci->load->library('image_lib');
                $ci->image_lib->clear();
    			$ci->image_lib->initialize($config);
    			$ci->image_lib->resize();
    			return $image;
            }
		}
	}
}

if(!function_exists('delete_row')){
    function delete_row($db, $item_id = array()){
        $ci =& get_instance();

        if(is_array($item_id))
        {
            // Delete selected rows by replacing value of flag be 3
            $query = $ci->db->where_in($db .'_id', $item_id);
            $ci->db->update($db, array('flag'=>3));
            
            // For History in table log 
            /*
            foreach($item_id as $row=>$value){
                $save_data = $ci->db->get_where($db, array($db .'_id' => $value))->row_array();
                $this->save_history($save_data, $item_id);
            }
            */

        }
        else
        {
            // Delete rows by replacing value of flag be 3
            $ci->db->where($db .'_id', $item_id);
            $ci->db->update($db, array('flag'=>3));

            $save_data = $ci->db->get_where($db, array($db .'_id' => $item_id))->row_array();
            save_history($save_data, $db, $item_id);
            
            return true;
        }   
    }
}

// removed list
// if the system not error, it will be removed

if(!function_exists('menu_navigasi_superadmin')) {
    function menu_navigasi_superadmin()
    {
        $ci =& get_instance();

        $navigasi = array();
        $result = $ci->db->select('section_id')->select('section_name')->select('section_parent')->get('section')->result_array();
        
        // get check parent navigasi
        foreach($result as $row => $value){
            if($value['section_parent'] == 0) {
                $navigasi[] = $value;
            }

            // get child nav
            if($value['section_parent'] > 0) {
                foreach($result as $row_child => $value_child) {
                    if($value['section_parent'] == $value_child['section_id']) {
                        if($value_child['section_parent'] == 0) {
                            $child_nav[] = $value;
                        }
                    }
                }
                
            }

        }

        // merge parent navigasi && child navigasi
        foreach($navigasi as $row => $value) {
            foreach($child_nav as $row_child => $value_child) {
                if($value['section_id'] == $value_child['section_parent']) {
                    $navigasi[$row]['child'][] = $value_child;
                }
            }
        }
        $result = $navigasi;

        return $result;
    }
}