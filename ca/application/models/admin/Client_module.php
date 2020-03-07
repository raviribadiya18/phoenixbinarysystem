<?php
Class Client_module extends CI_Model
{
 	function getAll_client()
 	{	
   		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status !=', 'Delete');
		
		$this -> db -> where('membermaster.role', 'client');
		
		$this -> db -> order_by('membermaster.usercode', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_deleted_client()
 	{	
   		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status', 'Delete');
		
		$this -> db -> where('membermaster.role', 'client');
		
		$this -> db -> order_by('membermaster.usercode', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
 	
 	function get_record($eid){
		
		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status !=', 'Delete');
		
		$this -> db -> where('membermaster.role', 'client');
		
		$this -> db -> where('membermaster.usercode', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_sub_client($eid)
 	{	
   		$this -> db -> select('sub_membermaster.*');
		
   		$this -> db -> from('sub_membermaster');
		
   		$this -> db -> where('sub_membermaster.status !=', 'Delete');
		
		//$this -> db -> where('sub_membermaster.self', '1');
		
		$this -> db -> where('sub_membermaster.usercode', ''.$eid.'');
		
		$this -> db -> order_by('sub_membermaster.id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	  function get_sub_record($eid){

			$this -> db -> select('sub_membermaster.*');

			$this -> db -> from('sub_membermaster');

			$this -> db -> where('sub_membermaster.status !=', 'Delete');

			$this -> db -> where('sub_membermaster.id', ''.$eid.'');

			$query = $this -> db -> get();

			$the_content = $query->result_array();

			return $the_content;

		}
	function get_services()
 	{	
   		$this -> db -> select('service_master.*');
		
   		$this -> db -> from('service_master');
		
   		$this -> db -> where('service_master.status', 'Active');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function getadd_invoice($eid,$sub_uid)
 	{	
   		$this -> db -> select('invoice_master.*');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status !=', 'Delete');
		
		$this -> db -> where('invoice_master.usercode', ''.$eid.'');
		
		if($sub_uid!=0){
			
			$this -> db -> where('invoice_master.sub_uid', ''.$sub_uid.'');
			
		}
		
	
		$this -> db -> order_by('invoice_master.invoice_id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_all_sub_client($eid)
 	{	
   		$this -> db -> select('sub_membermaster.*');
		
   		$this -> db -> from('sub_membermaster');
		
   		$this -> db -> where('sub_membermaster.status !=', 'Delete');
		
		$this -> db -> where('sub_membermaster.usercode', ''.$eid.'');
		
		$this -> db -> order_by('sub_membermaster.id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	
	
	function get_due_amt_all_user($usercode){
		
		$this -> db -> select('sum(due_amount) as tot_due_amt');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('invoice_master.usercode', ''.$usercode.'');
		
		//$this -> db -> where('invoice_master.sub_uid', ''.$suid.'');
		
		$this -> db -> where('invoice_master.bill_paid', 'No');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_due_amt_by_subuser($usercode,$suid){
		
		$this -> db -> select('sum(due_amount) as tot_due_amt');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('invoice_master.usercode', ''.$usercode.'');
		
		$this -> db -> where('invoice_master.sub_uid', ''.$suid.'');
		
		$this -> db -> where('invoice_master.bill_paid', 'No');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_due_amt($usercode,$suid){
		
		$this -> db -> select('sum(due_amount) as due_amt');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('invoice_master.usercode', ''.$usercode.'');
		
		$this -> db -> where('invoice_master.sub_uid', ''.$suid.'');
		
		$this -> db -> where('invoice_master.bill_paid', 'No');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_record_not_in($eid,$mobileno){
		
		$this -> db -> select('*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('mobileno', $mobileno);
		
		$this -> db -> where('role', 'client');
		
		$this -> db -> where_not_in('usercode',$eid);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_record_email_not_in($eid,$emailid){
		
		$this -> db -> select('*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('emailid', $emailid);
		
		$this -> db -> where('role', 'client');
		
		$this -> db -> where_not_in('usercode',$eid);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_income_report()
 	{	
   		$this -> db -> select('invoice_master.invoice_id, invoice_master.usercode, invoice_master.sub_uid, SUM(invoice_master.total_amt) AS tot_amt, SUM(invoice_master.due_amount) AS tot_due_amt');
		
		$this -> db -> select('CONCAT(membermaster.fname, " ", membermaster.lname) AS main_client');
		
		$this -> db -> select('CONCAT(sub_membermaster.fname, " ", sub_membermaster.lname) AS sub_client');
		
   		$this -> db -> from('invoice_master');
		
		$this -> db -> JOIN('membermaster','membermaster.usercode=invoice_master.usercode','LEFT');
		
		$this -> db -> JOIN('sub_membermaster','sub_membermaster.id=invoice_master.sub_uid','LEFT');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.status', 'Active');
		
		$this -> db -> group_by('invoice_master.sub_uid');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	
	
	
	function get_income_report_new($start_date,$end_date)
 	{	
   		$this -> db -> select('invoice_master.invoice_id, invoice_master.usercode, invoice_master.sub_uid, SUM(invoice_master.total_amt) AS tot_amt, SUM(invoice_master.due_amount) AS tot_due_amt');
		
		$this -> db -> select('CONCAT(membermaster.fname, " ", membermaster.lname) AS main_client');
		
		$this -> db -> select('CONCAT(sub_membermaster.fname, " ", sub_membermaster.lname) AS sub_client');
		
   		$this -> db -> from('invoice_master');
		
		$this -> db -> JOIN('membermaster','membermaster.usercode=invoice_master.usercode','LEFT');
		
		$this -> db -> JOIN('sub_membermaster','sub_membermaster.id=invoice_master.sub_uid','LEFT');
		
		$this -> db -> where('invoice_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.status', 'Active');
		
		$this -> db -> group_by('invoice_master.sub_uid');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	
	
}
?>
