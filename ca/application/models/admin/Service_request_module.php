<?php
Class Service_request_module extends CI_Model
{
	
	function getAll_service_old()
 	{	
   		$this -> db -> select('service_request.*');
		
   		$this -> db -> from('service_request');
		
   		$this -> db -> where('service_request.status', 'Active');
		
		$this -> db -> order_by('service_request.id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
 	function getAll_service()
 	{	
   		$this -> db -> select('service_request.*');
		
		$this -> db -> select('service_master.name as service_name');
		
		$this -> db -> select('membermaster.fname,membermaster.lname');
		
		$this -> db -> select('sub_membermaster.fname as sub_fname,sub_membermaster.lname  as sub_lname');
		
   		$this -> db -> from('service_request');
		
		$this -> db -> JOIN('service_master','service_master.id=service_request.service_id','LEFT');
		
		$this -> db -> JOIN('membermaster','membermaster.usercode=service_request.usercode','LEFT');
		
		$this -> db -> JOIN('sub_membermaster','sub_membermaster.id=service_request.req_for','LEFT');
		
   		$this -> db -> where('service_request.status', 'Active');
		
		$this -> db -> where('membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.status', 'Active');
		
		$this -> db -> order_by('service_request.id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
 	
 	function get_record($eid){
		
		$this -> db -> select('service_request.*');
		
		$this -> db -> select('service_master.name as service_name');
		
		$this -> db -> select('membermaster.fname,membermaster.lname');
		
   		$this -> db -> from('service_request');
		
		$this -> db -> JOIN('service_master','service_master.id=service_request.service_id','LEFT');
		
		$this -> db -> JOIN('membermaster','membermaster.usercode=service_request.usercode','LEFT');
		
   		$this -> db -> where('service_request.status', 'Active');
		
		$this -> db -> where('service_request.id', ''.$eid.'');
		
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

  
	
}
?>
