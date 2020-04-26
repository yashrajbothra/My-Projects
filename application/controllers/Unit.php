<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends Main_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('menu_helper');
        $this->load->helper('global_variable_helper');
        $this->load->library('form_validation');
        $this->load->model('Action_model');
        $this->load->model('Unit_model');
    }
    public function index(){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Units';
        if($this->Unit_model->get_units() == false){
            $data['unit'] = array();
        } else {
            $data['unit'] = $this->Unit_model->get_units();
        }
        $this->load->view('Unit/View_unit', $data);
    }
    public function Add(){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Add Unit';
        $this->load->view('Unit/Add_unit',$data);
    }
    public function Edit($unitId){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Edit Unit';
        if($this->Unit_model->get_unit($unitId) == true){
            $data['unit'] = $this->Unit_model->get_unit($unitId);
        } else {
            redirect('Unit');
        }
        $this->load->view('Unit/Edit_unit',$data);
    }

    public function form_submit(){
        $this->form_validation->set_rules('U_Name', 'Unit Name', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $dateCreated = date('Y-m-d H:i:s');
            $unitName = $this->input->post("U_Name");
            $insert_arr = array('unitName' => $unitName,'	dateCreated' => $dateCreated);
            if($this->Action_model->insert_to_db('unit', $insert_arr) == true){
                $response = array("status" => "success", "msg" => "Successfully Added!");
            } else {
                $response = array("status" => "error", "msg" => "Successfully Added!");
            }
        } else {
            $response = array("status" => "error", "msg" => "Unit Name not Found.");
        }
        echo json_encode($response);
    }
    public function update_submit(){
		$this->form_validation->set_rules('U_ID', 'Text', 'trim|required');
		$this->form_validation->set_rules('U_Name', 'Text', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $dateTime = date('Y-m-d H:i:s');
            $unitId = $this->input->post("U_ID");
            $unitName = $this->input->post("U_Name");   
            $update_where = array("unitId" => $unitId);
            $update_data = array("unitName" => $unitName, "dateModified" => $dateTime);
            if($this->Action_model->update_to_db('unit', $update_where, $update_data) == true){
                $response = array("status" => "success", "msg" => "Successfully updated!");
            } else {
                $response = array("status" => "error", "msg" => "Successfully updated!");
            }
        } else {
            $response = array("status" => "error", "msg" => "Unit Name not Found.");
        }
        echo json_encode($response);
    }
}