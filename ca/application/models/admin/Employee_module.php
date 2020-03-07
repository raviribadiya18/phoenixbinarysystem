<?php
Class Employee_module extends CI_Model
{
 	function getAll_emp()
 	{	
   		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status !=', 'Delete');
		
		$this -> db -> where('membermaster.role', 'emp');
		
		$this -> db -> order_by('membermaster.usercode', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_deleted_emp()
 	{	
   		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status', 'Delete');
		
		$this -> db -> where('membermaster.role', 'emp');
		
		$this -> db -> order_by('membermaster.usercode', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
 	
 	function get_record($eid){
		
		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status !=', 'Delete');
		
		$this -> db -> where('membermaster.role', 'emp');
		
		$this -> db -> where('membermaster.usercode', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}

  function get_record_not_in($eid,$mobileno){
		
		$this -> db -> select('*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('mobileno', $mobileno);
		
		$this -> db -> where('role', 'emp');
		
		$this -> db -> where_not_in('usercode',$eid);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
 function get_record_email_not_in($eid,$emailid){
		
		$this -> db -> select('*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('emailid', $emailid);
		
		$this -> db -> where('role', 'emp');
		
		$this -> db -> where_not_in('usercode',$eid);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
}
?>
