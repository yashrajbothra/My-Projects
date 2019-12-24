<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends Main_Controller {

    /**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */ 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('menu');
        $this->load->helper('form');
        $this->load->model('Invoice_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->model('Product_model');
        $this->load->model('Unit_model');
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Invoice';
        $query = $this->db->get_where("invoice_details",array("isDeleted" => 0));
        $data['num'] = $this->Invoice_model->last_invoiceNo();
        $data['products'] = $this->Product_model->get_active_products();
        $data['units'] = $this->Unit_model->get_active_units();
        $this->load->view('Add_invoice',$data);
    }
    public function View_List(){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'View Invoice';
        $filter = NULL;
        $data['invoice'] = $this->Invoice_model->getOrders($filter);
        $this->load->view('List_invoice', $data);

    }
    public function Customer1(){
        $this->load->model('Customer_model');
        $data = $this->Customer_model->getActiveCustomerData();
        echo json_encode($data);
    }
    public function Edit($OD_ID){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Edit Invoice';
        $this->load->model('Product_model');
        $this->load->model('Unit_model');
        if($this->Invoice_model->getOrder($OD_ID) == false){
            $data['invoice_detail'] = 'No Data Available';
        } else {
            $data['products'] = $this->Product_model->get_active_products();
            $data['units'] = $this->Unit_model->get_active_units();
            $data['invoice_detail'] = $this->Invoice_model->getOrder($OD_ID);
        }
        $this->load->view('Edit_invoice', $data);
    }
    public function Print_page($OD_ID){
        $data['global_data'] = global_variables();
        $data['global_data']['page_title'] = 'Print Invoice';
        $this->load->model('Product_model');
        $this->load->model('Unit_model');
        if($this->Invoice_model->getOrder($OD_ID) == false){
            $data['invoice_detail'] = 'No Data Available';
        } else {
            $data['units'] = $this->Unit_model->get_active_units();
            $data['invoice_detail'] = $this->Invoice_model->getOrder($OD_ID);
        }
        $this->load->view('Print_invoice', $data);
    }   
    public function form_submit(){
        $this->load->model('Action_model');
        $this->form_validation->set_rules('OD_No', 'Invoice Number', 'trim|required');
        $this->form_validation->set_rules('OD_Date', 'Date', 'trim|required');
        $this->form_validation->set_rules('OD_CustomerName', 'Customer Name', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $dateTime = date('Y-m-d H:i:s');
            $OD_No = $this->input->post("OD_No");
            $pageType = $this->input->post("pageType");
            $OD_Date = date('Y-m-d', strtotime($this->input->post("OD_Date")));
            $OD_DateTime = $OD_Date.' '.date('H:i:s');
            $OD_CustomerName = $this->input->post("OD_CustomerName");
            $OD_MobileNo = $this->input->post("OD_MobileNo");
            $OD_Email = $this->input->post("OD_Email");
            $OD_Address = $this->input->post("OD_Address");
            $OD_City = $this->input->post("OD_City");
            $packing_charg_val = $this->input->post("packing_charge_val");
            $packing_charg_per = $this->input->post("packing_charge_per");
            $packingCharge = array("Percentage" => $packing_charg_per, "Amount" => $packing_charg_val);
            $packingCharge = json_encode($packingCharge, true);          
            $transport_charg_per = $this->input->post("transport_charge_per");
            $transport_charg_val = $this->input->post("transport_charge_val");
            $transportCharge = array("Percentage" => $transport_charg_per, "Amount" => $transport_charg_val);
            $transportCharge = json_encode($transportCharge, true);
            $partyId = $this->input->post("partyId");
            $PD_IDs = $this->input->post("PD_IDs");
            $U_IDs = $this->input->post("U_IDs");
            $qty = $this->input->post("qty");
            $price = $this->input->post("price");
            $item_discount = $this->input->post("item_discount");
            $remark = $this->input->post("remark");
            $amount = $this->input->post("amount");
            $OD_Amount = $this->input->post("Net_Amount");
            $discount_val = $this->input->post("discount_val");
            $discount_per = $this->input->post("discount_per");
            $OD_Discount = array("Percentage" => $discount_per, "Amount" => $discount_val);
            $OD_Discount = json_encode($OD_Discount, true);
            if(!$partyId){
                $insert_arr = array( 'partyName' => $OD_CustomerName, 'phone' => $OD_MobileNo,'city' => $OD_City, 'email' => $OD_Email, 'address' => $OD_Address,'dateModified' => $dateTime, 'dateCreated' => $dateTime);
                $partyId = $this->Action_model->insert_to_db_with_insert_id('party', $insert_arr);
            }
            $insert_arr = array('invoiceNumber' => $OD_No, 'invoiceDate' => $OD_DateTime, 'invoiceDiscount' => $OD_Discount, 'totalAmount' => $OD_Amount,'packingCharge' => $packingCharge, 'transportCharge' => $transportCharge,'remark' => $remark ,'dateModified' => $dateTime,'partyId' => $partyId,'dateCreated' => $dateTime);
            if($pageType=='Print'){
                $insert_arr += ['isActive' => 0];
            }
            $OD_ID = $this->Action_model->insert_to_db_with_insert_id('invoice_details', $insert_arr);
            if($OD_ID){
                for($i=0; $i < COUNT($qty); $i++){
                    if($qty[$i] > 0 ){
                        $insert_arr_item = array('invoiceId' => $OD_ID, 'productId' => $PD_IDs[$i], 'itemRate' => $price[$i], 'itemDiscount' => $item_discount[$i],'unitId' => $U_IDs[$i], '	quantity' => $qty[$i], 'itemAmount' => $amount[$i], 'dateModified' => $dateTime, 'dateCreated' => $dateTime);
                        if($pageType=='Print'){
                            $insert_arr_item += ['isActive' => 0];
                        }
                        $OI_ID = $this->Action_model->insert_to_db_with_insert_id('invoice_items', $insert_arr_item);
                    }
                }
                $response = array("status" => "success", "msg" => "Invoice has been saved Successfully!");
            } else {
                $response = array("status" => "error", "msg" => "Please Try Again!");
            }
        } else {
            $response = array("status" => "error", "msg" => "Please Enter All Required Fields!");
        }
        if($pageType=='Print'){
            echo 'Invoice/Print_page/'.$OD_ID;
        }else{
            echo json_encode($response);
        }

    }	

    public function update_submit(){
        $this->load->model('Action_model');
        $this->form_validation->set_rules('invoiceId', 'Id', 'trim|required');
        $this->form_validation->set_rules('OD_No', 'Invoice Number', 'trim|required');
        $this->form_validation->set_rules('OD_Date', 'Date', 'trim|required');
        $this->form_validation->set_rules('OD_CustomerName', 'Customer Name', 'trim|required');
        if($this->form_validation->run() == TRUE){
            $dateTime = date('Y-m-d H:i:s');
            $pageType = $this->input->post("pageType");
            $OD_ID = $this->input->post("invoiceId");
            $OD_No = $this->input->post("OD_No");
            $OD_Date = date('Y-m-d', strtotime($this->input->post("OD_Date")));
            $OD_DateTime = $OD_Date.' '.date('H:i:s');
            $OD_CustomerName = $this->input->post("OD_CustomerName");
            $OD_MobileNo = $this->input->post("OD_MobileNo");
            $OD_Email = $this->input->post("OD_Email");
            $OD_Address = $this->input->post("OD_Address");
            $OD_City = $this->input->post("OD_City");
            $packing_charg_val = $this->input->post("packing_charge_val");
            $packing_charg_per = $this->input->post("packing_charge_per");
            $packingCharge = array("Percentage" => $packing_charg_per, "Amount" => $packing_charg_val);
            $packingCharge = json_encode($packingCharge, true);          
            $transport_charg_per = $this->input->post("transport_charge_per");
            $transport_charg_val = $this->input->post("transport_charge_val");
            $transportCharge = array("Percentage" => $transport_charg_per, "Amount" => $transport_charg_val);
            $transportCharge = json_encode($transportCharge, true);
            $partyId = $this->input->post("partyId");
            $PD_IDs = $this->input->post("PD_IDs");
            $U_IDs = $this->input->post("U_IDs");
            $qty = $this->input->post("qty");
            $price = $this->input->post("price");
            $item_discount = $this->input->post("item_discount");
            $remark = $this->input->post("remark");
            $amount = $this->input->post("amount");
            $OI_ID = $this->input->post("OI_ID");
            $OD_Amount = $this->input->post("Net_Amount");
            $discount_val = $this->input->post("discount_val");
            $discount_per = $this->input->post("discount_per");
            $OD_Discount = array("Percentage" => $discount_per, "Amount" => $discount_val);
            $OD_Discount = json_encode($OD_Discount, true);
            if(!$partyId){
                $insert_arr = array( 'partyName' => $OD_CustomerName, 'phone' => $OD_MobileNo,'city' => $OD_City, 'email' => $OD_Email, 'address' => $OD_Address,'dateModified' => $dateTime, 'dateCreated' => $dateTime);
                $partyId = $this->Action_model->insert_to_db_with_insert_id('party', $insert_arr);
            }
            $update_array = array('invoiceNumber' => $OD_No, 'invoiceDate' => $OD_DateTime, 'invoiceDiscount' => $OD_Discount, 'totalAmount' => $OD_Amount,'packingCharge' => $packingCharge, 'transportCharge' => $transportCharge,'remark' => $remark ,'dateModified' => $dateTime,'partyId' => $partyId);
            $update_where = array('invoiceId' => $OD_ID);
            $where = array('invoiceId' => $OD_ID);
            $update_delete = array('isDeleted' => 1);
                $this->Action_model->update_to_db('invoice_items', $where, $update_delete);
                if($this->Action_model->update_to_db('invoice_details', $update_where, $update_array) == true){
                    for($i=0; $i < COUNT($qty); $i++){
                        if(!isset($OI_ID[$i])){
                            if($qty[$i] > 0 ){
                                $insert_arr_item = array('invoiceId' => $OD_ID, 'productId' => $PD_IDs[$i], 'itemRate' => $price[$i], 'itemDiscount' => $item_discount[$i],'unitId' => $U_IDs[$i], '	quantity' => $qty[$i], 'itemAmount' => $amount[$i], 'dateModified' => $dateTime, 'dateCreated' => $dateTime);
                                if($this->Action_model->insert_to_db('invoice_items', $insert_arr_item) == true){
                                    $response = array("status" => "success", "msg" => "Successfully updated!");
                                } else {
                                    $response = array("status" => "error", "msg" => "Please Try Again.");
                                }
                            }
                        }else {
                            if($qty[$i] > 0 ){
                                $update_where_item = array('invoiceItemId' => $OI_ID[$i]);
                                $update_arr_item = array('invoiceId' => $OD_ID, 'productId' => $PD_IDs[$i], 'itemRate' => $price[$i], 'itemDiscount' => $item_discount[$i],'unitId' => $U_IDs[$i], 'quantity' => $qty[$i], 'itemAmount' => $amount[$i], 'dateModified' => $dateTime , 'isDeleted' => 0);
                                if($this->Action_model->update_to_db('invoice_items', $update_where_item, $update_arr_item) == true){
                                    $response = array("status" => "success", "msg" => "Invoice has been updated Successfully!");
                                } else {
                                    $response = array("status" => "error", "msg" => "Please Try Again.");
                                }
                            }
                        }

                    }
                }else {
                    $response = array("status" => "error", "msg" => "Please Try Again!");
                }
                }else {
                    $response = array("status" => "error", "msg" => "Please Enter All Required Fields!");
                }
                if($pageType=='Print'){
                    echo 'Invoice/Print_page/'.$OD_ID;
                }else{
                    echo json_encode($response);
                }
                }

                }
