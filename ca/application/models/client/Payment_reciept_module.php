<?php
Class Payment_reciept_module extends CI_Model
{
 	
	
	function get_all_inovice($sub_uid)
 	{	
   		$this -> db -> select('fee_income_master.*');
		
   		$this -> db -> from('fee_income_master');
		
   		$this -> db -> where('fee_income_master.status', 'Active');
		
		$this -> db -> where('fee_income_master.usercode', ''.$this->session->userdata['pbm_client']['usercode'].'');
		
		if($sub_uid!=0){
			
			$this -> db -> where('fee_income_master.sub_uid', ''.$sub_uid.'');
			
		}
		
	
		$this -> db -> order_by('fee_income_master.id', 'Desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	
	
	
}
?>
