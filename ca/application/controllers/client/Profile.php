<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	

	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_login('client')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
   		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');
		
 	}
	

	
	function change_password()
	{
		$page_info['menu_id']		=	'menu-profile';
		
		$page_info['page_title']	=	'Change Password';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);
		
		$this->load->view('client/change_password_view',$data);
		
		$this->load->view('comman/footer_admin');	
			
	}
	
	
	function change_password_insert(){
		
		$this->form_validation->set_rules('old_pass','Old Password', 'required|trim|callback_check_old_password');
		
		$this->form_validation->set_rules('new_pass','New Password', 'required|trim');
		
		$this->form_validation->set_rules('confirm_pass','Confirm Password', 'required|trim|matches[new_pass]');
		
		if ($this->form_validation->run() === FALSE)
		{
				$this->change_password();
		}
		else
		{	
			$this->_change_password_insert();
			
			$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Password Changed Successfully'));
			
			header('Location: '.base_url().'index.php/client/'.$this->uri->rsegment(1).'/change_password/');
			exit;
		}
	}
	
	protected function _change_password_insert(){
		
		$data=array();
		
		$data['password']			=	filter_data($_POST['new_pass']);
		
		$this->comman_fun->update($data,'membermaster',array('usercode'=>$this->session->userdata['pbm_client']['usercode']));
		
	}
	
	function check_old_password(){
		
		if(!$this->comman_fun->check_record('membermaster',array('usercode'=>$this->session->userdata['pbm_client']['usercode'],'password'=>$_POST['old_pass'])))
   		{
      		$this->form_validation->set_message('check_old_password', 'Old Password Not Match');
			
      		return FALSE;
   		} 
		return TRUE;
	}
	
	function check_new_password(){
		
		if($this->comman_fun->check_record('membermaster',array('usercode'=>$this->session->userdata['pbm_client']['usercode'],'password'=>$_POST['new_pass'])))
   		{
      		$this->form_validation->set_message('check_new_password', 'Enter Same Password');
			
      		return FALSE;
   		} 
		return TRUE;
	}
	
	function check_password(){
		
		if(!$this->comman_fun->check_record('membermaster',array('usercode'=>$this->session->userdata['pbm_client']['usercode'],'password'=>$_POST['confirm_pass'])))
   		{
      		$this->form_validation->set_message('check_password', 'Invaild Password');
      		return FALSE;
   		}
		return TRUE;
	}
	
	//
