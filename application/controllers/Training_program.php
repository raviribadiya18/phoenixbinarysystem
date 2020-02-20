<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_program extends CI_Controller {

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
		$this->load->view('common/web_header');
		$this->load->view('training_program_view');
		$this->load->view('common/web_footer');
	}

	function send_email()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			$this->form_validation->set_rules('contact_name','Name','required|trim');
			
			$this->form_validation->set_rules('subject','Subject','required|trim');
				
			$this->form_validation->set_rules('message','Message','required|trim');
				
			$this->form_validation->set_rules('contact_email','Email Id','required|trim');
			
			$this->form_validation->set_rules('contact_no','Mobile Number','required|trim');
			
			$this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_check_google_validate_captcha');
			
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

				$comment	=	$_POST["message"];
				
				$subject	=	'Training Program - '.$_POST['subject'];
				
				$to			=	"phoenix8155@gmail.com";	
				
				// message
				
				$message = '<html><head></head>
							<body>
								<table> 
								<tr> <td>Name</td><td>:</td><td>'.$name.'</td></tr>
								<tr> <td>Contact No</td><td>:</td><td>'.$contact.'</td></tr>
								<tr> <td>Email</td><td>:</td><td>'.$email.'</td></tr>
								<tr> <td>Subject</td><td>:</td><td>'.$subject.'</td></tr>
								<tr> <td>Message</td><td>:</td><td>'.$comment.'</td></tr>
								<tr> <td>Submit Date</td><td>:</td><td>'.$tdate.'</td></tr>
								</table><p>This email get from www.phoenixbinarysystem.com</p>
							</body>
							</html>';
				
				
				    
					$this->email->from($email); 
					 
					$this->email->to($to);
					 
					$this->email->subject($subject);
					 
					$this->email->message($message);
					 
					if ($this->email->send()) {
						
						$this->session->set_flashdata('msg_true', 'We will contact you soon!'); 
						//return true;
					} else {
						
						// show_error($this->email->print_debugger());
						 $this->session->set_flashdata('msg_false', 'Data not send.');
					}
					
					redirect("training_program");
					
			}
			
		}//end if
		
	}
	
	
	function check_google_validate_captcha() {
		
		$google_captcha = $this->input->post('g-recaptcha-response');
		
		$google_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeUl9YUAAAAAN6nOm_O50WOF7uO9ZC9l9VnYpTU&response=" . $google_captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
		
		if ($google_response . 'success' == false) {
			
			$this->form_validation->set_message('check_google_validate_captcha', 'Please check the the captcha form');
			
			return FALSE;
			
		} else {
			
			return TRUE;
		}
	}
}
