<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Product_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_products(){ 
        $this->db->order_by('dateCreated', 'ASC');
        $query = $this->db->get_where( 'products', array('isDeleted' => 0));
        if ($query->num_rows() > 0) {
            $row = $query->result_array(); 
            return $row;
        } else {
            return false;
        }
    } 

    public function get_active_products(){ 
        $this->db->order_by('dateCreated', 'ASC');
        $query = $this->db->get_where( 'products', array('isDeleted' => 0,'isActive' => 1));
        if ($query->num_rows() > 0) {
            $row = $query->result_array(); 
            return $row;
        } else {
            return array();
        }
    } 


    public function get_product($PD_ID){         
        $Query = $this->db->get_where( 'products', array('isDeleted' => 0,'productId' => $PD_ID));
        if ($Query->num_rows() > 0) {
            return $Query->row();
        } else {
            return false;
        }
    } 


}