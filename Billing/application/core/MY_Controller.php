<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}

class Main_Controller extends MY_Controller{
    public function __construct(){
        parent::__construct();
        /* Load */
        $this->load->helper('menu');
        $this->check_isvalidated();
    }

    private function check_isvalidated(){
        if(!$this->session->userdata('userId')){
            redirect('/');
        }
        /*
		if($this->session->userdata('Session_Name') == 'Administrator'){
			redirect('App_Admin/Dashboard');
		} else {
			if(!$this->session->userdata('UD_ID')){
				redirect('/');
			} else if($this->session->userdata('UD_TypeId') == 2){
				redirect('Supervisor/Dashboard');
			}
		}
		*/
    }
}
/*
class Supervisor_Controller extends MY_Controller{
	public function __construct(){
		parent::__construct();
            $this->load->helper('menu');
			$this->check_isvalidated();
    }

	private function check_isvalidated(){
		if($this->session->userdata('Session_Name') == 'Administrator'){
			redirect('App_Admin/Dashboard');
		} else {
			if(!$this->session->userdata('UD_ID')){
				redirect('/');
			} else if($this->session->userdata('UD_TypeId') == 1){
				redirect('Admin/Dashboard');
			}
		}
	}
}

class App_Admin_Controller extends MY_Controller{
	public function __construct(){
		parent::__construct();
            $this->load->helper('menu');
			$this->check_isvalidated();
    }

	private function check_isvalidated(){
		if($this->session->userdata('Session_Name') == 'User'){
			if(!$this->session->userdata('UD_ID')){
				redirect('/');
			} else if($this->session->userdata('UD_TypeId') == 1){
				redirect('Admin/Dashboard');
			}
		} else if(!$this->session->userdata('Session_Name')){
			redirect('/Auth/App_Admin');
		}
	}
}
*/

class Auth_Controller extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('menu');
        $this->load->library('session');
        $this->check_isvalidated();
    }

    private function check_isvalidated(){
        if($this->session->userdata('userId')){
            redirect('Invoice');
        }
    }
}


class Rest_Controller extends MY_Controller{
    public function __construct(){
        parent::__construct();
        /* Load */
        $this->load->helper('menu');
    }
}