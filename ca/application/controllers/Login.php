<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Member_module');
	}
	function view() {
		$this->index();
	}
	public function index($arr = NULL) {
		$this->check_login();
		$data['show_msg'] = $arr['msg'];
		$this->load->view('page/login', $data);
	}
	function check() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('show_msg', 'Invaild Username And Password');
				$arr['msg'] = 'Invalid Username and Password';
				$this->index($arr);
			} else {
				if (!$this->_check()) {
					$arr['msg'] = 'Invalid Username and Password';
					$this->index($arr);
				}
			}
		} else {
			$this->index();
		}
	}
	protected function _check() {
		$result = $this->Member_module->check_login();
		if (isset($result[0])) {
			$this->_authentication_submit($result[0]['usercode']);
		} else {
			$this->login_record();
			return false;
		}
	}
	private function _authentication_submit($member_id) {
		$result = $this->comman_fun->get_table_data('membermaster', array('usercode' => $member_id));
		$sess_array = array();
		$sess_array['name'] = $result[0]['fname'] . ' ' . $result[0]['lname'];
		$sess_array['usercode'] = $result[0]['usercode'];
		$sess_array['username'] = $result[0]['username'];
		$sess_array['emailid'] = $result[0]['emailid'];
		if ($result[0]['profile_pic'] != '') {
			$profile_img = './upload/' . $result[0]['profile_img'];
			if (file_exists($profile_img)) {
				$sess_array['profile_pic'] = $result[0]['profile_img'];
			} else {
				$sess_array['profile_pic'] = 'profile.png';
			}
		} else {
			$sess_array['profile_pic'] = 'profile.png';
		}
		$sess_array['login'] = 'true';
		$sess_array['login_code'] = $this->login_record(true, $result[0]['usercode'], array('username' => $result[0]['username'], 'password' => $result[0]['password']));
		$this->session->set_userdata('pbm_login', $sess_array);
		//if($this->Member_module->check_admin($result[0]['usercode'])){
		if ($result[0]['role'] == 'admin') {
			$info = array();
			$info['login'] = 'true';
			$info['admin'] = 'true';
			$this->session->set_userdata('pbm_admin', $info);
			$info = array();
			$info['login'] = true;
			$info['usercode'] = $result[0]['usercode'];
			$this->session->set_userdata('pbm_superadmin', $info);
			header('Location: ' . file_path('admin') . 'dashboard/view/');
			exit;
		} else if ($result[0]['role'] == 'emp') {
			$info = array();
			$info['login'] = true;
			$info['usercode'] = $result[0]['usercode'];
			$this->session->set_userdata('pbm_emp', $info);
			header('Location: ' . file_path('emp') . 'dashboard/view/');
		} else if ($result[0]['role'] == 'client') {
			$info = array();
			$info['login'] = true;
			$info['usercode'] = $result[0]['usercode'];
			$this->session->set_userdata('pbm_client', $info);
			header('Location: ' . file_path('client') . 'dashboard/view/');
		} else if ($result[0]['role'] == 'account') {
			$info = array();
			$info['login'] = true;
			$info['usercode'] = $result[0]['usercode'];
			$this->session->set_userdata('pbm_accountant', $info);
			header('Location: ' . file_path('accountant') . 'dashboard/view/');
		}
	}
	//**check login**//
	protected function check_login() {
		if ($this->session->userdata('pbm_admin')) {
			header('Location: ' . file_path('admin') . 'dashboard/view/');
			exit;
		}
		if ($this->session->userdata('pbm_emp')) {
			header('Location: ' . file_path('emp') . 'dashboard/view/');
			exit;
		}
		if ($this->session->userdata('pbm_client')) {
			header('Location: ' . file_path('client') . 'dashboard/view/');
			exit;
		}
		if ($this->session->userdata('pbm_accountant')) {
			header('Location: ' . file_path('accountant') . 'dashboard/view/');
			exit;
		}
	}
	protected function login_record($status = NULL, $usercode = NULL, $arr = NULL) {
		$now = time();
		$data['username'] = (isset($_POST['username']) ? $_POST['username'] : $arr['username']);
		$data['password'] = (isset($_POST['password']) ? $_POST['password'] : $arr['password']);
		$data['timedt'] = date('Y-m-d H:i:s');
		if ($status == true) {
			$data['usercode'] = $usercode;
			$data['status'] = 'Sucess';
			$data['availeble'] = 'Y';
			$data['last_event'] = time();
			$data['logintime'] = time();
			$data['availeble'] = 'Y';
		} else {
			$data['status'] = 'Failed';
			$data['availeble'] = 'N';
		}
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		$data['browserdt'] = $_SERVER["HTTP_USER_AGENT"];
		$login_code = $this->comman_fun->addItem($data, 'web_login_info');
		return $login_code;
	}
	function logout() {
		$now = time();
		$data['availeble'] = 'N';
		$data['logout_time'] = date('Y-m-d H:i:s');
		$this->comman_fun->update($data, 'web_login_info', 'login_code', $this->session->userdata['pbm_login']['login_code']);
		$this->session->sess_destroy();
		header('Location: ' . base_url() . 'index.php/login');
		exit;
	}
	function back() {
		header('Location: ' . base_url() . 'index.php/login');
		exit;
	}

	public function send_resetpass_link() {

		$to = "phoenixbinary224@gmail.com";

		// Below the subject of the email
		$e_subject = 'Reset your Password.';

		$link = file_path() . 'login/reset_password';

		$message = '<div style="width:500px;height:auto;border:1px solid #c1c1c1;margin:0 auto 100px;font-size:15px">
	        <div style="height:auto;padding:30px">
	            <div style="width:100%;display:inline-block;vertical-align:top;text-align:center">
	                <img src="<?=base_url("assets/web/img/logos/kt-logo.png")?>" style="width:71%;">
	            </div>
	            <hr style="width:100%;height:3px;background:#fac66c;border:unset;margin-bottom:25px">
	            <div style="width:100%;text-align:left;display:inline-block">
	                <span style="font-size:18px"><b>Hi..! <span tyle="color:#ffb941">Admin</span></b></span>,<br>
	                <span></span><br>
	                <span style="font-size:17px">Reset Your Password: <a href="' . $link . '" style="text-decoration:unset;"><span style="color:#ffb941">Click here...</span></a><br>
	                </div>
	            </div>
	        </div></div>';

		$from_email = 'KT Consultancy<mobilityright@gmail.com>';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= 'From:' . $from_email . "\r\n";
		$headers .= 'Reply-To:' . $from_email . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		$headers .= 'Content-transfer-encoding: 7bit';

		$res = mail($to, $e_subject, $message, $headers);

		if ($res) {
			echo "1";
		} else {
			echo '0';
		}
	}

	public function reset_password() {
		$this->form_validation->set_rules('new_password', 'Invalid Password', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('page/reset_password');
		} else {
			$data['password'] = strip_tags(stripslashes($this->input->post('new_password')));
			$this->db->where('usercode', '83');
			$res = $this->db->update('membermaster', $data);
			if ($res == true) {
				// $this->session->set_flashdata('success', " Password Changed successfully.");
				header('Location: ' . base_url() . 'index.php/login');
			} else {
				// $this->session->set_flashdata('error', " Password not Changed.");
				header('Location: ' . base_url() . 'index.php/login');
			}
		}
	}

}
