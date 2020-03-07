<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_mgmt extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		ob_start();
		
		ob_end_flush();
		
   		$this->load->model('admin/Task_mgmt_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-task_mgmt';
		
		$page_info['page_title']	=	'Task Management';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->getAll_task();
		
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
			
				$record	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$result[$i]['task_assign']));
				
				//$record_client	=	$this->comman_fun->get_table_data('sub_membermaster',array('id'=>$result[$i]['c_id']));
			
				//$record_user	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$record_client[0]['usercode']));
			
				$record_service	=	$this->comman_fun->get_table_data('service_master',array('id'=>$result[$i]['s_id']));
			
				if($result[$i]['task_status']=="Completed"){
					
					$sts_color='style="color: green; font-weight: 600;"';
					
				}elseif($result[$i]['task_status']=="Inprogress"){
					
					$sts_color='style="color: red; font-weight: 600;"';
					
				}elseif($result[$i]['task_status']=="Pending"){
					
					$sts_color='style="color: blue; font-weight: 600;"';
					
				}else{
					
					$sts_color='style="font-weight: 600;"';
				}	
			
			
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['sub_fname'].' '.$result[$i]['sub_lname'].' ('.$result[$i]['username'].')</td>
						<td>'.$record_service[0]['name'].'</td>
						<td>'.$result[$i]['task_details'].'</td>
						<td>'.$record[0]['fname'].' '.$record[0]['lname'].'</td>
						<td '.$sts_color.'>'.$result[$i]['task_status'].'</td>
						<td>'.$result[$i]['working_notes'].'</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							<li><a class="status_change" href="'.file_path('admin').''.$this->uri->rsegment(1).'/status_update/'.$update_status.'/'.$result[$i]['id'].'">'.$update_status.'</a></li>
							<li><a href="'.file_path('admin').''.$this->uri->rsegment(1).'/addnew/edit/'.$result[$i]['id'].'">Edit</a></li>';
							
							$html.='<li><a class="delete_record" href="'.file_path('admin').''.$this->uri->rsegment(1).'/delete_record/'.$result[$i]['id'].'">Delete</a></li>';
							
							
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
		
		$data['employee']	=	$this->ObjM->getAll_emp();
		
		$data['services']	=	$this->ObjM->get_services();
		
		$data['cname']		=	$this->ObjM->get_all_client_list();
		
		//$data['user']		=	$this->ObjM->get_client_list();
		
		$page_info['menu_id']		=	'menu-task_mgmt';
		
		$page_info['page_title']	=	'Task Management';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);;

		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			
			//$this->form_validation->set_rules('task_name','Task Name', 'required|trim');
			
			$this->form_validation->set_rules('task_details','Task Details', 'required|trim');
			
			$this->form_validation->set_rules('task_assign','Select Employee', 'required|trim');
			
			$this->form_validation->set_rules('c_id','Select User', 'required|trim');
			
			$this->form_validation->set_rules('s_id','Select Task', 'required|trim');
			
			$this->form_validation->set_rules('cname','Select Client', 'required|trim');
			
			
			
			
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
	
		//$data['task_name']		=	filter_data($_POST['task_name']);
			
		$data['task_details']	=	filter_data($_POST['task_details']);

		$data['task_assign']	=	filter_data($_POST['task_assign']);
		
		$data['c_id']			=	filter_data($_POST['c_id']);
		
		$data['s_id']			=	filter_data($_POST['s_id']);
		
		$data['usercode']		=	filter_data($_POST['cname']);

		
		
		
		if($_POST['mode']=='add')
		{
			$data['status']			=	'Active';
			
			$data['create_date']	=	date('Y-m-d h:i:s');
			
			$this->comman_fun->additem($data,'task_master');
			
			$this->session->set_flashdata("success", "Record Insert Successfully.....");
			
		}
		if($_POST['mode']=='edit')
		{
			
			$data['last_update']	=	date('Y-m-d h:i:s');	
			
			$this->comman_fun->update($data,'task_master',array('id'=>$_POST['eid']));
			
			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}
		
		
			
	}
	
	
		

	function status_update($st,$eid){
		
		$record	=	$this->comman_fun->get_table_data('task_master',array('id'=>$eid));
		$data['status'] = $st;
		$this->comman_fun->update($data,'task_master',array('id'=>$eid));
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Status '.$st.' Successfully.....'));
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
		
	}
	
	
	function delete_record($eid){
		$record	=	$this->comman_fun->get_table_data('task_master',array('id'=>$eid));
		
		$data['status'] = 'Delete';
		
		$this->comman_fun->update($data,'task_master',array('id'=>$eid));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
	}
	
	function sub_user_client($eid){
		
			$result = $this->comman_fun->client_sub_users(array('usercode'=>$eid));
			
			//var_dump($result);
			
			echo $result;
	}
	
	
}


