<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Web_app extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('web_app_module', 'ObjM', TRUE);

		date_default_timezone_set('Asia/Calcutta');

		$this->load->library('upload');

		$this->load->library('image_lib');

		$this->load->library('email');

	}

	public function login() {
		$mobileno = $_REQUEST['mobileno'];

		$result = $this->ObjM->login(array('mobileno' => $mobileno));

		if (isset($result[0])) {

			if ($result[0]['status'] == 'Active') {

				$otp = rand(1000, 9999);
				$updata['otp'] = $otp;
				$this->db->where('mobileno', $mobileno);
				$rass = $this->db->update('membermaster', $updata);
				// var_dump($rass);exit;
				if ($rass == TRUE) {

					$this->send_OTP($otp, $mobileno);

				}
				$json_arr['msg'] = "OTP has been send to your mobileno.";

				$json_arr['validation'] = 'true';

				echo json_encode($json_arr);exit;

			} else {

				$json_arr['validation'] = "false";

				$json_arr['msg'] = "User not active.";

				echo json_encode($json_arr);exit;
			}

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "User not found.";

			echo json_encode($json_arr);exit;
		}

	}

	function send_OTP($otp, $mobileno) {
		//Your authentication key
		//$authKey = "14264AxndyZBeQ58cb7818";//OLD

		$authKey = "16222AxxLljQfoG5ae95303";

		//Multiple mobiles numbers separated by comma
		// $mobileNumber = "9999999";
		$mobileNumber = $mobileno;

		//Sender ID,While using route4 sender id should be 6 characters long.

		//$senderId = "SGGANG";OLD

		$senderId = "PNXTAX";

		//Your message to send, Add URL encoding here.
		$message = urlencode("KT Consultancy verification OTP code $otp");

		//Define route
		$route = "default";
		//Prepare you post parameters
		$postData = array(
			'authkey' => $authKey,
			'mobiles' => $mobileNumber,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route,
		);

		//API URL
		$url = "http://sms.ssdindia.com/api/sendhttp.php";

		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			//,CURLOPT_FOLLOWLOCATION => true
		));

		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		//get response
		$output = curl_exec($ch);

		//Print error if any
		if (curl_errno($ch)) {
			echo 'error:' . curl_error($ch);
		}

		curl_close($ch);

	}

	function otpverify() {

		$mobileno = $_REQUEST['mobileno'];

		$otp = $_REQUEST['otp'];

		$result = $this->ObjM->get_otpverify(array('mobileno' => $mobileno, 'otp' => $otp));
		// var_dump($result);

		// exit;

		if ($result) {

			$json_arr = array();

			$json_arr['usercode'] = $result[0]['usercode'];

			$json_arr['fname'] = $result[0]['fname'];

			$json_arr['lname'] = $result[0]['lname'];

			$json_arr['emailid'] = $result[0]['emailid'];

			$json_arr['mobileno'] = $result[0]['mobileno'];

			$json_arr['city'] = $result[0]['city'];

			$json_arr['address'] = $result[0]['address'];

			//$json_arr['company_name']	=	$result[0]['company_name'];

			//$json_arr['amount']			=	$result[0]['amount'];

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "User not found.";

			echo json_encode($json_arr);exit;
		}

	}

	function add_gcm_id() {

		$app_regid = $_REQUEST['gcm_id'];

		$usercode = $_REQUEST['usercode'];

		$dt = $this->comman_fun->get_table_data('api_gcm_regid', array('usercode' => $usercode));

		if (count($dt) > 0) {
			$updata['app_regid'] = $app_regid;

			$updata['usercode'] = $usercode;

			$updata['status'] = 'Active';

			$this->comman_fun->update($updata, 'api_gcm_regid', array('usercode' => $usercode));

			$data_json = array();

			$data_json['success'] = 'success';

			echo json_encode($data_json);

			exit;
		} else {

			$data = array();

			$data['app_regid'] = $app_regid;

			$data['usercode'] = $usercode;

			$data['create_date'] = date('Y-m-d');

			$data['status'] = 'Active';

			$id = $this->comman_fun->addItem($data, 'api_gcm_regid');

			if ($id > 0) {
				$data_json = array();

				$data_json['success'] = 'success';

				echo json_encode($data_json);
			}
		}
	}

	public function get_userlist() {
		$usercode = $_REQUEST['usercode'];

		$result = $this->ObjM->get_users($usercode);

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['fname'] = $result[$i]['fname'];

				$data['lname'] = $result[$i]['lname'];

				$data['emailid'] = $result[$i]['emailid'];

				$data['mobileno'] = $result[$i]['mobileno'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "There is no user";

			echo json_encode($json_arr);exit;
		}

	}

	public function get_itr_document() {
		$usercode = $_REQUEST['usercode'];

		$sub_id = $_REQUEST['sub_id'];

		$result = $this->ObjM->get_all_itr($usercode, $sub_id);

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['usercode'] = $result[$i]['usercode'];

				$data['sub_id'] = $result[$i]['sub_id'];

				$data['title'] = $result[$i]['title'];

				$data['type'] = $result[$i]['type'];

				$data['create_date'] = $result[$i]['create_date'];

				$data['fee_status'] = $result[$i]['is_paid'];

				$data['allow_download'] = $result[$i]['allow_download'];

				//$data['upload_file']		=	$result[$i]['upload_file'];

				$data['file_path'] = base_url() . "upload/web/itr_doc/" . $result[$i]['upload_file'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "There is no ITR Document";

			echo json_encode($json_arr);exit;
		}

	}

	public function get_gst_document() {
		$usercode = $_REQUEST['usercode'];

		$sub_id = $_REQUEST['sub_id'];

		$result = $this->ObjM->get_all_gst($usercode, $sub_id);

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['usercode'] = $result[$i]['usercode'];

				$data['sub_id'] = $result[$i]['sub_id'];

				$data['title'] = $result[$i]['title'];

				$data['type'] = $result[$i]['type'];

				$data['create_date'] = $result[$i]['create_date'];

				//$data['upload_file']		=	$result[$i]['upload_file'];

				$data['fee_status'] = $result[$i]['is_paid'];

				$data['allow_download'] = $result[$i]['allow_download'];

				$data['file_path'] = base_url() . "upload/web/gst/" . $result[$i]['upload_file'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "There is no GST Document";

			echo json_encode($json_arr);exit;
		}

	}

	public function get_roc_document() {
		$usercode = $_REQUEST['usercode'];

		$sub_id = $_REQUEST['sub_id'];

		$result = $this->ObjM->get_all_roc($usercode, $sub_id);

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['usercode'] = $result[$i]['usercode'];

				$data['sub_id'] = $result[$i]['sub_id'];

				$data['title'] = $result[$i]['title'];

				//$data['type']			=	$result[$i]['type'];

				$data['create_date'] = $result[$i]['create_date'];

				//$data['upload_file']		=	$result[$i]['upload_file'];

				$data['fee_status'] = $result[$i]['is_paid'];

				$data['allow_download'] = $result[$i]['allow_download'];

				$data['file_path'] = base_url() . "upload/web/roc/" . $result[$i]['upload_file'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "There is no ROC Document";

			echo json_encode($json_arr);exit;
		}

	}

	public function get_other_document() {
		$usercode = $_REQUEST['usercode'];

		$sub_id = $_REQUEST['sub_id'];

		$result = $this->ObjM->get_all_other_document($usercode, $sub_id);

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['usercode'] = $result[$i]['usercode'];

				$data['sub_id'] = $result[$i]['sub_id'];

				$data['doc_details'] = $result[$i]['doc_details'];

				$data['create_date'] = $result[$i]['create_date'];

				//$data['upload_file']		=	$result[$i]['upload_file'];

				$data['file_path'] = base_url() . "upload/web/doc/" . $result[$i]['upload_file'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "There is no Document";

			echo json_encode($json_arr);exit;
		}

	}

	public function get_userlist_request_form() {
		$usercode = $_REQUEST['usercode'];

		$result = $this->ObjM->get_client_list($usercode);

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['usercode'] = $result[$i]['usercode'];

				$data['fname'] = $result[$i]['fname'];

				$data['lname'] = $result[$i]['lname'];

				$data['emailid'] = $result[$i]['emailid'];

				$data['mobileno'] = $result[$i]['mobileno'];

				$data['company_name'] = $result[$i]['company_name'];

				$data['self'] = $result[$i]['self'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "User not found.";

			echo json_encode($json_arr);exit;
		}

	}

	public function get_servicelist_request_form() {

		$result = $this->ObjM->get_services();

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['name'] = $result[$i]['name'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "User not found.";

			echo json_encode($json_arr);exit;
		}

	}

	function add_request() {

		$json_arr = array();

		$data['service_id'] = $_REQUEST['service_id'];

		$data['req_for'] = $_REQUEST['req_for'];

		$data['request_details'] = $_REQUEST['request_details'];

		$data['usercode'] = $_REQUEST['usercode'];

		$data['status'] = 'Active';

		$data['seen'] = 'No';

		$data['add_from'] = 'App';

		$data['create_date'] = date('Y-m-d H:i:s');

		$id_s = $this->ObjM->addItem($data, 'service_request');

		$notification_data = array(

			'type' => 'add_service_request',

			'class_type' => 'service_request',

			'usercode_sender' => $_REQUEST['usercode'],

			'rec_id' => $id_s,

			'usercode_reciever' => '1',

			'message' => 'Sent Service Request.',

		);

		$this->ObjM->add_notification($notification_data);

		$json_arr['validation'] = "true";

		echo json_encode($json_arr);exit;

	}

	function add_support() {

		$json_arr = array();

		$data['subject'] = $_REQUEST['subject'];

		$data['message'] = $_REQUEST['message'];

		$data['usercode'] = $_REQUEST['usercode'];

		$data['status'] = 'Active';

		$data['add_from'] = 'App';

		$data['create_date'] = date('Y-m-d H:i:s');

		$id_s = $this->ObjM->addItem($data, 'support_master');

		$notification_data = array(

			'type' => 'add_support',

			'class_type' => 'support',

			'usercode_sender' => $_REQUEST['usercode'],

			'rec_id' => $id_s,

			'usercode_reciever' => '1',

			'message' => 'Sent Support Query.',

		);

		$this->ObjM->add_notification($notification_data);

		$json_arr['validation'] = "true";

		echo json_encode($json_arr);exit;

	}

	function add_document_multiple() {

		$cpt = count($_FILES['upload_file']['name']);

		$files = $_FILES;

		$config = array();

		$config['upload_path'] = './upload/web/doc/';

		$config['allowed_types'] = 'pdf|jpeg|jpg|png|docx|csv|xlsx|xls';

		$config['max_size'] = '0';

		$config['overwrite'] = TRUE;

		$upload_count = 0;

		for ($i = 0; $i < $cpt; $i++) {

			if ($files['upload_file']['name'][$i]) {

				$_FILES['userfile']['name'] = $files['upload_file']['name'][$i];

				$_FILES['userfile']['type'] = $files['upload_file']['type'][$i];

				$_FILES['userfile']['tmp_name'] = $files['upload_file']['tmp_name'][$i];

				$_FILES['userfile']['error'] = $files['upload_file']['error'][$i];

				$_FILES['userfile']['size'] = $files['upload_file']['size'][$i];

				$rand = md5(uniqid(rand(), true));

				$fileName = 'du_' . $rand . '' . $_FILES['upload_file']['name'];

				$fileName = str_replace(" ", "", $fileName);

				$config['file_name'] = $fileName;

				$this->upload->initialize($config);

				$image_info = getimagesize($_FILES["upload_file"]["tmp_name"]);

				if ($this->upload->do_upload()) {

					$upload_count++;

					$upload_data = $this->upload->data();

					$_POST['file_name'] = $upload_data['file_name'];

					$json_arr = array();

					$data['sub_id'] = $_REQUEST['sub_id'];

					$data['doc_details'] = $_REQUEST['doc_details'];

					$data['upload_file'] = $upload_data['file_name'];

					$data['usercode'] = $_REQUEST['usercode'];

					$data['status'] = 'Active';

					$data['add_from'] = 'App';

					$data['create_date'] = date('Y-m-d H:i:s');

					$id_s = $this->comman_fun->additem($data, 'document_master');

					$data = false;

				} else {

					echo $this->upload->display_errors();
				}
			}

		}

		$notification_data = array(

			'type' => 'add_new_document',

			'class_type' => 'document',

			'usercode_sender' => $_REQUEST['usercode'],

			'rec_id' => $id_s,

			'usercode_reciever' => '1',

			'message' => 'New Document Received.',

		);

		$this->ObjM->add_notification($notification_data);

		$json_arr['validation'] = "true";

		echo json_encode($json_arr);exit;

	}

	function add_document() {

		$json_arr = array();

		$data['sub_id'] = $_REQUEST['sub_id'];

		$data['doc_details'] = $_REQUEST['doc_details'];

		$data['usercode'] = $_REQUEST['usercode'];

		$data['status'] = 'Active';

		$data['add_from'] = 'App';

		$data['create_date'] = date('Y-m-d H:i:s');

		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name'])) {
			$this->handle_upload();

			$data['upload_file'] = $_POST['file_name'];

		}

		$this->ObjM->addItem($data, 'document_master');

		$json_arr['validation'] = "true";

		echo json_encode($json_arr);exit;

	}

	function handle_upload() {
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name'])) {
			$config = array();
			$config['upload_path'] = './upload/web/doc/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf|xlsx|xls|csv|docx';
			$config['max_size'] = '0';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$_FILES['userfile']['name'] = $_FILES['upload_file']['name'];
			$_FILES['userfile']['type'] = $_FILES['upload_file']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['upload_file']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['upload_file']['error'];
			$_FILES['userfile']['size'] = $_FILES['upload_file']['size'];

			$fileName = 'du_' . $_FILES['upload_file']['name'];
			$fileName = str_replace(" ", "", $fileName);
			$config['file_name'] = $fileName;
			$this->upload->initialize($config);

			if ($this->upload->do_upload()) {
				ini_set('upload_max_filesize', '64M');

				$upload_data = $this->upload->data();
				$_POST['file_name'] = $upload_data['file_name'];

				return true;
			} else {

				echo $this->upload->display_errors();
			}
		}

	}

	function get_profile() {

		$usercode = $_REQUEST['usercode'];

		$result = $this->ObjM->get_user_profile($usercode);

		if (isset($result[0])) {

			$json_arr = array();

			$json_arr['usercode'] = $result[0]['usercode'];

			$json_arr['fname'] = $result[0]['fname'];

			$json_arr['lname'] = $result[0]['lname'];

			$json_arr['emailid'] = $result[0]['emailid'];

			$json_arr['mobileno'] = $result[0]['mobileno'];

			$json_arr['city'] = $result[0]['city'];

			$json_arr['address'] = $result[0]['address'];

			$json_arr['company_name'] = $result[0]['company_name'];

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "User not found.";

			echo json_encode($json_arr);exit;
		}

	}

	function edit_profile() {

		$json_arr = array();

		$record = $this->comman_fun->get_table_data('membermaster', array('usercode' => $_REQUEST['usercode']));

		if (count($record) > 0) {

			$data['emailid'] = $_REQUEST['emailid'];

			//$data['mobileno']		=	$_REQUEST['mobileno'];

			$data['address'] = $_REQUEST['address'];

			$this->comman_fun->update($data, 'membermaster', array('usercode' => $_REQUEST['usercode']));

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = 'false';

			echo json_encode($json_arr);exit;
		}

	}

	function get_notification() {

		$usercode = $_REQUEST['usercode'];

		//$result = $this->ObjM->get_usernotification($usercode);

		$result = $this->get_client_notification($usercode);

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			function myFieldSort($a, $b) {
				return $b['noti_code'] - $a['noti_code'];
			}

			usort($result, "myFieldSort");

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['noti_code'] = $result[$i]['noti_code'];

				$data['noti_title'] = $result[$i]['noti_title'];

				$data['noti_desc'] = $result[$i]['noti_desc'];

				$data['create_date'] = $result[$i]['create_date'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "No Data Found.!";

			echo json_encode($json_arr);exit;
		}
	}

	function get_client_notification($usercode) {

		$arr = array('All_client');

		$record_all = $this->ObjM->get_notification_by_send_type($arr);

		$arr = array('send_type' => 'Selected_client', 'usercode' => $usercode);

		$record_pericular = $this->ObjM->get_notification_by_pericular($arr);

		$noti_arr = array_merge($record_all, $record_pericular);

		return $noti_arr;

	}

	function get_dueamt() {

		$usercode = $_REQUEST['usercode'];

		$result = $this->ObjM->get_due_amt_all_user($usercode);
		//echo $this->db->last_query();exit;

		if (isset($result[0])) {

			$json_arr = array();

			if ($result[0]['tot_due_amt'] != 0) {

				$amt = $result[0]['tot_due_amt'];

			} else {

				$amt = "0.00";

			}

			$json_arr['due_amount'] = $amt;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "User not found.";

			echo json_encode($json_arr);exit;
		}

	}

	function get_dueamt_by_user() {

		$usercode = $_REQUEST['usercode'];

		$sub_id = $_REQUEST['sub_id'];

		$result = $this->ObjM->get_due_amt_by_subuser($usercode, $sub_id);

		if (isset($result[0])) {

			$json_arr = array();

			if ($result[0]['tot_due_amt'] != 0) {

				$amt = $result[0]['tot_due_amt'];

			} else {

				$amt = "0.00";

			}

			$json_arr['due_amount'] = $amt;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "User not found.";

			echo json_encode($json_arr);exit;
		}

	}

	function change_password() {

		$json_arr = array();

		$usercode = $_REQUEST['usercode'];

		$old_pass = $_REQUEST['old_pass'];

		$new_pass = $_REQUEST['new_pass'];

		if ($this->check_old_password($usercode, $old_pass)) {

			if ($new_pass != "") {

				$data = array();

				$data['password'] = $new_pass;

				$this->comman_fun->update($data, 'membermaster', array('usercode' => $usercode));

				$json_arr['validation'] = "true";

				echo json_encode($json_arr);exit;

			} else {

				$json_arr['validation'] = "false";

				$json_arr['msg'] = "Please enter new password";

				echo json_encode($json_arr);exit;
			}

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "Old Password is incorrect.";

			echo json_encode($json_arr);exit;
		}

	}

	function check_old_password($usercode, $old_pass) {

		if (!$this->comman_fun->check_record('membermaster', array('usercode' => $usercode, 'password' => $old_pass))) {
			return FALSE;
		}
		return TRUE;
	}

	function forgot_password() {

		$emailid = $_REQUEST['emailid'];

		if ($this->comman_fun->check_record('membermaster', array('emailid' => $emailid))) {

			$result = $this->comman_fun->get_table_data('membermaster', array('emailid' => $emailid));

			$name = $result[0]['fname'] . ' ' . $result[0]['lname'];

			$username = $result[0]['username'];

			$password = $result[0]['password'];

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
														<p>Dear ' . $name . ',</p><br>


														  <p> You recenlty requested to forgot password for your account <b>' . $username . '</b>. Your Password is <b>' . $password . '</b>
														  	<br><br><br>
															Thanks, <br>PBM & Co. Team
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

			$this->email->from('capbmandco@gmail.com');

			$this->email->to($emailid);

			$this->email->subject('Forgot Password');

			$this->email->message($message);

			$this->email->send();

			$json_arr['validation'] = "true";

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "Please Enter Correct Email.";

			echo json_encode($json_arr);exit;

		}

	}

	public function get_document() {
		$usercode = $_REQUEST['usercode'];

		$sub_id = $_REQUEST['sub_id'];

		$result = $this->ObjM->get_All_doc($usercode, $sub_id);

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['usercode'] = $result[$i]['usercode'];

				$data['sub_id'] = $result[$i]['sub_id'];

				$data['title'] = $result[$i]['title'];

				$data['create_date'] = $result[$i]['create_date'];

				//$data['upload_file']		=	$result[$i]['upload_file'];

				$data['file_path'] = base_url() . "upload/web/doc/" . $result[$i]['upload_file'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "There is No Document";

			echo json_encode($json_arr);exit;
		}

	}
	function test() {

		//$usercode	=	$_REQUEST['usercode'];

		$data = array();

		$data['name'] = $_REQUEST['name'];

		$data['city'] = $_REQUEST['city'];

		$data['create_date'] = date('Y-m-d');

		//$data['status']			= 'Active';

		$id = $this->comman_fun->addItem($data, 'test');

		if ($id > 0) {
			$data_json = array();

			$data_json['success'] = 'success';

			echo json_encode($data_json);
		}
	}

	public function get_gst_mast() {
		$usercode = $_REQUEST['usercode'];

		//$sub_id		=	$_REQUEST['sub_id'];

		$id = $_REQUEST['id'];

		$result = $this->ObjM->get_kt_gst($usercode, $sub_id, $id);

		//var_dump($result);exit;

		if (isset($result[0])) {

			$json_arr = array();

			$arr = array();

			for ($i = 0; $i < count($result); $i++) {

				$data = array();

				$data['id'] = $result[$i]['id'];

				$data['usercode'] = $result[$i]['usercode'];

				$data['sub_id'] = $result[$i]['sub_id'];

				$data['title'] = $result[$i]['title'];

				$data['create_date'] = $result[$i]['create_date'];

				//$data['upload_file']		=	$result[$i]['upload_file'];

				//$data['file_path']	=	base_url()."upload/web/doc/".$result[$i]['upload_file'];

				$arr[] = $data;

			}

			$json_arr['data'] = $arr;

			$json_arr['validation'] = 'true';

			echo json_encode($json_arr);exit;

		} else {

			$json_arr['validation'] = "false";

			$json_arr['msg'] = "There is No Document";

			echo json_encode($json_arr);exit;
		}

	}
}
