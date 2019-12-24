<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Customer_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

	public function getCustomerData(){ 
        $query = $this->db->get_where('party', array('isDeleted' => 0));
        if ($query->num_rows() > 0) {
			$row = $query->result_array(); 
			return $row;
		} else {
			return false;
		}
	} 
	public function getActiveCustomerData(){ 
        $this->db->select('*,partyName AS `name`');
        $query = $this->db->get_where('party', array('isDeleted' => 0,'isActive' => 1));
        if ($query->num_rows() > 0) {
			$row = $query->result_array(); 
			return $row;
		} else {
			return false;
		}
	} 

	public function getCustomerDetail($C_ID){ 
		$query = $this->db->get_where('party', array('partyId' => $C_ID ,'isDeleted' => 0));
        if ($query->num_rows() > 0) {
			$row = $query->row(); 
			return $row;
		} else {
			return false;
		}
	} 
    
}