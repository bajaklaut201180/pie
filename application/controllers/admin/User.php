<?php defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class User extends CI_Controller
{
    var $title = 'User';
    var $url = 'user';
    var $model = 'model_user';
    
    function __construct()
	{
		parent::__construct();
        checking_session();
	}
	
    function index()
    {
        $asset = array(
            'title'         => $this->title,
            'js'            => array('jquery.dataTables.min', 'dataTables.bootstrap.min', 'dataTables.responsive'),
            'css'           => array('dataTables.bootstrap', 'dataTables.responsive')
        );
        $this->load->model($this->model);
        $model_name = $this->model;
        
        $asset['user'] = $this->$model_name->get();
        //pre($asset['user']);
        
        $this->load->view('admin/template/header', $asset);
        $this->load->view('admin/template/top');
        $this->load->view('admin/' .$this->url .'/list_' .$this->url);
        $this->load->view('admin/template/footer');
	}
    
    public function add()
    {
        $this->load->library('upload');
        $asset = array(
            'title'     =>$this->title,
            'js'        =>array('pie'),
            'css'       =>array()
        ); 
        
        $this->form_validation->set_rules('username', 'username', 'required');
        $asset['section'] = access_menu();
        $asset['privileges'] = get_privileges();
        
        if($this->form_validation->run()==FALSE)
        { 
            $this->load->view('admin/template/header', $asset);
            $this->load->view('admin/template/top');
            $this->load->view('admin/' .$this->url .'/add_' .$this->url);
            $this->load->view('admin/template/footer');
        }
        else
        {
            //pre($this->input->post());
            $this->load->model($this->model);
            $model_name = $this->model;
            $this->$model_name->save($this->input->post());

            redirect(base_url('admin/' .$this->url));
        }    
    }
    
    public function view($item_id=null)
    {
        $this->load->library('form_validation');
        $this->load->library('upload');   
        $asset = array(
            'title'     =>'View User',
            'js'            => array('pie'),
            'css'           => array(),
            'userdata'  => $this->session->userdata()
        ); 
        
        $this->load->model($this->model);
        $this->load->model('model_section');
        $model_name = $this->model;
        $check_section = $this->model_section;
        $check_user = $this->$model_name->get($item_id);

        $asset['user'] = $check_user;
        $asset['section'] = access_menu();
        $asset['privileges'] = get_privileges();

        // filter status privileges
        if($item_id != null) {
            $asset['privileges_status'] = get_privileges_status($asset['user']['admin_id']);
            foreach($asset['section'] as $rows => $values) {
                // declare variable read, update, delete
                $asset['section'][$rows]['privileges_status_read'] = 0;
                $asset['section'][$rows]['privileges_status_update'] = 0;
                $asset['section'][$rows]['privileges_status_delete'] = 0;
                foreach($asset['privileges_status'] as $r => $v) {
                    if($values['section_id'] === $v['section_id']) {
                        // add status read, update, delete
                        $asset['section'][$rows]['privileges_status_read'] = $v['privileges_status_read'];
                        $asset['section'][$rows]['privileges_status_update'] = $v['privileges_status_update'];
                        $asset['section'][$rows]['privileges_status_delete'] = $v['privileges_status_delete'];
                    }
                }
            }
        }
        
        $this->form_validation->set_rules('username', 'username', 'required');
        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('admin/template/header', $asset);
            $this->load->view('admin/template/top');
            $this->load->view('admin/' .$this->url .'/view_' .$this->url);
            $this->load->view('admin/template/footer'); 
        }
        else
        {

            $this->load->model($this->model);
            $model_name = $this->model;
            $this->$model_name->save($this->input->post(), $this->input->post('id_admin')); 
            
            redirect(base_url('admin/' .$this->url)); 
            
        }  
    }
    
    
    public function delete($item_id)
    {
        $this->load->model($this->model);
        $model_name = $this->model;
        $delete = $this->$model_name->delete($item_id);
        if($delete)
        {
            redirect(base_url('admin/' .$this->url));
        }
        else
        {
            echo "delete function is failed";
        }
        
    }
}