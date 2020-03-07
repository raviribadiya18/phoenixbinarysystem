<?php
Class User_module extends CI_Model
{
 	
	
	function get_sub_client()
 	{	
   		$this -> db -> select('sub_membermaster.*');
		
   		$this -> db -> from('sub_membermaster');
		
   		$this -> db -> where('sub_membermaster.status', 'Active');
		
		//$this -> db -> where('sub_membermaster.self', '1');
		
		$this -> db -> order_by('sub_membermaster.id', 'Desc');

		$this -> db -> where('sub_membermaster.usercode', $this->session->userdata['pbm_client']['usercode']);
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	  function get_sub_record($eid){

			$this -> db -> select('sub_membermaster.*');

			$this -> db -> from('sub_membermaster');

			$this -> db -> where('sub_membermaster.status', 'Active');

			$this -> db -> where('sub_membermaster.id', ''.$eid.'');
		  
		    $this -> db -> where('sub_membermaster.usercode', $this->session->userdata['pbm_client']['usercode']);

			$query = $this -> db -> get();

			$the_content = $query->result_array();

			return $the_content;

		}
	function get_tot_user()
 	{	
   		$this -> db -> select('count(*) as tot_user');
		
   		$this -> db -> from('sub_membermaster');
		
   		$this -> db -> where('sub_membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.self', '1');

		$this -> db -> where('sub_membermaster.usercode', $this->session->userdata['pbm_client']['usercode']);
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_notification_by_send_type($arr)
	{
		$this -> db -> select('notification.*');
		
 		$this -> db -> from('notification');
		
		$this -> db -> where('send_type',''.$arr[0].'');
	
		$this -> db -> where('notification.status','Active');
		
		$this -> db -> order_by('notification.noti_code','DESC');
		
   		$query = $this -> db -> get();
		
	  	$the_content = $query->result_array();
		
		return $the_content;
	}
	
	function get_notification_by_pericular($arr)
	{
		$this -> db -> select('notification.*');
		
 		$this -> db -> from('notification');
		
		$this -> db -> join('notification_dt','notification_dt.noti_code = notification.noti_code','left');
		
		$this -> db -> where('notification.send_type',''.$arr['send_type'].'');
		
		$this -> db -> where('notification_dt.usercode',''.$arr['usercode'].'');
		
		$this -> db -> order_by('notification.noti_code','DESC');
		
		$this -> db -> where('notification.status','Active');
		
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
	
}
?>
