<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document_master extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		ob_start();
		
		ob_end_flush();
		
   		$this->load->model('admin/Document_master_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-document_master';
		
		$page_info['page_title']	=	'Document List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->get_document();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
				if($result[$i]['status']=='Active'){
					$current_status='Active';
					$update_status='Inactive';
					$cls='btn-success';
				}
				else{
					$current_status='Inactive';
					$update_status='Active';
					$cls='btn-danger';
				}
			
				//$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$result[$i]['usercode']));
			
				//$record_client	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['sub_id']));
				
				if($result[$i]['upload_file']!=""){
					
					$file	=	"<a href='".base_url()."upload/web/doc/".$result[$i]['upload_file']."' download>Download File Here</a>";
					
				}else{
					
					$file	=	"-";
				}
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['sub_fname'].' '.$result[$i]['sub_lname'].'</td>
						<td>'.$result[$i]['doc_details'].'</td>
						<td>'.$file.'</td>
						
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.'  </button>
						<ul class="dropdown-menu pull-right">';
							
						$html.='<li><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['id'].'">Delete</a></li>';
							
							
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	
	
	
	function delete_record($eid){
		
		$record	=	$this->comman_fun->get_table_data('document_master',array('id'=>$eid));
		
		$data['status'] = 'Delete';
		
		$url='./upload/web/doc/'.$record[0]['upload_file'];
		
		unlink($url);
		
		$this->comman_fun->update($data,'document_master',array('id'=>$eid));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
	}
	
	
	
	
}


