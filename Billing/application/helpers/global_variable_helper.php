<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('global_variables'))
{
    function global_variables(){

		$global_data = array(
			"company_name" => 'DA Billing',
			"main_title" => 'DA Billing',
			"footer_title" => 'DA Billing',
			"current_date" => date('d-m-Y'),
			"current_dateTime" => date('Y-m-d H:i:s'),
			"fromDate" => date('Y-m-01'),
			"toDate" => date('Y-m-d')
		);
        return $global_data;
    }
}

if(!function_exists('print_r1'))
{
    function print_r1($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();
	}
}