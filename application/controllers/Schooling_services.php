<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schooling_services extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
	

 	}
	public function index()
	{
		$this->load->view('common/web_header');
		$this->load->view('schooling_view');
		$this->load->view('common/web_footer');
	}
}
