<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Main_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Product_model');
        $this->load->model('Unit_model');
        $this->load->model('Action_model');
    }

    public function index(){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Products';
        if($this->Product_model->get_products() == false){
            $data['products'] = array();
        } else {
            $data['products'] = $this->Product_model->get_products();
        }
        $this->load->view('Product/View_product', $data);
    }

    public function Add(){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Add Product';
        $data['unit'] = $this->Unit_model->get_units();
        $this->load->view('Product/Add_product', $data);
    }

    public function Edit($PD_ID){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Edit Product';
        $data['unit'] = $this->Unit_model->get_units();
        if($this->Product_model->get_product($PD_ID) == true){
            $data['product'] = $this->Product_model->get_product($PD_ID);
        } else {
            redirect('Product');
        }
        $this->load->view('Product/Edit_product', $data);
    }

    public function form_submit(){
        $this->form_validation->set_rules('PD_Name', 'Text', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $dateTime = date('Y-m-d H:i:s');
            $PD_Size = $this->input->post("PD_Size");
            $PD_Name = $this->input->post("PD_Name");
            $U_ID = $this->input->post("U_ID");
            $PD_Rate = $this->input->post("PD_Rate");
            $PD_Specifications = $this->input->post("PD_Specification");
            $insert_arr = array('size' => $PD_Size, 'productName' => $PD_Name, 'unitId' => $U_ID, 'productRate' => $PD_Rate,'description' => $PD_Specifications, 'dateCreated' => $dateTime);
            if($this->Action_model->insert_to_db('products', $insert_arr) == true){
                $response = array("status" => "success", "msg" => "Successfully updated!");
            } else {
                $response = array("status" => "error", "msg" => "Successfully updated!");
            }
        } else {
            $response = array("status" => "error", "msg" => "Product Id Not Found!");
        }
        echo json_encode($response);
    }


    public function update_submit(){
        $this->form_validation->set_rules('PD_ID', 'Text', 'trim|required');
        $this->form_validation->set_rules('PD_Name', 'Text', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $dateTime = date('Y-m-d H:i:s');
            $PD_ID = $this->input->post("PD_ID");
            $PD_Size = $this->input->post("PD_Size");
            $PD_Name = $this->input->post("PD_Name");
            $U_ID = $this->input->post("U_ID");
            $PD_Rate = $this->input->post("PD_Rate");
            $PD_Specifications = $this->input->post("PD_Specification");
            $update_where = array("productId" => $PD_ID);
            $update_data = array('size' => $PD_Size, 'productName' => $PD_Name,  'productRate' => $PD_Rate,'unitId' => $U_ID,'description' => $PD_Specifications, 'dateModified' => $dateTime);
            if($this->Action_model->update_to_db('products', $update_where, $update_data) == true){
                $response = array("status" => "success", "msg" => "Successfully updated!");
            } else {
                $response = array("status" => "error", "msg" => "Successfully updated!");
            }
        } else {
            $response = array("status" => "error", "msg" => "Product Id Not Found!");
        }
        echo json_encode($response);
    }

}
