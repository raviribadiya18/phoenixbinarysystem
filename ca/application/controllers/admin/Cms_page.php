<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_page extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		if(!is_logged_admin())
		{
			header('Location: '.file_path().'login');
			exit;	
        }
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
   		
 	}
	public function index(){  
		$this->view();
	}
	
	public function view()
	{  
		
		$data['html']=$this->listing();
		$page_info['page_title']='CMS Pages';
		$this->load->view('comman/topheader');
		$this->load->view('comman/header_admin',$page_info);
		$this->load->view('admin/'.''.$this->uri->rsegment(1).'_view',$data);	
		$this->load->view('comman/footer');	
	}
	
	function listing(){
		$result=$this->comman_fun->get_table_data('web_cms_pages',array('status'=>'Active'));
		$html='';
		for($i=0;$i<count($result);$i++){
				
				$row=$i+1;
				$html.='<tr>
						<td>'.$row.'</td>
						<td>'.$result[$i]['page_name'].'</td>
						<td>'.$result[$i]['page_title'].'</td>
						<td>
							<div class="btn-group margin0">
								<button type="button" class="btn btn-xs btn-success">Opration</button>
								<button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li><a href="'.file_path('admin').''.$this->uri->rsegment(1).'/addnew/'.$result[$i]['id'].'">Edit</a></li>
								</ul>
							</div>
						</td>
					</tr>';
		}		
		
		return $html;
	}
	
	function addnew($eid){
		
		
		$data['result']		=	$this->comman_fun->get_table_data('web_cms_pages',array('status'=>'Active','id'=>$eid));
		
		
		
		if(isset($data['result'][0])){
				$option		=	json_decode($data['result'][0]['option'],true);
				$data['f']=$option['f'];
				$data['t']=$option['t'];
				
				$page_info['page_title']='CMS Pages';
				$this->load->view('comman/topheader');
				$this->load->view('comman/header_admin',$page_info);
				$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
				$this->load->view('comman/footer');
		}else{
			$this->view();		
		}
		
		
		
	}
	
	function insert()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){	
		
            $this->_insert();
			header('Location: '.file_path('admin').''.$this->uri->rsegment(1).'');
			exit;
       	 	
		}else
		{
			$this->view();
		}	
	}
	
	protected function _insert(){
		
		$data=array();
		$data['page_title']			=	(isset($_POST['page_title'])) ? filter_data($_POST['page_title']) : "";
		$data['video_url']			=	(isset($_POST['video_url'])) ? filter_data($_POST['video_url']) : "";
		$data['textdt']				=	(isset($_POST['textdt'])) ? filter_data($_POST['textdt']) : "";
		$data['sub_text']			=	(isset($_POST['sub_text'])) ? filter_data($_POST['sub_text']) : "";
		
	

		$this->comman_fun->update($data,'web_cms_pages',array('id'=>filter_data($_POST['eid']))); 
		$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Page Update Successfully.....'));
			
	}
	
	function handle_upload()
	{
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name']))
		{
				$config = array();
				$config['upload_path'] 				= 	'./upload/media/';
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
				$fileName							=	'js_'.$rand.''.$_FILES['upload_file']['name'];
				$fileName 							= 	str_replace(" ","",$fileName);
				$config['file_name'] 				= 	$fileName;
				$this->upload->initialize($config);
					
				if ($this->upload->do_upload())
				{
					$upload_data    	= $this->upload->data();
					$_POST['file_name'] = $upload_data['file_name'];
					return true;
				}
				else
				{
					$this->form_validation->set_message('handle_upload', $this->upload->display_errors());
					return false;
				}
		}
		
	}
	
	
	
	
	
	
	
}


