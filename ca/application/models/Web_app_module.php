<?php
Class Web_app_module extends CI_Model
{
 	
	// function login($arr){
		
	// 	$this -> db -> select('*');
		
	// 	$this -> db -> from('membermaster');
		
	// 	$this -> db -> where('username',''.$arr['username'].'');
		
	// 	$this -> db -> where('password',''.$arr['password'].'');
		
	// 	$this -> db -> where('role','client');
		
	// 	$this -> db -> where('status','Active');
		
 //    	$query = $this -> db -> get();
		
 //    	$the_content = $query->result_array();
		
 //    	return $the_content;
		
	// }
		function login($arr){
		
		$this -> db -> select('*');
		
		$this -> db -> from('membermaster');
		
		$this -> db -> where('mobileno',''.$arr['mobileno'].'');
		
		$this -> db -> where('role','client');
		
		$this -> db -> where('status','Active');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}

	function get_otpverify($arr){
		
		$this -> db -> select('*');
		
		$this -> db -> from('membermaster');
		
		$this -> db -> where('mobileno',''.$arr['mobileno'].'');
		
		$this -> db -> where('otp',''.$arr['otp'].'');
		
		$this -> db -> where('role','client');
		
		$this -> db -> where('status','Active');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_users($usercode)
 	{	
   		$this -> db -> select('*');
		
   		$this -> db -> from('sub_membermaster');
		
   		$this -> db -> where('sub_membermaster.status', 'Active');
		
		//$this -> db -> where('sub_membermaster.self', '1');
		
		$this -> db -> order_by('sub_membermaster.id', 'Desc');

		$this -> db -> where('sub_membermaster.usercode', $usercode);
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_client_list($usercode)
 	{	
   		$this -> db -> select('sub_membermaster.*');
		
   		$this -> db -> from('sub_membermaster');
		
   		$this -> db -> where('sub_membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.usercode', $usercode);
		
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
	
	function get_user_profile($usercode){
		
		$this -> db -> select('*');
		
		$this -> db -> from('membermaster');
		
		$this -> db -> where('usercode',$usercode);
		
		$this -> db -> where('role','client');
		
		$this -> db -> where('status','Active');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_usernotification($usercode)
	{
		$this -> db -> select('notification.*');
		
 		$this -> db -> from('notification');
		
		$this -> db -> join('notification_dt','notification_dt.noti_code = notification.noti_code','left');

		$this -> db -> where('notification_dt.usercode',$usercode);
		
		$this -> db -> where('notification.status','Active');
		
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
		
		//$this -> db -> order_by('create_date','DESC');
		
		//$this -> db -> order_by('noti_code','DESC');
		
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
		
		$this -> db -> where('notification.status','Active');
		
   		$query = $this -> db -> get();
		
	  	$the_content = $query->result_array();
		
		return $the_content;
		
	}
	
	function get_all_itr($usercode,$sub_id)
 	{	
   		$this -> db -> select('itr_doc_master.*');
		
   		$this -> db -> from('itr_doc_master');
		
   		$this -> db -> where('itr_doc_master.status', 'Active');
		
		$this -> db -> order_by('itr_doc_master.id', 'Desc');
		
		$this -> db -> where('itr_doc_master.usercode', $usercode);
		
		$this -> db -> where('itr_doc_master.sub_id', $sub_id);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_all_gst($usercode,$sub_id)
 	{	

   		$this -> db -> select('*');
		
   		$this -> db -> from('gst_master');
		
   		$this -> db -> where('gst_master.status', 'Active');
		
		$this -> db -> order_by('gst_master.id', 'Desc');
		
		$this -> db -> where('gst_master.usercode', $usercode);
		
		$this -> db -> where('gst_master.sub_id', $sub_id);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

 	function get_all_roc($usercode,$sub_id)
 	{	

   		$this -> db -> select('*');
		
   		$this -> db -> from('roc_master');
		
   		$this -> db -> where('roc_master.status', 'Active');
		
		$this -> db -> order_by('roc_master.id', 'Desc');
		
		$this -> db -> where('roc_master.usercode', $usercode);
		
		$this -> db -> where('roc_master.sub_id', $sub_id);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_all_other_document($usercode,$sub_id)
 	{	
   		$this -> db -> select('document_master.*');
		
   		$this -> db -> from('document_master');
		
   		$this -> db -> where('document_master.status', 'Active');
		
		$this -> db -> order_by('document_master.id', 'Desc');
		
		$this -> db -> where('document_master.usercode', $usercode);
		
		$this -> db -> where('document_master.sub_id', $sub_id);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_due_amt_all_user($usercode){
		
		$this -> db -> select('sum(due_amount) as tot_due_amt');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('invoice_master.usercode', ''.$usercode.'');
		
		$this -> db -> where('invoice_master.bill_paid', 'No');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_due_amt_by_subuser($usercode,$sub_id){
		
		$this -> db -> select('sum(due_amount) as tot_due_amt');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status', 'Active');
		
		$this -> db -> where('invoice_master.usercode', ''.$usercode.'');
		
		$this -> db -> where('invoice_master.sub_uid', ''.$sub_id.'');
		
		$this -> db -> where('invoice_master.bill_paid', 'No');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function addItem($data,$table){
		
    	$this->db->insert($table , $data);
		
    	return $this->db->insert_id();
		
	}
	
	function update($data,$table,$where){
		
		$this->db->where($where);
		
		$this->db->update($table, $data); 
		
	}
	
	function add_notification($arr = array()){
		
		if(!empty($arr)){
		
			$data = array(
				
				'type' 		=> 	(isset($arr['type'])) ? $arr['type'] : '',
				
				'class_type' => 	(isset($arr['class_type'])) ? $arr['class_type'] : '',
				
				'usercode_sender'  => (isset($arr['usercode_sender'])) ? $arr['usercode_sender'] : '0',
				
				'usercode_reciever' => (isset($arr['usercode_reciever'])) ? $arr['usercode_reciever'] : '0',
				
				'message' 	=> (isset($arr['message'])) ? $arr['message'] : '0',
				
				'rec_id' 	=> (isset($arr['rec_id'])) ? $arr['rec_id'] : '0',
		
				'status' 	=> 0,
				
				'timedt' 	=> time()
			
			);
			
			$id = $this->comman_fun->addItem($data,'notification_master');
		
		}
		
	}
	
	function get_All_doc($usercode,$sub_id)
 	{	
   		$this -> db -> select('*');
		
   		$this -> db -> from('other_document_master');
		
   		$this -> db -> where('other_document_master.status', 'Active');
		
		$this -> db -> where('other_document_master.usercode', $usercode);
		
		$this -> db -> where('other_document_master.sub_id', $sub_id);
		
		$this -> db -> order_by('other_document_master.id', 'Desc');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

 	function get_test($usercode,$sub_id,$id)
 	{	
   		$this -> db -> select('*');
		
   		$this -> db -> from('gst_master');
		
   		$this -> db -> where('status', 'Active');
		
		$this -> db -> where('usercode', $usercode);
		
		//$this -> db -> where('sub_id', $sub_id);
		
		$this -> db -> where('id', $id);

		$this -> db -> order_by('id', 'Desc');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	
}
?>
