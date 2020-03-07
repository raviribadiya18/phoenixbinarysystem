<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_ie extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		if(!is_logged_admin()){
			
			header('Location: '.file_path().'login');
			
			exit;	
			
        }
		
		date_default_timezone_set('Asia/Calcutta'); 
		
		ob_start();
		
		ob_end_flush();
		
   		
		$this->load->library('form_validation');
		
		$this->load->library('upload');
		
		$this->load->library('image_lib');

		
 	}
	
	public function index()
	{
//		$this->load->view('comman/topheader');
//		
//		$this->load->view('comman/header_admin',$page_info);
//		
//		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
//		
//		$this->load->view('comman/footer_admin');
		
		$this->view();
		
	}
	
	public function view(){
		

		$page_info['menu_id']		=	'menu-client';
		
		$page_info['page_title']	=	'Client';
	
		$this->load->view('comman/topheader');
		
		$this->load->view('comman/header_admin',$page_info);
		
		$this->load->view('admin/'.$this->uri->rsegment(1).'_add',$data);
		
		$this->load->view('comman/footer_admin');	
		
	}
	
	function import(){
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$handle = fopen($_FILES['filename']['tmp_name'], "r");
			$i=0;
			
			
			while (($data_csv = fgetcsv($handle, 1000, ","))!== FALSE) 
			{
				if ($i==0){
					$i=1;
					continue;
				}
				
				if($data_csv[0]!=''){
					
					//$record_mn	=	$this->comman_fun->get_table_data('membermaster',array('mobileno'=>$data_csv[3]));
					
					//$record_e	=	$this->comman_fun->get_table_data('membermaster',array('emailid'=>$data_csv[4]));
					
					//if(count($record_mn) == 0){
						
						//if(count($record_e) == 0){
					
							$data['fname']			=	$data_csv[0];

							$data['lname']			=	$data_csv[1];

							$data['company_name']	=	$data_csv[2];

							$data['mobileno']		=	$data_csv[3];

							$data['emailid']		=	$data_csv[4];

							$data['address']		=	$data_csv[5];

							$data['city']			=	$data_csv[6];

							$data['password']		=	$data_csv[7];

							$data['status']			=	'Active';

							$data['create_date']	=	date('Y-m-d h:i:s');

							$data['last_update']	=	date('Y-m-d h:i:s');	

							$data['role']			=	'client';

							$user_code=$this->comman_fun->additem($data,'membermaster');	

							$u_data  =	array(
								'username'=>strtolower($data_csv[0]).$user_code
							);			

							$this->comman_fun->update($u_data,'membermaster',array('usercode'=>$user_code));

							$data_sm['fname']			=	$data_csv[0];

							$data_sm['lname']			=	$data_csv[1];

							$data_sm['company_name']	=	$data_csv[2];

							$data_sm['mobileno']		=	$data_csv[3];

							$data_sm['emailid']			=	$data_csv[4];

							$data_sm['address']			=	$data_csv[5];

							$data_sm['city']			=	$data_csv[6];

							$data_sm['usercode']		=	$user_code;

							$data_sm['status']			=	'Active';

							$data_sm['self']			=	'0';

							$data_sm['create_by']		=	'1';

							$data_sm['create_date']	=	date('Y-m-d h:i:s');

							$data_sm['last_update']	=	date('Y-m-d h:i:s');

							$this->comman_fun->additem($data_sm,'sub_membermaster');
						
					//	}
					//}
					
				}
				
			}
			
			fclose($handle);
		}
		
		header('Location: '.file_path('admin').'client/view');
				
		exit;
		
	}
	
	
}


