<?php
Class Fees_collection_module extends CI_Model
{
 	function get_all($usercode,$suid)
 	{	
   		$this -> db -> select('fee_income_master.*');
		
   		$this -> db -> from('fee_income_master');
		
   		$this -> db -> where('fee_income_master.status', 'Active');
		
		$this -> db -> where('fee_income_master.usercode', ''.$usercode.'');
		
		$this -> db -> where('fee_income_master.sub_uid', ''.$suid.'');
		
		$this -> db -> order_by('fee_income_master.id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
 	
 	function get_record($eid){
		
		$this -> db -> select('fee_income_master.*');
		
   		$this -> db -> from('fee_income_master');
		
   		$this -> db -> where('fee_income_master.status', 'Active');
		
		$this -> db -> where('fee_income_master.id', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}

	
	function get_unpaid_invoices($usercode,$suid){
		
		$this -> db -> select('*');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('invoice_master.usercode', ''.$usercode.'');
		
		$this -> db -> where('invoice_master.sub_uid', ''.$suid.'');
		
		$this -> db -> where('invoice_master.bill_paid', 'No');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_price_by_invoice($eid){
		
		$this -> db -> select('invoice_master.*');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('invoice_master.invoice_id', ''.$eid.'');
		
		$this -> db -> where('invoice_master.bill_paid', 'No');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_amount($usercode,$suid){
		
		$sQuery = 'SELECT invoice_id,total_amt,due_amount, total_amt-due_amount as paid FROM invoice_master WHERE usercode = "'.$usercode.'" and sub_uid = "'.$suid.'" and bill_paid="No" and due_amount > 0 order by invoice_id ASC';
		
    	//$query = $this -> db -> get();
		
		$query = $this->db->query($sQuery);
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_due_amt($usercode,$suid){
		
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
	
}
?>
