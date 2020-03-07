<?php
Class Support_module extends CI_Model
{
	

	function get_support()
 	{	
   		$this -> db -> select('support_master.*');
		
		$this -> db -> select('membermaster.fname,membermaster.lname,membermaster.mobileno');
		
   		$this -> db -> from('support_master');
		
		$this -> db -> JOIN('membermaster','membermaster.usercode=support_master.usercode','LEFT');
		
		$this -> db -> where('membermaster.status', 'Active');
		
   		$this -> db -> where('support_master.status', 'Active');
		
		$this -> db -> order_by('support_master.id', 'Desc');

    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}	
		
	
	
}
?>
