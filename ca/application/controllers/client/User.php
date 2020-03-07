<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_login('client')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
   		$this->load->model('client/User_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-user';
		
		$page_info['page_title']	=	'User List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);
		
		$this->load->view('client/'.$this->uri->rsegment(1).'_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function listing(){
	
	
		$result=$this->ObjM->get_sub_client();
		
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
				
				if($result[$i]['self']==0){
					
					$name=$result[$i]['fname'].' '.$result[$i]['lname'].' <span style="color:green;">(Self)</span>';
					
				}else{
					
					$name=$result[$i]['fname'].' '.$result[$i]['lname'];
				}
				
				$result_due_amt=$this->ObjM->get_due_amt_by_subuser($result[$i]['usercode'],$result[$i]['id']);
				
				if($result_due_amt[0]['tot_due_amt']!=0){
					
					$amt=$result_due_amt[0]['tot_due_amt'];
					
				}else{
					
					$amt="0.00";
					
				}
			
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$name.'</td>
						<td>'.$result[$i]['company_name'].'</td>
						<td>'.$result[$i]['mobileno'].'</td>
						<td>'.$result[$i]['emailid'].'</td>
						<td>'.$amt.' /-</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle btn-success btn_custom" data-toggle="dropdown">Action<i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							
							<li><a href="'.file_path('client').''.$this->uri->rsegment(1).'/addnew_member/edit/'.$this->session->userdata['pbm_client']['usercode'].'/'.$result[$i]['id'].'">Edit</a></li>';
						
						$html.='</ul>
						</div>
						
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	function addnew_member($mode=NULL, $usercode=NULL, $eid=NULL){
		
		
		if($mode=='edit')
		{
			$data['form_set']	=	array('mode'=>'edit','eid'=>$eid,'usercode'=>$usercode);
			
			$data['result']		=	$this->ObjM->get_sub_record($eid);
			
		}else{
			
			$data['form_set']=array('mode'=>'add','usercode'=>$usercode);
			
		}
	
		
		$page_info['menu_id']		=	'menu-user';
		
		$page_info['page_title']	=	'User List';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);;

		$this->load->view('client/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			
			$this->form_validation->set_rules('fname','First Name', 'required|trim');
			
			$this->form_validation->set_rules('lname','Last Name', 'required|trim');
			
			$this->form_validation->set_rules('company_name','Company Name', 'required|trim');
			
			$this->form_validation->set_rules('mobileno','mobileno', 'required|trim');
			
			$this->form_validation->set_rules('emailid','Email id', 'required|trim');
			
			if ($this->form_validation->run() === FALSE){
				
				$this->addnew($_POST['mode'],$_POST['usercode'],$_POST['eid']);
			}
			else
			{	
			
				
				$this->_insert();
				
				
				echo '<script>window.location.href="'.file_path('admin').''.$this->uri->rsegment(1).'/view"</script>';
				
				header('Location: '.file_path('client').''.$this->uri->rsegment(1).'/view/');
				
				exit;

			}
			
			
			

		}
	}
	
	
	
	protected function _insert(){
		
		$data=array();
	
		$data['fname']			=	filter_data($_POST['fname']);
			
		$data['lname']			=	filter_data($_POST['lname']);

		$data['company_name']	=	filter_data($_POST['company_name']);

		$data['mobileno']		=	filter_data($_POST['mobileno']);	
		
		$data['emailid']		=	filter_data($_POST['emailid']);

		
		if($_POST['mode']=='add')
		{
			$data['status']			=	'Active';
			
			$data['create_by']		=	'1';
			
			$data['create_date']	=	date('Y-m-d h:i:s');
			
			//$this->comman_fun->additem($data,'sub_membermaster');
			
			$this->session->set_flashdata("success", "Record Insert Successfully.....");
			
		}
		if($_POST['mode']=='edit')
		{
			
			$data['create_by']		=	$this->session->userdata['pbm_client']['usercode'];
			
			$data['last_update']	=	date('Y-m-d h:i:s');	
			
			$this->comman_fun->update($data,'sub_membermaster',array('id'=>$_POST['eid']));
			
			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}
		
		
			
	}
	

	
	
}


