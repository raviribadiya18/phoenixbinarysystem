<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		
		ob_start();
		
		ob_end_flush();
		
   		$this->load->model('admin/Service_module','ObjM',TRUE);
		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function view(){
		

		$data['html']		=	$this->listing();

		$page_info['menu_id']		=	'menu-service';
		
		$page_info['page_title']	=	'Service Master';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_view',$data);
		
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
		
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['name'].'</td>					
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
	
		
		$page_info['menu_id']		=	'menu-service';
		
		$page_info['page_title']	=	'Service Master';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);;

		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
			
			$this->form_validation->set_rules('name','Name', 'required|trim');
			
			//$this->form_validation->set_rules('text_details','Service Details', 'required|trim');
			
			//$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			
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
			
		//$data['text_details']	=	filter_data($_POST['text_details']);

		//$data['amount']			=	filter_data($_POST['amount']);
		
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
	
	
	
	function handle_upload()
	{
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name']))
		{
				$config = array();
				$config['upload_path'] 				= 	'./upload/web/slider/';
				$config['allowed_types'] 			= 	'jpg|jpeg|gif|png';
				$config['max_size']      			= 	'0';
				$config['overwrite']     			= 	TRUE;
				$config['remove_spaces'] 			= 	TRUE;
				$_FILES['userfile']['name'] 		= 	$_FILES['upload_file']['name'];
				$_FILES['userfile']['type'] 		= 	$_FILES['upload_file']['type'];
				$_FILES['userfile']['tmp_name']		= 	$_FILES['upload_file']['tmp_name'];
				$_FILES['userfile']['error']		= 	$_FILES['upload_file']['error'];
				$_FILES['userfile']['size']			= 	$_FILES['upload_file']['size'];
				$rand = md5(uniqid(rand(), true));
				$fileName							=	$_POST['option_type'].'_'.$rand.''.$_FILES['upload_file']['name'];
				$fileName 							= 	str_replace(" ","",$fileName);
				$config['file_name'] 				= 	$fileName;
				$this->upload->initialize($config);
					
				if ($this->upload->do_upload())
				{
					$upload_data    	= $this->upload->data();
					$_POST['file_name'] = $upload_data['file_name'];
					
					if($_POST['option_type']=="slider"){
						$this->_create_slider($upload_data['file_name'],1349,500);
					}
					$this->_create_thumbnail($upload_data['file_name'],250,250);
					return true;
				}else{
					
					echo $this->upload->display_errors();
				}
		}
		
	}
	
	
	protected function _create_thumbnail($fileName,$width,$height) 
    {
       
        $config['image_library'] 	= 'gd2';
        $config['source_image']  	= media_path().$fileName;       
        $config['create_thumb']  	= TRUE;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			= $width;
        $config['height'] 			= $height;
        $config['new_image'] 		= media_path().'web/slider/thum/'.$fileName;   
		$config['thumb_marker'] 	= '';   
		
        $this->image_lib->initialize($config);
        if(!$this->image_lib->resize())
        { 
            echo $this->image_lib->display_errors();
        }        
    }
	
		

	function status_update($st,$eid){
		
		$record	=	$this->comman_fun->get_table_data('service_master',array('id'=>$eid));
		$data['status'] = $st;
		$this->comman_fun->update($data,'service_master',array('id'=>$eid));
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Status '.$st.' Successfully.....'));
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
		
	}
	
	
	function delete_record($eid){
		$record	=	$this->comman_fun->get_table_data('service_master',array('id'=>$eid));
		
		$data['status'] = 'Delete';
		
		$this->comman_fun->update($data,'service_master',array('id'=>$eid));
		
		
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Delete Successfully.....'));
		
		redirect( file_path('admin')."".$this->uri->rsegment(1)."/view");
		
	}
	
	
	
	
}


