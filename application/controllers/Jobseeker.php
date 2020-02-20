<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class career extends CI_Controller {

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
		$this->load->view('jobseeker_view');
		$this->load->view('common/web_footer');
	}

	function jobseeker_submit()
	{
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('job_title','Job Title','required|trim');

			$this->form_validation->set_rules('contact_name','Name','required|trim');
			
			$this->form_validation->set_rules('subject','Subject','required|trim');
				
			$this->form_validation->set_rules('message','Message','required|trim');
				
			$this->form_validation->set_rules('contact_email','Email Id','required|trim');
			
			$this->form_validation->set_rules('contact_no','Mobile Number','required|trim');
			
			if($this->form_validation->run() == FALSE)
        	{
            	$this->index();
        	}
        	else
			{
				
				$tdate		=	date("d-m-Y");
				
				$jtitle		=	$_POST["job_title"];
				
				$name		=	$_POST["contact_name"];
				
				$contact	=	$_POST["contact_no"];
				
				$email		=	$_POST["contact_email"];

				$comment	=	$_POST["message"];
				
				$subject	=	'Job Application - '.$_POST['subject'];
				
				// $to			=	"phoenix8155@gmail.com";	
				$to			=	"dhavalt303@gmail.com";	
				
				// message
				
				$message = '<html><head></head>
							<body>
								<table> 
								<tr> <td>Job Title</td><td>:</td><td>'.$jtitle.'</td></tr>
								<tr> <td>Name</td><td>:</td><td>'.$name.'</td></tr>
								<tr> <td>Contact No</td><td>:</td><td>'.$contact.'</td></tr>
								<tr> <td>Email</td><td>:</td><td>'.$email.'</td></tr>
								
								<tr> <td>Subject</td><td>:</td><td>'.$subject.'</td></tr>
								<tr> <td>Message</td><td>:</td><td>'.$comment.'</td></tr>
								<tr> <td>Submit Date</td><td>:</td><td>'.$tdate.'</td></tr>
								</table><p>This email get from www.phoenixbinarysystem.com</p>
							</body>
							</html>';
				
				
				    $upload_data = $this->upload_file();
					
					$this->email->attach($upload_data['full_path']);
					 
					$this->email->set_newline("\r\n");
					 
					$this->email->set_crlf("\r\n");
					 
					$this->email->from($email); 
					 
					$this->email->to($to);
					 
					$this->email->subject($subject);
					 
					$this->email->message($message);
					 
					if ($this->email->send()) {
						
						$this->session->set_flashdata('msg_true', 'Email sent successfully.'); 
						//return true;
					} else {
						
						// show_error($this->email->print_debugger());
						 $this->session->set_flashdata('msg_false', 'Email not send.');
					}
					
					redirect("career");
					
			}
			
		}//end if
		
		
	}
	
	
	public function upload_file()
	{
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'doc|docx|pdf';
			$config['max_size']             = 2048;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('resume'))
			{
					
				return $this->upload->display_errors();
			}
			else
			{
				 return $this->upload->data();   
			}
	}
}
