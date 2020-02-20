<?php 


function sh_set( $var, $key )
{
	if( isset( $var[$key] ) ) return $var[$key];
	
}
	$contact_to = 'hap1994@gmail.com';
	include('validation.php');
	$validation = new SH_Validation;
	
	if( !count( $_POST ) ) return;
	
	
		/** set validation rules for contact form */
		$validation->set_rules('contact_name','<strong>'.'Name'.'</strong>', 'required|min_length[4]|max_lenth[30]');
		
		//$validation->set_rules('aplus_l_name','<strong>'.'Last Name'.'</strong>', 'required|min_length[4]|max_lenth[30]');
		//$validation->set_rules('contact_phone','<strong>'.'Phone'.'</strong>', 'numeric');
		$validation->set_rules('contact_subject','<strong>'.'Subject'.'</strong>', 'required|min_length[4]|max_lenth[40]');
		$validation->set_rules('contact_email','<strong>'.'Email'.'</strong>', 'required|valid_email');
		
		$validation->set_rules('contact_message','<strong>'.'Message'.'</strong>', 'required|min_length[5]');
		
		$messages = '';

		if($validation->run() !== FALSE && empty($validation->_error_array))
		{
			$name = $validation->post('contact_name');
			$email = $validation->post('contact_email');
			
			$message = "Contact Name:	".$name."\r\n";
			$message .= "\r\n"."Contact Phone:	".$validation->post('contact_phone')."\r\n";
			
			$message .= "\r\n".$validation->post('contact_message'); 
	
			//$contact_to = ( sh_set($settings, 'contact_email') ) ? sh_set($settings, 'contact_email') : get_option('admin_email');
	
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
			mail($contact_to, 'Contact Us Message', $message, $headers);
	
			//$message = sh_set($settings, 'success_message') ? $settings['success_message'] : sprintf( __('Thank you <strong>%s</strong> for using our Contact form! Your email was successfully sent and we will be in touch with you soon.',SH_NAME), $name);
	
			//$messages = '<div class="alert alert-success">'.'SUCCESS! '.$message.'</div>';
			echo "<fieldset>";
			echo "<div id='success_page' class='alert alert-success'>";
			echo "<h3>".'Email Sent Successfully.'."</h3>";
			echo "<p>".sprintf("Thank you <strong>%s</strong>, your message has been submitted to us.", $name)."</p>";
			echo "</div>";
			echo "</fieldset>";
			exit;
		
		}else
		{
	
			 if( is_array( $validation->_error_array ) )
			 {

				 foreach( $validation->_error_array as $msg )
				 {
					 $messages .= '<div class="alert alert-danger">'.'Error! '.$msg.'</div>';
				 }
			}
	
		}
	
		echo $messages;exit;