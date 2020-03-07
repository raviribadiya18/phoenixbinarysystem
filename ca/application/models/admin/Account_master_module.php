<?php
Class Account_master_module extends CI_Model
{
 	function get_all_account()
 	{	
   		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status !=', 'Delete');
		
		$this -> db -> where('membermaster.role', 'account');
		
		$this -> db -> order_by('membermaster.usercode', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_deleted_account()
 	{	
   		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status', 'Delete');
		
		$this -> db -> where('membermaster.role', 'account');
		
		$this -> db -> order_by('membermaster.usercode', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
 	
 	function get_record($eid){
		
		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status !=', 'Delete');
		
		$this -> db -> where('membermaster.role', 'account');
		
		$this -> db -> where('membermaster.usercode', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}

  
	
}
?>
