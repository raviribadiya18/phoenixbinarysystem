<?php
Class User_module extends CI_Model
{
 	
	
	
	function get_tot_task_status($sts)
 	{	
   		$this -> db -> select('count(*) as tot_task');
		
   		$this -> db -> from('task_master');
		
   		$this -> db -> where('task_master.status', 'Active');
		
		$this -> db -> where('task_master.task_status', $sts);
		
		$this -> db -> where('task_master.task_assign', $this->session->userdata['pbm_emp']['usercode']);
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	
	
}
?>
