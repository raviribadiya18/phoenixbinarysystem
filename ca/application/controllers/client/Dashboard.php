<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	

	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_login('client')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
	
   		$this->load->model('client/User_module','ObjM',TRUE);
 	}


	public function index(){  
	
		$this->view();
		
	}
	
	public function view(){  
		
		$page_info['menu_id']		=	'menu-dashboard';
		
		$page_info['page_title']	=	'Dashboard';
		
		$data['tot_user']	=	$this->ObjM->get_tot_user();
		
		$data['result'] = $this->get_client_notification();
		
		$data['record']	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$this->session->userdata['pbm_client']['usercode']));
		
		$data['result_due_amt']=$this->ObjM->get_due_amt_all_user($this->session->userdata['pbm_client']['usercode']);
			
		
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_client',$page_info);
		
		$this->load->view('client/dashboard_view',$data);	
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function get_client_notification(){

		$arr=array('All_client');
		 
		$usercode=$this->session->userdata['pbm_client']['usercode']; 
		
		$record_all			=	$this->ObjM->get_notification_by_send_type($arr);
		
		
		$arr				=	array('send_type'=>'Selected_client','usercode'=> $usercode);
		
		$record_pericular	=	$this->ObjM->get_notification_by_pericular($arr);
		//echo $this->db->last_query();exit;
		$noti_arr 			= 	array_merge($record_all, $record_pericular);
		
		return $noti_arr;
		
	}
	
}


