<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Unit_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

	public function get_units(){
        $this->db->order_by('unitName', 'ASC');
		$Query = $this->db->get_where('unit' ,array('isDeleted' => 0));
        if($Query->num_rows() > 0) {
			return $Query->result_array();
		} else {
			return false;
		}
	} 

	public function get_active_units(){ 
        $this->db->order_by('unitName', 'ASC');
		$Query = $this->db->get_where('unit' ,array('isDeleted' => 0,'isActive' => 1));
        if($Query->num_rows() > 0) {
			return $Query->result_array();
		} else {
			return array();
		}
	} 

	public function get_unit($unitId){
		$Query = $this->db->get_where('unit' ,array('isDeleted' => 0,'unitId' => $unitId));
        if($Query->num_rows() > 0) {
			return $Query->row();
		} else {
			return false;
		}
	} 
}