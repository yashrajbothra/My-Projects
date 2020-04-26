<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Action_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_to_db($table_name, $data){
        $Query = $this->db->insert($table_name, $data);
        if($Query){
            return true;
        } else {
            return false;
        }
    }

    public function insert_to_db_with_insert_id($table_name,$data){ 
        $Query = $this->db->insert($table_name,$data);
        if($Query){
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update_to_db($table_name, $update_where, $data){
        $this->db->where($update_where);
        $Query = $this->db->update($table_name, $data);
        if($Query){
            return true;
        } else {
            return false;
        }
    }

    public function check_order_exist($OD_No){
        $Query = $this->db->get_where('invoice_details' ,array('invoiceNumber' => $OD_No , 'isActive' => 1));
        if($Query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


}