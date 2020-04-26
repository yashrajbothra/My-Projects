<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        //$this->load->library('encrypt');
		$this->load->library('encryption');
		$this->load->library('email');
        $this->load->library('session');
    }
	
    public function login_API($data){
        
        $this->db->select('*');
        $this->db->from('login_info');
        $this->db->where(array('username' => $data['username'],'email' => $data['username'],'isActive' => 1,'isDeleted' => 0));
        $Check_User = $this->db->get();
        if ($Check_User->num_rows() > 0) {
			$Check_User_Data = $Check_User->row();
			$ciphertext = $this->encryption->decrypt($Check_User_Data->password);
			if($ciphertext == $data['password']){
				$this->createSession($Check_User_Data);
				$response = array("status" => "success", "msg" => "Successfully Logged In.");
			} else {
				$response = array("status" => "error", "msg" => "Invaild Password!");
			}
        } else {
			$response = array("status" => "error", "msg" => "Invaild User!");
        }
        return json_encode($response);
    }
	
    public function createSession($arr){
        $session_arr = array(
            'userId' => $arr->userId,
            'username' => $arr->username,
            'logged_in' => true
        );
        $this->session->set_userdata($session_arr);
    }

}