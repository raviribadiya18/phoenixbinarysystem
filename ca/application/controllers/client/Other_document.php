<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Other_document extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 

		if(!is_login('client')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
   		$this->load->model('client/Other_document_module','ObjM',TRUE);
		
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

		$page_info['menu_id']		=	'menu-od';
		
		$page_info['page_title']	=	'Other Document List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);
		
		$this->load->view('client/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
			
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->get_AllReports();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
			
				$record_client	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['sub_id']));
				
				if($result[$i]['upload_file']!=""){
					
					$file	=	"<a style='color:red;' href='".base_url()."upload/web/doc/".$result[$i]['upload_file']."' download>Download Document Here</a>";
					
				}else{
					
					$file	=	"-";
				}
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$record_client[0]['fname'].' '.$record_client[0]['lname'].'</td>
						<td>'.$result[$i]['title'].'</td>
						<td>'.$file.'</td>';
					
						$html.='</tr>';
		}		
		
		return $html;
	}
	
	
	
	
	
	
	
	
	
}


