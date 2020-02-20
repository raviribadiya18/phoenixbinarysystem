<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cryptocurrency_development extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
	
 	}
	public function index()
	{
		$this->load->view('common/web_header');
		$this->load->view('cryptocurrency_development_view');
		$this->load->view('common/web_footer');
	}
}
