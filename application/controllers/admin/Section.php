<?php defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Section extends CI_Controller
{
    var $title = 'Section';
    var $url = 'section';
    var $model = 'model_section';
    
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
        // pre($this->session->userdata());
        $this->load->model($this->model);
        $model_name = $this->model;
        
        $asset['section'] = $this->$model_name->get();
        
        $this->load->view('admin/template/header', $asset);
        $this->load->view('admin/template/top');
        $this->load->view('admin/' .$this->url .'/list_' .$this->url);
        $this->load->view('admin/template/footer');
	}
    
    public function add()
    {
        $this->load->library('form_validation');
        $asset = array(
            'title'     =>$this->title,
            'js'        =>array('ckeditor/adapters/jquery', 'ckeditor/ckeditor'),
            'css'       =>array()
        ); 
        
        $this->load->model($this->model);
        $model_name = $this->model;

        $asset['sectionCategory'] = $this->$model_name->get();
        // pre($asset['section']);
        $this->form_validation->set_rules('name_section', 'name_section', 'required');
        
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
        $asset = array(
            'title'     =>'View section',
            'js'        => array('ckeditor/adapters/jquery', 'ckeditor/ckeditor'),
            'css'       => array(),
            'userdata'  => $this->session->userdata()
        ); 
        
        $this->load->model($this->model);
        $model_name = $this->model;
        $check_section = $this->$model_name->get($item_id);
        
        $asset['sectionCategory'] = $this->$model_name->get();
        $asset['section'] = $check_section;

        $this->form_validation->set_rules('name_section', 'name_section', 'required');
        
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
            $this->$model_name->save($this->input->post(), $this->input->post('id_section')); 
            
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