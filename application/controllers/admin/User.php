<?php defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class User extends CI_Controller
{
    var $title = 'User';
    var $url = 'user';
    var $model = 'model_user';
    
    function __construct()
	{
		parent::__construct();
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
        
        $asset['banner'] = $this->$model_name->get();
        //pre($asset['banner']);
        
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
            'js'        =>array('ckeditor/adapters/jquery', 'ckeditor/ckeditor'),
            'css'       =>array()
        ); 
        
        $this->form_validation->set_rules('name_banner', 'name_banner', 'required');
        
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
    
    public function updates()
    {
        $this->load->library('form_validation');
        $this->load->library('upload');
        $asset = array(
            'title'     =>$this->title,
            'js'        =>array('bootstrap.min'),
            'css'       =>array('bootstrap.min'),
            'userdata'  => $this->session->userdata()
        ); 
        
        $this->form_validation->set_rules('name_banner', 'name_banner', 'required');
        
        if($this->form_validation->run()==FALSE)
        {
            echo "failed";    
        }
        else
        {

            $this->load->model($this->model);
            $model_name = $this->model;
            $this->$model_name->save($this->input->post(), $this->input->post('id_banner')); 
            
            redirect(base_url('admin/' .$this->url)); 
            
        }
    }
    
    public function view($item_id)
    {   
        $asset = array(
            'title'     =>'View Banner',
            'js'        =>array('bootstrap.min', 'ckeditor/adapters/jquery', 'ckeditor/ckeditor','jquery.dataTables.min', 'dataTables.bootstrap.min', 'dataTables.responsive'),
            'css'       =>array('bootstrap.min', 'dataTables.bootstrap', 'dataTables.responsive'),
            'userdata'  => $this->session->userdata()
        ); 
        
        $this->load->model($this->model);
        $this->load->model($this->model_additional);
        $model_name = $this->model;
        $model_additional = $this->model_additional;
        $check_banner = $this->$model_name->get($item_id);
        $check_additional = $this->$model_additional->get($item_id);
        
        $asset['banner'] = $check_banner;
        $asset['banner_additional'] = $check_additional;
        
        //pre($asset['banner_additional']);
       
        $this->load->view('admin/template/header', $asset);
        $this->load->view('admin/template/top');
        $this->load->view('admin/' .$this->url .'/view_' .$this->url);
        $this->load->view('admin/template/footer');   
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