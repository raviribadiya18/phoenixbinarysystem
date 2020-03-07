<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_account extends CI_Controller {
	
	
	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!$this->session->userdata('pbm_superadmin')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		

		
 	}
	
	function member($eid){
		
		if($this->session->userdata('pbm_superadmin')){
			
			$result		=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$eid));
			
			$admin_code =   $this->session->userdata['pbm_login']['usercode'];
			
			if(isset($result[0])){
				
				$this->session->set_userdata('pbm_login', false);
				
				$this->session->set_userdata('pbm_emp', false);
				
				$this->session->set_userdata('pbm_client', false);
				
				$this->session->set_userdata('pbm_accountant', false);
				
				$this->session->set_userdata('pbm_admin',false);
				
				
				$sess_array						=	array();
				
				$sess_array['name']				=	$result[0]['fname'].' '.$result[0]['lname'];
				
				$sess_array['usercode']			=	$result[0]['usercode'];
				
				$sess_array['username']			=	$result[0]['username'];

				$sess_array['emailid']			=	$result[0]['emailid'];
				
				$sess_array['login']			=	'true';
				
				$this->session->set_userdata('pbm_login', $sess_array);
				
				if($result[0]['role']=='emp'){
					
					$this->session->set_userdata('pbm_emp', $sess_array);	
					
				}else if($result[0]['role']=='client'){
				
					$this->session->set_userdata('pbm_client', $sess_array);
					
				}else if($result[0]['role']=='account'){
				
					$this->session->set_userdata('pbm_accountant', $sess_array);
					
				}
				else{
					
					$this->session->set_userdata('pbm_login', $sess_array);
				}
				
				$info							=	array();
				
				$info['login']					=	true;
				
				$info['change']					=	true;
				
				$info['admin_code']				=	$admin_code;
				
				$this->session->set_userdata('pbm_superadmin',$info);
				
				if($result[0]['role']=='emp'){
					
					header('Location: '.file_path('emp').'dashboard/view/');
					
					exit;
				}
				
				if($result[0]['role']=='client'){
					
					header('Location: '.file_path('client').'dashboard/view/');
					
					exit;
				}
				
				if($result[0]['role']=='account'){
					
					header('Location: '.file_path('accountant').'dashboard/view/');
					
					exit;
				}
				//header('Location: '.file_path('user').'dashboard/view/');
//				
//				exit;
					
			}
			
		}
	}
	
	function admin(){
		
		if($this->session->userdata('pbm_superadmin')){
			
			if($this->session->userdata['pbm_superadmin']['admin_code']!=''){
				
				$uid = $this->session->userdata['pbm_superadmin']['admin_code'];
				
			}else{
				
				$uid = $this->session->userdata['pbm_login']['usercode'];
				
			}
			
			$result		=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>''.$uid.''));
			
			if(isset($result[0])){
				
				$this->session->set_userdata('pbm_login', false);
				
				$this->session->set_userdata('pbm_emp', false);
				
				$this->session->set_userdata('pbm_client', false);
				
				$this->session->set_userdata('pbm_accountant', false);
				
				
				$sess_array						=	array();
				
				$sess_array['name']				=	$result[0]['fname'].' '.$result[0]['lname'];
				
				$sess_array['usercode']			=	$result[0]['usercode'];
				
				$sess_array['username']			=	$result[0]['username'];
				
				$sess_array['login']			=	'true';	
							
				$this->session->set_userdata('pbm_login', $sess_array);
				
				
				
				$info					=	array();
				
				$info['login']			=	'true';
				
				$info['admin']			=	'true';
				
				$this->session->set_userdata('pbm_admin',$info);
				
				
				$info							=	array();
				
				$info['login']					=	true;
				
				$this->session->set_userdata('pbm_superadmin',$info);
				
				
				header('Location: '.file_path('admin').'dashboard/view/');
				
				exit;
				
			}
		}
	}
	
	
	
}