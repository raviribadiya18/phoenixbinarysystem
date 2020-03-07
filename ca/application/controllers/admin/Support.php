<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');
		
		$this->load->model('admin/support_module','ObjM',TRUE);
		
 	}
		
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-support';
		
		$page_info['page_title']	=	'Support';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->get_support();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
				//$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$result[$i]['usercode']));	
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['message'].'</td>
						<td>'.date('d-m-Y',strtotime($result[$i]['create_date'])).'</td>
						<td><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['usercode'].'">Delete</a></td>
						
					</tr>';
						$html.='<li></li>';
		}		
		
		return $html;
	}
	
	function delete_record($eid){
		$record	=	$this->comman_fun->get_table_data('support_master',array('usercode'=>$eid));
		
		$data['status'] = 'Delete';
		
		$this->comman_fun->update($data,'support_master',array('usercode'=>$eid));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
	}
	
	
	
	
	

}


