<?php
Class Other_document_module extends CI_Model
{
 	
	
	function get_AllReports()
 	{	
   		$this -> db -> select('other_document_master.*');
		
   		$this -> db -> from('other_document_master');
		
   		$this -> db -> where('other_document_master.status', 'Active');
		
		$this -> db -> where('other_document_master.usercode', $this->session->userdata['pbm_client']['usercode']);
		
		$this -> db -> order_by('other_document_master.id', 'Desc');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	 
	
}
?>
