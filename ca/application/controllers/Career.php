<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
	
		$this->load->library('upload');
		
		$this->load->library('image_lib');
   		
		ini_set('post_max_size', '64M');
		
		ini_set('upload_max_filesize', '64M');
		
		
 	}
	
	public function index()
	{
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/career');
		
		$this->load->view('comman/footer_web');
		
	}
	
	
	public function view()
	{
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/career');
		
		$this->load->view('comman/footer_web');
		
	}
		
	function check()
	{
	
		if($this->input->server('REQUEST_METHOD') === 'POST'){
			
			//var_dump($_FILES);EXIT;
		
			$this->form_validation->set_rules('name','name', 'required|trim');
				
			$this->form_validation->set_rules('phone','phone', 'required|trim');	
				
			$this->form_validation->set_rules('email', 'email', 'required|trim');
			
			$this->form_validation->set_rules('message', 'message', 'required|trim');
			
			$this->form_validation->set_rules('upload_file', 'Upload file', 'callback_check_file_require');
			
			$this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_check_google_validate_captcha');
			
			
			if ($this->form_validation->run() === FALSE){
				
				$this->view();
			}
			else
			{	
			
				$this->_check();
				
				//$this->session->set_flashdata('msg_show', 'Thank You for contacting us. We will contact you as soon as possible.');
				
				header('Location: '.file_path().$this->uri->rsegment(1));
				
				exit;

			}	
		}
	}
	
	
	
	protected function _check()
	{		
		
			
			$data=array();
			
			$data['name']			=	filter_data($_POST['name']);
			
			$data['email']			=	filter_data($_POST['email']);
			
			$data['phone']			=	filter_data($_POST['phone']);
			
			$data['message']		=	filter_data($_POST['message']);	
		
			$data['status']			=	'Active';
			
			$data['create_date']	=	date('Y-m-d H:i:s');
		
			if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name']))
			{
				$this->handle_upload();
				
				$data['upload_file']		=	$_POST['file_name'];

			}
			
			
			$this->comman_fun->addItem($data,'career_master');
		
			$this->session->set_flashdata('msg_show', array('class'=>'true','msg'=>'Thank You for sharing your details. We will contact you as soon as possible.'));
			
			
	}
	
	//google captcha testing for localhost
	//Site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
	//Secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
	
	//live seceret key : 6LcIEYAUAAAAANuedRyUDkWyw_nvzoXk7uTZUkJ8
	
	function check_file_require() {
		
		
		if (!empty($_FILES['upload_file']['name'])){
				
			return TRUE;
			
		}else {
			
			$this->form_validation->set_message('check_file_require', 'This Field is Require. Please Choose file.');
			
			return FALSE;
		}
			
			
			
		
	}
	
	function check_google_validate_captcha() {
		
		$google_captcha = $this->input->post('g-recaptcha-response');
		
		$google_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcIEYAUAAAAANuedRyUDkWyw_nvzoXk7uTZUkJ8&response=" . $google_captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
		
		if ($google_response . 'success' == false) {
			
			$this->form_validation->set_message('check_google_validate_captcha', 'Please check the the captcha form');
			
			return FALSE;
			
		} else {
			
			return TRUE;
		}
	}
	
	function handle_upload()
	{
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name']))
		{
				$config = array();
				$config['upload_path'] 				= 	'./upload/web/doc/';
				$config['allowed_types'] 			= 	'pdf|docx';
				$config['max_size']      			= 	'0';
				$config['overwrite']     			= 	TRUE;
				$config['remove_spaces'] 			= 	TRUE;
				$_FILES['userfile']['name'] 		= 	$_FILES['upload_file']['name'];
				$_FILES['userfile']['type'] 		= 	$_FILES['upload_file']['type'];
				$_FILES['userfile']['tmp_name']		= 	$_FILES['upload_file']['tmp_name'];
				$_FILES['userfile']['error']		= 	$_FILES['upload_file']['error'];
				$_FILES['userfile']['size']			= 	$_FILES['upload_file']['size'];
				
				$fileName							=	'doc_'.$_POST['phone'].'_'.$_FILES['upload_file']['name'];
				$fileName 							= 	str_replace(" ","",$fileName);
				$config['file_name'] 				= 	$fileName;
				$this->upload->initialize($config);
					
				if ($this->upload->do_upload())
				{
					ini_set('upload_max_filesize','64M');
					
					$upload_data    	= $this->upload->data();
					$_POST['file_name'] = $upload_data['file_name'];
					
					return true;
				}else{
					
					echo $this->upload->display_errors();
				}
		}
		
	}
	
	
}
