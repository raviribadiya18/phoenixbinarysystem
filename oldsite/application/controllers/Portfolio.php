<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller {
	
	function __construct()
 	{
		
   		parent::__construct(); 
		
 	}

	public function index()
	{
		
		$this->load->view('comman/top_header');
		$this->load->view('portfolio_view');
		$this->load->view('comman/footer');
	}
	
	public function view()
	{
		$pname 			= $this->uri->segment(3);
		
		if($pname=='diptip')
		{
			$projectnm		= 'DIPTIP Social Media Mobile App';
			$projectcode	= 'diptip'; 
			
			
		}
		
		$arr = array(
			'pname' => $projectnm,
			'pcode' => $projectcode
				
		);
		
		$data['result']	= $arr;
		$this->load->view('comman/top_header');
		$this->load->view('portfolio_single_view',$data);
		$this->load->view('comman/footer');
	}
	
}
