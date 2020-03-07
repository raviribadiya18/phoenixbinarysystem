<?php
Class Task_mgmt_module extends CI_Model
{
 	function getAll_task()
 	{	
   		$this -> db -> select('task_master.*');
		
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.username');
		
		$this -> db -> select('sub_membermaster.fname as sub_fname,sub_membermaster.lname  as sub_lname');
		
   		$this -> db -> from('task_master');
		
		$this -> db -> JOIN('membermaster','membermaster.usercode=task_master.usercode','LEFT');
		
		$this -> db -> JOIN('sub_membermaster','sub_membermaster.id=task_master.c_id','LEFT');
		
		$this -> db -> where('membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.status', 'Active');
		
   		$this -> db -> where('task_master.status', 'Active');
		
		$this -> db -> where('task_master.task_assign', $this->session->userdata['pbm_emp']['usercode']);
		
		$this -> db -> order_by('task_master.id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
 	
 	function get_record($eid){
		
		$this -> db -> select('task_master.*');
		
   		$this -> db -> from('task_master');
		
   		$this -> db -> where('task_master.status', 'Active');
		
		$this -> db -> where('task_master.id', ''.$eid.'');
		
		$this -> db -> where('task_master.task_assign', $this->session->userdata['pbm_emp']['usercode']);
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function getAll_emp()
 	{	
   		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status !=', 'Delete');
		
		$this -> db -> where('membermaster.role', 'emp');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

  
	
}
?>
