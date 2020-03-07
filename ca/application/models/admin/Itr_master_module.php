<?php
Class Itr_master_module extends CI_Model
{
 	
	
	function get_all_itr()
 	{	
   		$this -> db -> select('itr_doc_master.*');
		
		$this -> db -> select('membermaster.fname,membermaster.lname');
		
		$this -> db -> select('sub_membermaster.fname as sub_fname,sub_membermaster.lname  as sub_lname');
		
   		$this -> db -> from('itr_doc_master');
		
		$this -> db -> JOIN('membermaster','membermaster.usercode=itr_doc_master.usercode','LEFT');
		
		$this -> db -> JOIN('sub_membermaster','sub_membermaster.id=itr_doc_master.sub_id','LEFT');
		
   		$this -> db -> where('itr_doc_master.status !=', 'Delete');
		
		$this -> db -> where('membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.status', 'Active');
		
		$this -> db -> order_by('itr_doc_master.id', 'Desc');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	function get_all_itr_old()
 	{	
   		$this -> db -> select('itr_doc_master.*');
		
   		$this -> db -> from('itr_doc_master');
		
   		$this -> db -> where('itr_doc_master.status !=', 'Delete');
		
		$this -> db -> order_by('itr_doc_master.id', 'Desc');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	  function get_record($eid){

			$this -> db -> select('itr_doc_master.*');

			$this -> db -> from('itr_doc_master');

			$this -> db -> where('itr_doc_master.status !=', 'Delete');

			$this -> db -> where('itr_doc_master.id', ''.$eid.'');
		  
			$query = $this -> db -> get();

			$the_content = $query->result_array();

			return $the_content;

		}
	
	function get_all_client_list()
 	{	
   		$this -> db -> select('membermaster.*');
		
   		$this -> db -> from('membermaster');
		
   		$this -> db -> where('membermaster.status', 'Active');
		
		$this -> db -> where('membermaster.role', 'client');
		
		$this -> db -> order_by('membermaster.usercode', 'desc');
		
    	$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	
}
?>
