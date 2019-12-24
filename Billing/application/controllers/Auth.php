<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Auth_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Login_model');
    }
	
	public function index(){
		$data['global_data'] = global_variables();
		$data['global_data']['page_title'] = 'Login';
		$this->load->view('Auth/Login', $data);
	}
	
	public function login_submit(){
		$this->form_validation->set_rules('username', 'Text', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == TRUE){
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$login_data = array("username" => $username, "password" => $password);
			$response = $this->Login_model->login_API($login_data);
			echo $response;
		} else {
            redirect('/');
		}  
    }
}
