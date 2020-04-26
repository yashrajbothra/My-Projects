<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Customer_model');
        $this->load->model('Action_model');
        $this->load->model('Unit_model');
    }

    public function index(){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Customers';
        if($this->Customer_model->getCustomerData() == false){
            $data['customers'] = array();
        } else {
            $data['customers'] = $this->Customer_model->getCustomerData();
        }
        $this->load->view('Customer/View_customer', $data);
    }

    public function Add(){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Add Customer';
        $this->load->view('Customer/Add_customer', $data);
    }

    public function Edit($C_ID){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Edit Customer';
        $data['unit'] = $this->Unit_model->get_units();
        if($this->Customer_model->getCustomerData($C_ID) == true){
            $data['customers'] = $this->Customer_model->getCustomerDetail($C_ID);
        } else {
            redirect('Customer');
        }
        $this->load->view('Customer/Edit_customer', $data);
    }


    public function form_submit(){
        $this->form_validation->set_rules('LD_Type', 'Text', 'trim|required');
        $this->form_validation->set_rules('LD_Name', 'Text', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $dateTime = date('Y-m-d H:i:s');
            $LD_Name = $this->input->post("LD_Name");
            $LD_MobileNo = $this->input->post("LD_MobileNo");
            $LD_Email = $this->input->post("LD_Email");
            $city = $this->input->post("OD_City");
            $LD_Address = $this->input->post("LD_Address");
            $insert_arr = array( 'partyName' => $LD_Name, 'phone' => $LD_MobileNo, 'email' => $LD_Email, 'city' => $city, 'address' => $LD_Address,'dateModified' => $dateTime, 'dateCreated' => $dateTime);
            if($this->Action_model->insert_to_db('party', $insert_arr) == true){
                $response = array("status" => "success", "msg" => "Successfully Added!");
            } else {
                $response = array("status" => "error", "msg" => "Successfully Added!");
            }
        } else {
            $response = array("status" => "error", "msg" => "Customer Name not Found.");
        }
        echo json_encode($response);
    }
    public function update_submit(){
        $this->form_validation->set_rules('C_ID', 'Text', 'trim|required');
        $this->form_validation->set_rules('C_Name', 'Text', 'trim|required');
        $this->form_validation->set_rules('C_MobileNo', 'Text', 'trim');
        $this->form_validation->set_rules('C_Email', 'Text', 'trim');
        $this->form_validation->set_rules('OD_City', 'Text', 'trim');
        $this->form_validation->set_rules('C_Address', 'Text', 'trim');
        if($this->form_validation->run() == TRUE){
            $dateTime = date('Y-m-d H:i:s');
            $C_ID = $this->input->post("C_ID");
            $C_Name = $this->input->post("C_Name");
            $C_MobileNo = $this->input->post("C_MobileNo");
            $C_Email = $this->input->post("C_Email");
            $city = $this->input->post("OD_City");
            $C_Address = $this->input->post("C_Address");
            $update_where = array("partyId" => $C_ID);
            $update_data = array('partyName' => $C_Name, 'phone' => $C_MobileNo, 'city' => $city,  'email' => $C_Email,'address' => $C_Address, 'dateModified' => $dateTime);
            if($this->Action_model->update_to_db('party', $update_where, $update_data) == true){
                $response = array("status" => "success", "msg" => "Successfully updated!");
            } else {
                $response = array("status" => "error", "msg" => "Successfully updated!");
            }
        } else {
            $response = array("status" => "error", "msg" => "Customer Id Not Found!");
        }
        echo json_encode($response);
    }

}