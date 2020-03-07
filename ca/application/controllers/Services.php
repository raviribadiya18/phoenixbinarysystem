<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
	
   		
 	}
	
	public function index()
	{
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/services');
		
		$this->load->view('comman/footer_web');
		
	}
	
	function service_detail(){
		
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/services_details');
		
		$this->load->view('comman/footer_web');
	}
	
	function statutory_audit_assurance(){
		
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/statutory_audit_assurance');
		
		$this->load->view('comman/footer_web');
	}
	
	function corporate_advisory(){
		
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/corporate_advisory');
		
		$this->load->view('comman/footer_web');
	}
	
	
	function mergers_acquisitions(){
		
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/mergers_acquisitions');
		
		$this->load->view('comman/footer_web');
	}
	
	function international_tax(){
		
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/international_tax');
		
		$this->load->view('comman/footer_web');
	}
	
	function corporate_tax(){
		
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/corporate_tax');
		
		$this->load->view('comman/footer_web');
	}
	
	function management_audit(){
		
		$this->load->view('comman/top_header_web');
		
		$this->load->view('web/management_audit');
		
		$this->load->view('comman/footer_web');
	}
	
	
}
