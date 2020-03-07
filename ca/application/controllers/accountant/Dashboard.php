<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_login('accountant')){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
	
   		//$this->load->model('accountant/User_module','ObjM',TRUE);
 	}


	public function index(){  
	
		$this->view();
		
	}
	
	public function view(){  
		
		$page_info['menu_id']		=	'menu-dashboard';
		
		$page_info['page_title']	=	'Dashboard';

		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_acc',$page_info);
		
		$this->load->view('accountant/dashboard_view');	
		
		$this->load->view('comman/footer_admin');	
		
	}
	
}