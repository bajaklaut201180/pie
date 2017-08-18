<?php defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Log extends CI_Controller
{
    var $title = 'Log';
    var $url = 'log';
    var $model = 'model_log';
    
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
        
        $asset['log'] = $this->$model_name->get();
        
        $this->load->view('admin/template/header', $asset);
        $this->load->view('admin/template/top');
        $this->load->view('admin/' .$this->url .'/list_' .$this->url);
        $this->load->view('admin/template/footer');
	}
}