<?php
Class Itr_document_module extends CI_Model
{
 	
	
	function get_all_itr()
 	{	
   		$this -> db -> select('itr_doc_master.*');
		
   		$this -> db -> from('itr_doc_master');
		
   		$this -> db -> where('itr_doc_master.status', 'Active');
		
		$this -> db -> order_by('itr_doc_master.id', 'Desc');
		
		$this -> db -> where('itr_doc_master.usercode', $this->session->userdata['pbm_client']['usercode']);
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	
	
	
}
?>
