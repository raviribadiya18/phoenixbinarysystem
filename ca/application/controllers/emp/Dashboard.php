<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	

	
	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_login('emp')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
	
   		$this->load->model('emp/User_module','ObjM',TRUE);
 	}


	public function index(){  
	
		$this->view();
		
	}
	
	public function view(){  
		
		$page_info['menu_id']		=	'menu-dashboard';
		
		$page_info['page_title']	=	'Dashboard';
		
		$t_sts1="Initial";
		
		$t_sts2="Inprogress";
		
		$t_sts3="Completed";
		
		$t_sts4="Pending";
		
		$data['count_initial']	=	$this->ObjM->get_tot_task_status($t_sts1);
		
		$data['count_inprogress']	=	$this->ObjM->get_tot_task_status($t_sts2);
		
		$data['count_completed']	=	$this->ObjM->get_tot_task_status($t_sts3);
		
		$data['count_pending']	=	$this->ObjM->get_tot_task_status($t_sts4);
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_emp',$page_info);
		
		$this->load->view('emp/dashboard_view',$data);	
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	
	
}


