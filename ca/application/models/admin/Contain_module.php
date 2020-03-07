<?php
Class Contain_module extends CI_Model
{
 	function getAll($eid)
 	{	
   		$this -> db -> select('web_contain.*');
		
   		$this -> db -> from('web_contain');
		
   		$this -> db -> where('web_contain.status !=', 'Delete');
		
		$this -> db -> where('web_contain.option_type', ''.$eid.'');
		
		$this -> db -> order_by('web_contain.code', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
 	
 	function get_record($eid){
		
		$this -> db -> select('web_contain.*');
		
   		$this -> db -> from('web_contain');
		
   		$this -> db -> where('web_contain.status !=', 'Delete');
		
		$this -> db -> where('web_contain.code', ''.$eid.'');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	function get_all_feedback(){
		
		$this -> db -> select('feedback_master.*');
		
   		$this -> db -> from('feedback_master');
		
   		$this -> db -> where('feedback_master.status !=', 'Delete');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
	}
	
	
	
	
  	
  
	
}
?>
