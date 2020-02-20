<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct()
 	{
   		parent::__construct(); 
		
		$this->load->library('form_validation');
		
		$this->load->helper('form');
		
   		$this->load->helper('url');
		
		$this->load->library('email');
		
		$this->load->library('session');
		
 	}
	
	public function index()
	{
		$this->load->view('comman/top_header');
		$this->load->view('contact_view');
		$this->load->view('comman/footer');
	}
	
	function contact_us()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			
			$this->form_validation->set_rules('contact_name','Name','required|trim');
				
			$this->form_validation->set_rules('contact_email','Email Id','required|trim');
			
			$this->form_validation->set_rules('contact_subject','Subject','required|trim');
			
			$this->form_validation->set_rules('contact_no','Mobile Number','required|trim');
			
			$this->form_validation->set_rules('contact_message','Message', 'required|trim');
			
			
			if($this->form_validation->run() == FALSE)
        	{
            	$this->index();
        	}
        	else
			
        	{
				
				$tdate		=	date("d-m-Y");
				
				$name		=	$_POST["contact_name"];
				
				$contact	=	$_POST["contact_no"];
				
				$email		=	$_POST["contact_email"];
				
				$subject	=	'Contact Us- '.$_POST["contact_subject"];
				
				$comment	=	$_POST["contact_message"];
				
				$to			=	"phoenix8155@gmail.com";
				
				// message
				
				$message = '<html><head></head>
							<body>
								<table> 
								<tr> <td>Name</td><td>:</td><td>'.$name.'</td></tr>
								<tr> <td>Contact No</td><td>:</td><td>'.$contact.'</td></tr>
								<tr> <td>Email</td><td>:</td><td>'.$email.'</td></tr>
								<tr> <td>Date</td><td>:</td><td>'.$tdate.'</td></tr>
								<tr> <td>Subject</td><td>:</td><td>'.$subject.'</td></tr>
								<tr> <td>Message</td><td>:</td><td>'.$comment.'</td></tr>
								</table><p>This email get from www.phoenixbinarysystem.com</p>
							</body>
							</html>';
				
			
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				$headers .= 'From:Phoenix- '.$email.'' . "\r\n";
				
				
				
				if(!mail($to, $subject, $message, $headers))
				{
					$this->session->set_flashdata('msg_false', 'Email not send.');
				}
				else
				{
					$this->session->set_flashdata('msg_true', 'Email sent successfully.'); 
				}
				
				
				redirect("contact");

				
			}
			
			
			
		}//end if
		
	}
	
	
	
	function tt()
	{
		$this->email->from('phoenix8155@gmail.com', 'phoenix8155');
		$this->email->to('hap1994@gmail.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		echo $this->email->send();

	}
	
	
	
}
