<?php
Class My_invoices_module extends CI_Model
{
 	
	
	function get_all_inovice($sub_uid)
 	{	
   		$this -> db -> select('invoice_master.*');
		
   		$this -> db -> from('invoice_master');
		
   		$this -> db -> where('invoice_master.status !=', 'Delete');
		
		$this -> db -> where('invoice_master.usercode', ''.$this->session->userdata['pbm_client']['usercode'].'');
		
		if($sub_uid!=0){
			
			$this -> db -> where('invoice_master.sub_uid', ''.$sub_uid.'');
			
		}
		
	
		$this -> db -> order_by('invoice_master.invoice_id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	
	
	
}
?>
