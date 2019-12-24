<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action extends Main_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Action_model');
    }
    public function form_submit(){
        $this->form_validation->set_rules('id', 'Text', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $dateTime = date('Y-m-d H:i:s');
            $id = $this->input->post("id");
            $page_type = $this->input->post("page_type");
            $action = $this->input->post("action");
            if($page_type == 'Unit'){
                if($action == 'Delete'){
                    $update_where = array("unitId" => $id);
                    $update_data = array("isDeleted" => 1, "dateModified" => $dateTime);
                    if($this->Action_model->update_to_db('unit', $update_where, $update_data) == true){
                        $response = array("status" => "success", "msg" => "Unit Deleted Successfully!");
                    } else {
                        $response = array("status" => "error", "msg" => "Please Try Again!");
                    }
                } else if($action == 'Enable'){
                    $update_where = array("unitId" => $id);
                    $update_data = array("isActive" => 1, "dateModified" => $dateTime);
                    if($this->Action_model->update_to_db('unit', $update_where, $update_data) == true){
                        $response = array("status" => "success", "msg" => "Unit Enabled Successfully!");
                    } else {
                        $response = array("status" => "error", "msg" => "Please Try Again!");
                    }
                } else if($action == 'Disable'){
                    $update_where = array("unitId" => $id);
                    $update_data = array("isActive" => 0, "dateModified" => $dateTime);
                    if($this->Action_model->update_to_db('unit', $update_where, $update_data) == true){
                        $response = array("status" => "success", "msg" => "Unit Disabled Successfully!");
                    } else {
                        $response = array("status" => "error", "msg" => "Please Try Again!");
                    }
                }
            } else if($page_type == 'Product'){
                if($action == 'Delete'){
                    $update_where = array("productId" => $id);
                    $update_data = array("isDeleted" => 1, "dateModified" => $dateTime);
                    if($this->Action_model->update_to_db('products', $update_where, $update_data) == true){
                        $response = array("status" => "success", "msg" => "Product Deleted Successfully!");
                    } else {
                        $response = array("status" => "error", "msg" => "Please Try Again!");
                    }
                } else if($action == 'Enable'){
                    $update_where = array("productId" => $id);
                    $update_data = array("isActive" => 1, "dateModified" => $dateTime);
                    if($this->Action_model->update_to_db('products', $update_where, $update_data) == true){
                        $response = array("status" => "success", "msg" => "Product Enabled Successfully!");
                    } else {
                        $response = array("status" => "error", "msg" => "Please Try Again!");
                    }
                } else if($action == 'Disable'){
                    $update_where = array("productId" => $id);
                    $update_data = array("isActive" => 0, "dateModified" => $dateTime);
                    if($this->Action_model->update_to_db('products', $update_where, $update_data) == true){
                        $response = array("status" => "success", "msg" => "Product Disabled Successfully!");
                    } else {
                        $response = array("status" => "error", "msg" => "Please Try Again!");
                    }
                }
            }  else if($page_type == 'Customer'){
                if($action == 'Delete'){
                    $update_where = array("partyId" => $id);
                    $update_data = array("isDeleted" => 1, "dateModified" => $dateTime);
                    if($this->Action_model->update_to_db('party', $update_where, $update_data) == true){
                        $response = array("status" => "success", "msg" => "Customer Deleted Successfully!");
                    } else {
                        $response = array("status" => "error", "msg" => "Please Try Again!");
                    }
                } 
            } else if($page_type == 'Invoice'){
                if($action == 'Delete'){
                    $update_where = array("invoiceId" => $id);
                    $update_data = array("isDeleted" => 1, "dateModified" => $dateTime);
                    if($this->Action_model->update_to_db('invoice_details', $update_where, $update_data) == true){
                        if($this->Action_model->update_to_db('invoice_items', $update_where, $update_data) == true){
                            $response = array("status" => "success", "msg" => "Invoice Deleted Successfully!");
                        }
                    } else {
                        $response = array("status" => "error", "msg" => "Please Try Again!");
                    }
                } 
            }
            else {
                $response = array("status" => "error", "msg" => $page_type."Customer Name not Found.");
            }
            echo json_encode($response);
        }
    }
    public function Logout(){
        $this->session->sess_destroy();
        redirect('/');
    }
}
