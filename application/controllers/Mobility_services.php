<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobility_services extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
	

 	}
	public function index()
	{
		$this->load->view('common/web_header');
		$this->load->view('mobility_services_view');
		$this->load->view('common/web_footer');
	}
}
