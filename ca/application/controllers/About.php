<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
	
   		
 	}
	
	public function index()
	{
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/about');
		
		$this->load->view('comman/footer_web');
		
	}
}
