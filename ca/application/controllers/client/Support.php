<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_login('client')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
	
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');
				
		$this->load->model('client/Support_module','ObjM',TRUE);
		
 	}
	

	
	public function index()
	{
		
		$this->view();
		
	}
	
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-support';
		
		$page_info['page_title']	=	'Support';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);
		
		$this->load->view('client/support_view',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	function listing(){
	
	
		$result=$this->ObjM->get_support();
		
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
				
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						
						<td>'.$result[$i]['subject'].'</td>
						<td>'.$result[$i]['message'].'</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle '.$cls.' btn_custom" data-toggle="dropdown">'.$current_status.' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">';
							
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
			
			//$data['result']		=	$this->ObjM->get_record($eid);
			
		}else{
			$data['form_set']=array('mode'=>'add');
			
		}

		$page_info['menu_id']		=	'menu-support';
		
		$page_info['page_title']	=	'Support';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);;

		$this->load->view('client/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			
			
			$this->form_validation->set_rules('subject', 'subject', 'required');
			
			$this->form_validation->set_rules('message', 'message', 'required');
			
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
		
		$data['subject']	=	filter_data($_POST['subject']);
		
		$data['message']	=	filter_data($_POST['message']);
	
		$data['usercode']	=	$this->session->userdata['pbm_client']['usercode'];
		

		
		if($_POST['mode']=='add')
		{
			$data['status']			=	'Active';
			
			$data['add_from']		= 	'panel';
			
			$data['create_date']	=	date('Y-m-d h:i:s');
		
			$id_s=$this->comman_fun->additem($data,'support_master');
			
			$this->session->set_flashdata("success", "We will contact you soon.....");
			
			$notification_data = array(
						
				'type'       => 'add_support',
				
				'class_type' => 'support',
				
				'usercode_sender'   =>$this->session->userdata['pbm_client']['usercode'],
				
				'rec_id'       => $id_s,
				
				'usercode_reciever'  => '1',
				
				'message'	 => 'Sent Support Query.',
				
			);
			
			$this->ObjM->add_notification($notification_data);
			
			
		}
		if($_POST['mode']=='edit')
		{
			

			$this->comman_fun->update($data,'support_master',array('id'=>$_POST['eid']));
			
			$this->session->set_flashdata("success", "We will contact you soon.....");
		}
		
		
			
	}
	


	function status_update($st,$eid){
		
		$record	=	$this->comman_fun->get_table_data('support_master',array('id'=>$eid));
		
		$data['status'] = $st;
		
		$this->comman_fun->update($data,'support_master',array('id'=>$eid));
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Status '.$st.' Successfully.....'));
		
		redirect( file_path('client')."".$this->uri->rsegment(1)."/view");
		
		
	}
	
	
	function delete_record($eid){
		
		$record	=	$this->comman_fun->get_table_data('support_master',array('id'=>$eid));
		
		$data['status'] = 'Inactive';
		
		$this->comman_fun->update($data,'support_master',array('id'=>$eid));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('client')."".$this->uri->rsegment(1)."/view");
		
	}
	

	
	
	
	
	
}


