<?php
class Invoice_model extends CI_Model {

    function __construct(){
        $this->load->database();
    }

    public function getOrders(){ 

        $this->db->select('details.*,party.partyName');
        $this->db->from('invoice_details as details');
        $this->db->join('party', 'party.partyId = details.partyId');
        $this->db->where(array('details.isDeleted' => 0,'details.isActive' => 1));
        $Query = $this->db->get();
        if($Query->num_rows() > 0) {
            return $Query->result_array();
        } else {
            return false;
        }
    }
    public function last_invoiceNo(){ 
        $this->db->select('invoiceNumber');
        $this->db->order_by('invoiceId', 'DESC');
        $Query = $this->db->get('invoice_details',1);
        if($Query->num_rows() > 0) {
            return $Query->row();
        } else {
            return false;
        }
    }

    public function getItemByInvoice($OD_ID){
        $this->db->select('invoiceItemId');
        $this->db->from('invoice_items');
        $this->db->where(array('isDeleted' => 0,'invoiceId' => $OD_ID));
        $Query = $this->db->get();
        if($Query->num_rows() > 0) {
            return $Query->result_array();
        } else {
            return false;
        }
    }

    public function getOrder($OD_ID){ 
        $this->db->select('details.*,party.*');
        $this->db->from('invoice_details as details');
        $this->db->join('party', 'party.partyId = details.partyId');
        $this->db->where(array('details.isDeleted' => 0,'details.invoiceId' => $OD_ID));
        $Query = $this->db->get();
        if($Query->num_rows() > 0) {
            $Data = $Query->row();
            $Data->packingCharge = json_decode($Data->packingCharge,true);
            $Data->transportCharge = json_decode($Data->transportCharge,true);
            $Data->invoiceDiscount = json_decode($Data->invoiceDiscount,true);
            $this->db->select('items.*,products.productName,unit.unitName');
            $this->db->from('invoice_items as items');
            $this->db->join('products', 'products.productId = items.productId');
            $this->db->join('unit', 'unit.unitId = items.unitId');
            $this->db->where(array('items.isDeleted' => 0,'items.invoiceId' => $OD_ID));
            $Invoice_Item_Query = $this->db->get();
            if($Invoice_Item_Query->num_rows() > 0) {
                $Data->OrderItems = $Invoice_Item_Query->result_array();
            }
            $Query2 = $this->db->query("SELECT invoiceId FROM invoice_details WHERE isDeleted=0 and invoiceId > $OD_ID limit 1");
            if($Query2->num_rows()>0){
                $Data->next_id = $Query2->row()->invoiceId;
            } else {
                $Data->next_id = false;
            }
            $Query3 = $this->db->query("SELECT invoiceId FROM invoice_details WHERE isDeleted=0 and invoiceId < $OD_ID ORDER BY invoiceId DESC limit 1");
            if($Query3->num_rows()>0){
                $Data->previous_id = $Query3->row()->invoiceId;
            } else {
                $Data->previous_id = false;
            }
            return $Data;
        } else {
            return false;
        }
    } 

}