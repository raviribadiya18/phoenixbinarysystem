<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct()
 	{
   		parent::__construct(); 
		
 	}

	public function index()
	{
		$this->load->view('comman/top_header');
		$this->load->view('home_view');
		$this->load->view('comman/footer');
	}
}
