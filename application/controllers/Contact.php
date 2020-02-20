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

		date_default_timezone_set('Asia/Calcutta'); 

 	}
	public function index()
	{
		$this->load->view('common/web_header');
		$this->load->view('contact_us_view');
		$this->load->view('common/web_footer');
	}

	function send_email()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			
			
			$this->form_validation->set_rules('contact_name','Name','required|trim');
				
			$this->form_validation->set_rules('contact_email','Email Id','required|trim');
			
			$this->form_validation->set_rules('contact_subject','Subject','required|trim');
			
			$this->form_validation->set_rules('contact_no','Mobile Number','required|trim');
			
			$this->form_validation->set_rules('contact_message','Message', 'required|trim');
			
			$this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_check_google_validate_captcha');
			
			
			if($this->form_validation->run() == FALSE)
        	{
            	$this->index();
        	}
        	else
			
        	{
    //     		$data=array();
			
				// $data['contact_name']	=	filter_data($_POST['contact_name']);
				
				// $data['contact_email']	=	filter_data($_POST['contact_email']);
				
				// $data['contact_no']	=	filter_data($_POST['contact_no']);

				// $data['contact_subject']	=	filter_data($_POST['contact_subject']);	
				
				// $data['contact_message']	=	filter_data($_POST['contact_message']);	
			
				// $data['status']	=	'Active';
				
				// $data['create_date']	=	date('Y-m-d H:i:s');
				
				// $this->comman_fun->addItem($data,'contact_master');

				
				$tdate		=	date("d-m-Y");
				
				$name		=	$_POST["contact_name"];
				
				$contact	=	$_POST["contact_no"];
				
				$email		=	$_POST["contact_email"];
				
				$subject	=	'Contact Us- '.$_POST["contact_subject"];
				
				$comment	=	$_POST["contact_message"];
				
				//$to			=	"raviribadiya014@gmail.com";

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
					$this->session->set_flashdata('msg_false', 'Data not send.');
				}
				else
				{
					$this->session->set_flashdata('msg_true', 'We will contact you soon!'); 
				}
				
				// $this->email->from($_POST['contact_email'], $_POST['contact_name']);

				// $this->email->to('minesh8155@gmail.com');//phoenixbinary224@gmail.com

				// $this->email->subject('Contact Us- '.$_POST["contact_subject"]);

				// $this->email->message($message);

				// if(!$this->email->send())
				// {
				// 	$this->session->set_flashdata('msg_false', 'Email not send.');
				// }
				// else
				// {
				// 	$this->session->set_flashdata('msg_true', 'Email sent successfully.'); 
				// }

				
				redirect("contact");

				
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