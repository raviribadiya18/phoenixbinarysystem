<?php
Class Service_request_module extends CI_Model
{
 	function getAll_service()
 	{	
   		$this -> db -> select('service_request.*');
		
   		$this -> db -> from('service_request');
		
   		$this -> db -> where('service_request.status !=', 'Delete');
		
		$this -> db -> order_by('service_request.id', 'Desc');
		
		$this -> db -> where('service_request.usercode', $this->session->userdata['pbm_client']['usercode']);
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
 	
 	function get_record($eid){
		
		$this -> db -> select('service_request.*');
		
   		$this -> db -> from('service_request');
		
   		$this -> db -> where('service_request.status !=', 'Delete');
		
		$this -> db -> where('service_request.id', ''.$eid.'');
		
		$this -> db -> where('service_request.usercode', $this->session->userdata['pbm_client']['usercode']);
		
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
	
	function get_client_list()
 	{	
   		$this -> db -> select('sub_membermaster.*');
		
   		$this -> db -> from('sub_membermaster');
		
   		$this -> db -> where('sub_membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.usercode', $this->session->userdata['pbm_client']['usercode']);
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
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
	
	function updateNotificationStatus(){
	
		$data = array(
			
			'status' => 1
			
		);
		
		$this->comman_fun->update($data,'notification_master',array('usercode'=> user_session('usercode'),'status'=>0));	
	
	}
	
	function updateQuickNotificationStatus(){
		
		$data = array(
			
			'quick_view' => 1
			
		);
		
		$this->comman_fun->update($data,'notification_master',array('usercode'=> user_session('usercode'),'quick_view'=>0));
		
	}
	
	function getQuickNotificationList(){
		
		$sQuery ='
		
		SELECT notification_master.*, 
		
		CONCAT(m.fname," ",m.lname) as member_name,m.username,
		
		FROM notification_master 
		
		LEFT JOIN membermaster as m   ON  m.usercode = notification_master.usercode_sender

		WHERE notification_master.usercode_reciever = "1"  AND notification_master.status = "0" AND notification_master.quick_view = "0"
		
		ORDER BY notification_master.timedt DESC';
			
		$query = $this->db->query($sQuery);
			
		$the_content = $query->result_array();
			
		return $the_content;
		
	}
	
}
?>
