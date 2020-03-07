<?php
Class Gst_document_module extends CI_Model
{
 	
	
	function get_all_gst()
 	{	
   		$this -> db -> select('gst_master.*');
		
   		$this -> db -> from('gst_master');
		
   		$this -> db -> where('gst_master.status', 'Active');
		
		$this -> db -> order_by('gst_master.id', 'Desc');
		
		$this -> db -> where('gst_master.usercode', $this->session->userdata['pbm_client']['usercode']);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	
	
	
}
?>
