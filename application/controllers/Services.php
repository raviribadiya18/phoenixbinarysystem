<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
	

 	}
	public function index()
	{
		$this->load->view('common/web_header');
		$this->load->view('services_view');
		$this->load->view('common/web_footer');
	}

	public function seo()
	{
		$this->load->view('common/web_header');
		$this->load->view('seo_view');
		$this->load->view('common/web_footer');
	}

	public function mobile_app_development()
	{
		$this->load->view('common/web_header');
		$this->load->view('mobile_app_development_‪view');
		$this->load->view('common/web_footer');
	}
	public function website_development()
	{
		$this->load->view('common/web_header');
		$this->load->view('website_development_‪view');
		$this->load->view('common/web_footer');
	}
	public function cryptocurrency_development()
	{
		$this->load->view('common/web_header');
		$this->load->view('cryptocurrency_development_view');
		$this->load->view('common/web_footer');
	}
}