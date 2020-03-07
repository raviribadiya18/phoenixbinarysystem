<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_request extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		ob_start();
		
		ob_end_flush();
		
   		$this->load->model('admin/Service_request_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-service_request';
		
		$page_info['page_title']	=	'Service Request';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->getAll_service();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
				if($result[$i]['seen']=='Yes'){
					$current_status='Yes';
					$update_status='No';
					$cls='btn-success';
				}
				else{
					$current_status='No';
					$update_status='Yes';
					$cls='btn-danger';
				}
			
				//$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$result[$i]['usercode']));
			
				//$record_sm	=	$this->comman_fun->get_table_data('service_master',array('id'=>$result[$i]['service_id']));
				
				//$record_smbr	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['req_for']));

				$person_name 	= $result[$i]['sub_fname'].' '.$result[$i]['sub_lname'];
					
				
			
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['fname'].' '.$result[$i]['lname'].'</td>
						<td>'.$person_name.'</td>
						<td>'.$result[$i]['service_name'].'</td>
						<td>'.$result[$i]['request_details'].'</td>
						<td>'.date('d-m-Y',strtotime($result[$i]['create_date'])).'</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.'  </button>
						<ul class="dropdown-menu pull-right">
						<li><a href="'.file_path('admin').''.$this->uri->rsegment(1).'/req_view/'.$result[$i]['id'].'">View</a></li>
						';
							
							$html.='<li><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['id'].'">Delete</a></li>';
							
							
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	function listing_old(){
	
	
		$result=$this->ObjM->getAll_service();
		
		$html='';
		
		for($i=0;$i<count($result);$i++){
				
				if($result[$i]['seen']=='Yes'){
					$current_status='Yes';
					$update_status='No';
					$cls='btn-success';
				}
				else{
					$current_status='No';
					$update_status='Yes';
					$cls='btn-danger';
				}
			
				$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$result[$i]['usercode']));
			
				$record_sm	=	$this->comman_fun->get_table_data('service_master',array('id'=>$result[$i]['service_id']));
				
				$record_smbr	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['req_for']));

				$person_name 	= $record_smbr[0]['fname'].' '.$record_smbr[0]['lname'];
					
				
			
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$record[0]['fname'].' '.$record[0]['lname'].'</td>
						<td>'.$person_name.'</td>
						<td>'.$record_sm[0]['name'].'</td>
						<td>'.$result[$i]['request_details'].'</td>
						
						
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.'  </button>
						<ul class="dropdown-menu pull-right">
						<li><a href="'.file_path('admin').''.$this->uri->rsegment(1).'/req_view/'.$result[$i]['id'].'">View</a></li>
						';
							
							//$html.='<li><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/view/'.$result[$i]['id'].'">View</a></li>';
							
							
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	
	function req_view($eid){
		
		
		$data['seen'] = "Yes";
		
		$this->comman_fun->update($data,'service_request',array('id'=>$eid));
		
		
	//	$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record updated Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/service_request_view/".$eid."");
		
	}
	
	function service_request_view($eid){
		
		
			
		$data['result']		=	$this->ObjM->get_record($eid);
		
		
		$page_info['menu_id']		=	'menu-service_request';
		
		$page_info['page_title']	=	'Service Request';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);;

		$this->load->view('admin/'.$this->uri->rsegment(1).'_detail_view',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
		
	
	
	
	
	function addnew($mode=NULL, $eid=NULL){
		
		
		if($mode=='edit')
		{
			$data['form_set']	=	array('mode'=>'edit','eid'=>$eid);
			
			$data['result']		=	$this->ObjM->get_record($eid);
			
		}else{
			$data['form_set']=array('mode'=>'add');
			
		}
	
		
		$page_info['menu_id']		=	'menu-service_request';
		
		$page_info['page_title']	=	'Service Request';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);;

		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			
			$this->form_validation->set_rules('name','Name', 'required|trim');
			
			$this->form_validation->set_rules('text_details','Service Details', 'required|trim');
			
			
			if ($this->form_validation->run() === FALSE){
				
				$this->addnew($_POST['mode'],$_POST['eid']);
			}
			else
			{	
			
				
				$this->_insert();
				
				
				echo '<script>window.location.href="'.file_path('admin').''.$this->uri->rsegment(1).'/view"</script>';
				
				header('Location: '.file_path('admin').''.$this->uri->rsegment(1).'/view');
				
				exit;

			}
			
			
			

		}
	}
	
	
	
	protected function _insert(){
		
		$data=array();
	
		$data['name']			=	filter_data($_POST['name']);
			
		$data['text_details']	=	filter_data($_POST['text_details']);

		
		
		if($_POST['mode']=='add')
		{
			$data['status']			=	'Active';
			
			$data['create_date']	=	date('Y-m-d h:i:s');
		
			$this->comman_fun->additem($data,'service_master');
			
			$this->session->set_flashdata("success", "Record Insert Successfully.....");
			
		}
		if($_POST['mode']=='edit')
		{
			
			$data['update_time']	=	date('Y-m-d h:i:s');	
			
			$this->comman_fun->update($data,'service_master',array('id'=>$_POST['eid']));
			
			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}
		
		
			
	}
	
	
	

	function status_update($st,$eid){
		
		$record	=	$this->comman_fun->get_table_data('service_master',array('id'=>$eid));
		
		$data['seen'] = "Yes";
		
		$this->comman_fun->update($data,'service_master',array('id'=>$eid));
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Status '.$st.' Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
		
	}
	
	
	function delete_record($eid){
		
		$record	=	$this->comman_fun->get_table_data('service_request',array('id'=>$eid));
		
		$data['status'] = 'Delete';
		
		$this->comman_fun->update($data,'service_request',array('id'=>$eid));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
	}
	
	
	
	
}