//	public function index(){  
//	
//		$this->view();
//		
//	}
//	
//	public function view(){  
//		
//		
//		$data['result']		=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>user_session('usercode')));
//		
//		$page_info['page_title']	=	'Profile';
//	
//		$this->load->view('comman/topheader');
//		
//		$this->load->view('comman/header',$page_info);
//		
//		$this->load->view('user/profile_view',$data);	
//		
//		$this->load->view('comman/footer');	
//		
//	}
//	
//	function profile_edit()
//	{
//	
//		if ($this->input->server('REQUEST_METHOD') === 'POST')
//		{
//			$this->form_validation->set_rules('mobileno','mobileno', 'required|trim');
//			
//			$this->form_validation->set_rules('skype','skype', 'required|trim');	
//
//			$this->form_validation->set_rules('dob','dob', 'required|trim');
//			
//			$this->form_validation->set_rules('gender','gender', 'required|trim');
//			
//			$this->form_validation->set_rules('country','country', 'required|trim');
//
//			
//			if ($this->form_validation->run() === FALSE)
//			{
//				$this->view();
//			}
//			else
//			{	
//				$this->_profile_edit();
//				
//				$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Record Updated Successfully'));
//				
//				header('Location: '.base_url().'index.php/user/'.$this->uri->rsegment(1).'/view/');
//				exit;
//			}	
//		}
//	}
//	
//	protected function _profile_edit()
//	{
//			
//			$smr_web_login = $this->session->userdata['smr_web_login'];
//		
//			$data=array();
//			
//			$data['fname']				=	filter_data($_POST['fname']);
//			
//			$data['lname']				=	filter_data($_POST['lname']);
//			
//			$data['fullname']			=	filter_data($_POST['fname'].' '.$_POST['lname']);
//			
//			$data['mobileno']			=	filter_data($_POST['mobileno']);
//		
//			$data['skype']				=	filter_data($_POST['skype']);
//			
//			$data['gender']				=	filter_data($this->input->post('gender'));
//			
//			$data['dob']				=	filter_data(date('Y-m-d',strtotime($this->input->post('dob'))));
//			
//			$data['country']			=	filter_data($this->input->post('country'));
//			
//			$this->handle_upload('upload_file','profile');
//			
//			if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name']))
//			{
//				$data['profile_img']			=	$_POST['upload_file'];
//				
//				$smr_web_login['profile_pic']	=	$_POST['upload_file'];
//			}
//			
//			
//			
//			$smr_web_login['name']			=	$_POST['fname'].' '.$_POST['lname'];
//			
//			$this->session->set_userdata('smr_web_login', $smr_web_login);  
//			
//			$this->comman_fun->update($data,'membermaster',array('usercode'=>user_session('usercode')));
//			
//			
//	}
//	
//	//upload_file
//	function handle_upload($file,$pre)
//	{
//		if (isset($_FILES[$file]) && !empty($_FILES[$file]['name']))
//		{
//				
//				//$result 	= 	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$this->session->userdata['gcc_web_login']['usercode']));
//				
//				$result 	= 	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$this->session->userdata['smr_web_login']['usercode']));
//				
//				$url1		=	'./sm/upload/post/'.$result[0]['profile_img'];
//				
//				//$url2		=	'./upload/profile/thum/'.$result[0]['profile_img'];
//				
//				if($result[0]['profile_img'] != 'profile.png'){
//					
//					unlink($url1);
//					
//				}
//				
//				
//				
//				//unlink($url2);
//				
//				$config = array();
//				$config['upload_path'] 				= 	'./sm/upload/post/';
//				$config['allowed_types'] 			= 	'jpg|jpeg|gif|png';
//				$config['max_size']      			= 	'0';
//				$config['overwrite']     			= 	TRUE;
//				$config['remove_spaces'] 			= 	TRUE;
//				$_FILES['userfile']['name'] 		= 	$_FILES[$file]['name'];
//				$_FILES['userfile']['type'] 		= 	$_FILES[$file]['type'];
//				$_FILES['userfile']['tmp_name']		= 	$_FILES[$file]['tmp_name'];
//				$_FILES['userfile']['error']		= 	$_FILES[$file]['error'];
//				$_FILES['userfile']['size']			= 	$_FILES[$file]['size'];
//				$rand = md5(uniqid(rand(), true));
//				$fileName							=	$pre.'_'.$rand.''.$_FILES[$file]['name'];
//				$fileName 							= 	str_replace(" ","",$fileName);
//				$config['file_name'] 				= 	$fileName;
//				$this->upload->initialize($config);
//					
//				if ($this->upload->do_upload())
//				{
//					$upload_data    	= $this->upload->data();
//					$_POST[$file] 		= $upload_data['file_name'];
//					//$this->_create_thumbnail($upload_data['file_name'],200,200);
//					return true;
//				}
//		}
//		
//	}
//	
//	
//	protected function _create_thumbnail($fileName,$width,$height) 
//    {
//       	
//		 $config['image_library'] 	= 'gd2';
//        $config['source_image']  	= upload_file().'profile/'.$fileName;       
//        $config['create_thumb']  	= TRUE;
//        $config['maintain_ratio'] 	= TRUE;
//        $config['width'] 			= $width;
//        $config['height'] 			= $height;
//        $config['new_image'] 		= upload_file().'profile/thum/'.$fileName;   
//		$config['thumb_marker'] 	= '';   
//		
//        $this->image_lib->initialize($config);
//        if(!$this->image_lib->resize())
//        { 
//            echo $this->image_lib->display_errors();
//        }        
//    }
//	 
//	function change_username()
//	{
//		$page_info['page_title']	=	'Change Username';
//		
//		$this->load->view('comman/topheader');
//		
//		$this->load->view('comman/header',$page_info);
//		
//		$this->load->view('user/changeusername_view',$data);	
//		
//		$this->load->view('comman/footer');	
//			
//	}
//	
//	function change_username_insert(){
//		
//		$this->form_validation->set_rules('confirm_pass','Password', 'required|trim|callback_check_password');
//		
//		$this->form_validation->set_rules('new_username','Username', 'required|trim|min_length[5]|callback_check_username');
//		
//		
//		if ($this->form_validation->run() === FALSE)
//		{
//				$this->change_username();
//		}
//		else
//		{	
//			$this->_change_username_insert();
//			
//			$this->session->set_flashdata('show_msg',array('class'=>'true','msg'=>'Username Changed Successfully'));
//			
//			header('Location: '.base_url().'index.php/user/'.$this->uri->rsegment(1).'/change_username/');
//			exit;
//		}
//	}
//	
//	protected function _change_username_insert(){
//		
//		$data=array();
//		
//		$data['username']			=	filter_data($_POST['new_username']);
//		
//		$this->comman_fun->update($data,'membermaster',array('usercode'=>user_session('usercode')));
//		
//	}
//	
//	
//	function check_username(){
//		
//		if($this->comman_fun->check_record('membermaster',array('usercode !='=>user_session('usercode'),'username'=>$_POST['new_username'])))
//   		{
//      		$this->form_validation->set_message('check_username', 'Username Already Exist');
//      		return FALSE;
//   		}
//		
//		return TRUE;
//	}
//	
//	
	
	
	
	
	
	
	
}


