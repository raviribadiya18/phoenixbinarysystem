<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->library('email');

	}

	public function index() {
		$this->load->view('comman/top_header_web');

		$this->load->view('web/contact');

		$this->load->view('comman/footer_web');

	}

	public function view() {
		$this->load->view('comman/top_header_web');

		$this->load->view('web/contact');

		$this->load->view('comman/footer_web');

	}

	function check() {

		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('name', 'name', 'required|trim');

			$this->form_validation->set_rules('phone', 'phone', 'required|trim');

			$this->form_validation->set_rules('email', 'email', 'required|trim');

			$this->form_validation->set_rules('message', 'message', 'required|trim');

			$this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_check_google_validate_captcha');

			if ($this->form_validation->run() === FALSE) {

				$this->view();
			} else {

				$this->_check();

				//$this->session->set_flashdata('msg_show', 'Thank You for contacting us. We will contact you as soon as possible.');

				header('Location: ' . file_path() . $this->uri->rsegment(1));

				exit;
				//redirect('/contact/success','refresh');
			}
		}
	}

	function success() {

		if ($this->session->flashdata('msg_show') != '') {

			$this->load->view('comman/top_header_web');

			$this->load->view('web/contact', $data);

			$this->load->view('comman/footer_web');

		} else {

			header('Location: ' . base_url() . '');

			exit;

		}

	}
	protected function _check() {

		$data = array();

		$data['name'] = filter_data($_POST['name']);

		$data['email'] = filter_data($_POST['email']);

		$data['phone'] = filter_data($_POST['phone']);

		$data['message'] = filter_data($_POST['message']);

		$data['status'] = 'Active';

		$data['create_date'] = date('Y-m-d H:i:s');

		$this->comman_fun->addItem($data, 'contact_master');

		$this->session->set_flashdata('msg_show', array('class' => 'true', 'msg' => 'Thank You for contacting us. We will contact you as soon as possible.'));

		$name = $_POST['name'];

		$email = $_POST['email'];

		$phone = $_POST['phone'];

		$msg = $_POST['message'];

		// message
		$message = '

								<table width="100%" cellpadding="0" cellspacing="0" bgcolor="ecedee">
									  <tbody>
										<tr>
										  <td>
											<table width="960" align="center" bgcolor="#FFFFFF" style="border-collapse:collapse">
											  <tbody>
												<tr> </tr>
												<tr>
												  <td>
													<table width="100%">
													  <tbody>
														<tr>
														  <td width="5%">&nbsp;</td>
														  <td width="90%" style="font-family:Verdana,Geneva,sans-serif;font-size:14px">
															<div style="min-height:200px;color:#6f6960">
															<p>Dear Admin,</p><br>


															  <p>Details are below: <br>
																Name : ' . $name . '<br>
																Email : ' . $email . '<br>
																Phone No : ' . $phone . '<br>
																Message : ' . $msg . '<br>

																</p>

															</div>



														  </td>
														  <td width="5%">&nbsp;</td>
														</tr>
													  </tbody>
													</table>
												  </td>
												</tr>
												<tr style="background-color:#888888;border-top:#8dc61c solid 5px"> </tr>
											  </tbody>
											</table>
										  </td>
										</tr>
										<tr>
										  <td>
											<table width="960" align="center">
											  <tbody>
												<tr>
												  <td></td>
												</tr>
											  </tbody>
											</table>
										  </td>
										</tr>
									  </tbody>
									</table>





						 ';

		$this->email->from($_POST['email'], $_POST['name']);

		$this->email->to('minesh8155@gmail.com'); //capbmandco@gmail.com

		$this->email->subject('Contact Us');

		$this->email->message($message);

		$this->email->send();

	}

	//google captcha testing for localhost
	//Site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
	//Secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe

	//live seceret key : 6LcIEYAUAAAAANuedRyUDkWyw_nvzoXk7uTZUkJ8

	function check_google_validate_captcha() {

		$google_captcha = $this->input->post('g-recaptcha-response');

		$google_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcIEYAUAAAAANuedRyUDkWyw_nvzoXk7uTZUkJ8&response=" . $google_captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);

		if ($google_response . 'success' == false) {

			$this->form_validation->set_message('check_google_validate_captcha', 'Please check the the captcha form');

			return FALSE;

		} else {

			return TRUE;
		}
	}

}
