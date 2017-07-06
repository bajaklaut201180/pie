<?php defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $asset = array(
                    'js'        =>array(),
                    'css'       =>array()
                );
        $asset['title'] = "Login";
        if (!isset($this->session->userdata()['check_login']['status']))
        {
            // if false, back to login view
            $this->load->view('admin/template/header', $asset);
            $this->load->view('admin/login_view');
            $this->load->view('admin/template/footer');
        }
        else
        {
            if ($this->session->userdata()['check_login']['status'] == true)
            {
                $asset['title'] = "Success Login";
                // if match, direct to main page with session
                $this->load->view('admin/template/header', $asset);
                $this->load->view('admin/template/top');
                $this->load->view('admin/template/main_page');
                $this->load->view('admin/template/footer'); 
            }
            else
            {
                // if not match, error message will show
                $this->load->view('admin/template/header', $asset);
                $this->load->view('admin/login_view');
                $this->load->view('admin/template/footer');
            }
        }
        
    }
    
    public function validate()
    {
        $asset = array(
                    'title'     =>'Login',
                    'js'        =>array(),
                    'css'       =>array()
                );
        // prevent to fake userdata check_login, erase userdata 
        $this->session->unset_userdata('check_login');
        
        $this->form_validation->set_rules('username', 'input username', 'required');
        $this->form_validation->set_rules('password', 'input password', 'required');
       
        if($this->form_validation->run()==false)
        {
            // if not complete fill the input login, show notif completed at placeholder
            $this->load->view('admin/template/header', $asset);
            $this->load->view('admin/login_view');
            $this->load->view('admin/template/footer');
        }
        else
        {   //check to database   
            $this->load->model('model_login');
            $post = $this->input->post();
            $response = $this->model_login->validate($post);
            
           // set userdata
            if($response){
                $this->model_login->set_access($response['user']['privileges_id']);
                $this->session->set_userdata($response);  
                //pre($response);
            }
        
        redirect(base_url('admin/login'));
        
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('piecms'));
    } 

}