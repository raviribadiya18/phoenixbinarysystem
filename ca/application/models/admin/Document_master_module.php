<?php
Class Document_master_module extends CI_Model
{
 	
	function get_document()
 	{	
   		$this -> db -> select('document_master.*');
		
		$this -> db -> select('membermaster.fname,membermaster.lname');
		
		$this -> db -> select('sub_membermaster.fname as sub_fname,sub_membermaster.lname  as sub_lname');
		
   		$this -> db -> from('document_master');
		
		$this -> db -> JOIN('membermaster','membermaster.usercode=document_master.usercode','LEFT');
		
		$this -> db -> JOIN('sub_membermaster','sub_membermaster.id=document_master.sub_id','LEFT');
		
   		$this -> db -> where('document_master.status !=', 'Delete');
		
		$this -> db -> where('membermaster.status', 'Active');
		
		$this -> db -> where('sub_membermaster.status', 'Active');
		
		$this -> db -> order_by('document_master.id', 'Desc');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}
	
	
	function get_document_old()
 	{	
   		$this -> db -> select('document_master.*');
		
   		$this -> db -> from('document_master');
		
   		$this -> db -> where('document_master.status !=', 'Delete');
		
		$this -> db -> order_by('document_master.id', 'Desc');
		
		$query = $this -> db -> get();
		
    	$the_content = $query->result_array();
		
    	return $the_content;
		
 	}

	  function get_record($eid){

			$this -> db -> select('document_master.*');

			$this -> db -> from('document_master');

			$this -> db -> where('document_master.status !=', 'Delete');

			$this -> db -> where('document_master.id', ''.$eid.'');
		  
			$query = $this -> db -> get();

			$the_content = $query->result_array();

			return $the_content;

		}
	
	
}
?>
