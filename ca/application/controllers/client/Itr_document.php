<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itr_document extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 

		
		if(!is_login('client')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        } 

   		$this->load->model('client/Itr_document_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

 	}
	
	public function index()
	{
		
		$this->view();
		
	}
	
	public function view(){
		
		
		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-itr';
		
		$page_info['page_title']	=	'ITR Document List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);
		
		$this->load->view('client/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
			
		
	}
	
	
	
	function listing(){
	
		$result=$this->ObjM->get_all_itr();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
				if($result[$i]['is_paid']=="yes"){
					
						if($result[$i]['upload_file']!=""){

							$file	=	"<a style='color:red;' href='".base_url()."upload/web/itr_doc/".$result[$i]['upload_file']."' download>Download ITR file Here</a>";

						}else{

							$file	=	"-";
						}
					
				}else{
					
					if($result[$i]['allow_download']=="Yes"){
							
							if($result[$i]['upload_file']!=""){

								$file	=	"<a href='".base_url()."upload/web/itr_doc/".$result[$i]['upload_file']."' download><span style='color:red;font-size:15px;'>Download File Here.</span></a>";

							}else{

								$file	=	"-";
							}
							
					}else{

						$file="<span style='color:red;font-size:15px;'>Please Pay fees to download file.</span>";
					}	
				}
			
				$record_client	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['sub_id']));
			
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$record_client[0]['fname'].' '.$record_client[0]['lname'].'</td>
						<td>'.$result[$i]['type'].'</td>
						<td>'.$result[$i]['title'].'</td>
						<td>'.$file.'</td>';
					
						$html.='</tr>';
		}		
		
		return $html;
	}
	
	
	
	
	
	
	
	
	
}


