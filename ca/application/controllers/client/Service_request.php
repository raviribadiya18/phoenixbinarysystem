<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_request extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_login('client')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
   		$this->load->model('client/Service_request_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-service_request';
		
		$page_info['page_title']	=	'Service Request';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);
		
		$this->load->view('client/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->getAll_service();
		
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
		
				$record	=	$this->comman_fun->get_table_data('service_master',array('id'=>$result[$i]['service_id']));
				
				
				$record_smbr	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['req_for']));

				$person_name = $record_smbr[0]['fname'].' '.$record_smbr[0]['lname'];
					
				
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$person_name.'</td>
						<td>'.$record[0]['name'].'</td>
						<td>'.$result[$i]['request_details'].'</td>
						<td>'.$result[$i]['seen'].'</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							
							<li><a class="status_change" href="'.file_path('client').''.$this->uri->rsegment(1).'/status_update/'.$update_status.'/'.$result[$i]['id'].'">'.$update_status.'</a></li>
							<li><a href="'.file_path('client').''.$this->uri->rsegment(1).'/addnew/edit/'.$result[$i]['id'].'">Edit</a></li>';
							
							$html.='<li><a class="delete_record" href="'.file_path('client').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['id'].'">Delete</a></li>';
							
							
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	function addnew($mode=NULL, $eid=NULL){
		
		
		if($mode=='edit')
		{
			$data['form_set']	=	array('mode'=>'edit','eid'=>$eid);
			
			$data['result']		=	$this->ObjM->get_record($eid);
			
		}else{
			$data['form_set']=array('mode'=>'add');
			
		}
	
		$data['services']	=$this->ObjM->get_services();
		
		$data['user']	=$this->ObjM->get_client_list();
		
		//echo $this->db->last_query();exit;
		
		$page_info['menu_id']		=	'menu-service_request';
		
		$page_info['page_title']	=	'Service Request';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);;

		$this->load->view('client/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			
			$this->form_validation->set_rules('service_id','service', 'required|trim');
			
			$this->form_validation->set_rules('req_for','Request for', 'required|trim');
			
			$this->form_validation->set_rules('request_details','Service Details', 'required|trim');
			
			
			if ($this->form_validation->run() === FALSE){
				
				$this->addnew($_POST['mode'],$_POST['eid']);
			}
			else
			{	
			
				
				$this->_insert();
				
				
				echo '<script>window.location.href="'.file_path('client').''.$this->uri->rsegment(1).'/view"</script>';
				
				header('Location: '.file_path('client').''.$this->uri->rsegment(1).'/view');
				
				exit;

			}
			
			
			

		}
	}
	
	
	
	protected function _insert(){
		
		$data=array();
	
		$data['service_id']			=	filter_data($_POST['service_id']);
		
		$data['req_for']			=	filter_data($_POST['req_for']);
			
		$data['request_details']	=	filter_data($_POST['request_details']);

		$data['usercode']			=	$this->session->userdata['pbm_client']['usercode'];
		
		if($_POST['mode']=='add')
		{
			$data['status']			=	'Active';
			
			$data['seen']			=	'No';
			
			$data['add_from']		= 	'App';
			
			$data['create_date']	=	date('Y-m-d h:i:s');
		
			$id_s=$this->comman_fun->additem($data,'service_request');
			
			$this->session->set_flashdata("success", "We will contact you soon.....");
			
			
			$notification_data = array(
						
				'type'       => 'add_service_request',
				
				'class_type' => 'service_request',
				
				'usercode_sender'   =>$this->session->userdata['pbm_client']['usercode'],
				
				'rec_id'       => $id_s,
				
				'usercode_reciever'  => '1',
				
				'message'	 => 'Sent Service Request.',
				
			);
			
			$this->ObjM->add_notification($notification_data);
			
		}
		if($_POST['mode']=='edit')
		{
			
			$data['update_date']	=	date('Y-m-d h:i:s');	
			
			$this->comman_fun->update($data,'service_request',array('id'=>$_POST['eid']));
			
			$this->session->set_flashdata("success", "We will contact you soon.....");
		}
		
		
			
	}
	


	function status_update($st,$eid){
		
		$record	=	$this->comman_fun->get_table_data('service_request',array('id'=>$eid));
		
		$data['status'] = $st;
		
		$this->comman_fun->update($data,'service_request',array('id'=>$eid));
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Status '.$st.' Successfully.....'));
		
		redirect( file_path('client')."".$this->uri->rsegment(1)."/view");
		
		
	}
	
	
	function delete_record($eid){
		
		$record	=	$this->comman_fun->get_table_data('service_request',array('id'=>$eid));
		
		$data['status'] = 'Delete';
		
		$this->comman_fun->update($data,'service_request',array('id'=>$eid));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('client')."".$this->uri->rsegment(1)."/view");
		
	}
	
	
	
	
}


