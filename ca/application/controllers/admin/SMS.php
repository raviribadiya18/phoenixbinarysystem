<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class SMS extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {

			header('Location: ' . file_path() . 'login');

			exit;

		}

		ob_start();

		ob_end_flush();

		$this->load->model('admin/SMS_module', 'ObjM', TRUE);

		$this->load->library('form_validation');

		$this->load->library('upload');

		$this->load->library('image_lib');

	}

	function view($mode) {

		$data['segment'] = array('mode' => $mode);

		$page_info['menu_id'] = 'menu-sms';

		$page_info['page_title'] = 'SMS List';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);
		$this->load->view('admin/sms_add', $data);
		$this->load->view('comman/footer_admin');
	}

	function insertrecord() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$data = array();

			// $this->form_validation->set_rules('noti_title', 'Notification title', 'required|trim');

			$this->form_validation->set_rules('noti_desc', 'Message Description', 'required|trim');

			$this->form_validation->set_rules('receiver_code', 'Send Receiver', 'required');

			if ($this->form_validation->run() == FALSE) {
				$this->view($this->input->post('mode'));

			} else {

				// $data['noti_title'] = filter_data($this->input->post('noti_title'));
				$send_type = $this->input->post('receiver_code');
				$noti_desc = filter_data($this->input->post('noti_desc'));
				if ($send_type == 'All_client') {
					$client_list = $this->ObjM->get_clients();
					for ($i = 0; $i < count($client_list); $i++) {
						$mob1 = $client_list[$i]['mobileno'];
						$this->SendSMS($mob1, $noti_desc);
					}
				} else if ($this->input->post('receiver_code') == 'Selected_client') {
					$mob = $this->input->post('endcode');
					for ($i = 0; $i < count($mob); $i++) {
						$this->SendSMS($mob[$i], $noti_desc);
					}
				}
				$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'SMS Sent Successfully.....'));
				redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");
				//echo '<script>window.location.href="'.base_url().'index.php/notification"</script>';
				//header('Location: '.base_url().'index.php/notification');
				exit;
			}
		}

	}

	public function SendSMS($mob = '', $msg = '') {

		$authKey = "16222AxxLljQfoG5ae95303";
		//Multiple mobiles numbers separated by comma
		$mobileNumber = $mob;
		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "PNXTAX";
		//Your message to send, Add URL encoding here.
		$message = urlencode(" $msg");

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
		} else {
			$arr = array();
			$arr['true'] = 'true';
			$arr['rid'] = $rid;
			echo json_encode($arr);
		}
		curl_close($ch);
	}

	//****Fun For GET All Number List*****//
	protected function ger_gcm_id() {

		$client_list = array();

		if ($this->input->post('receiver_code') == 'All_client' || $_POST['receiver_code'] == 'Selected_client') {

			$client_list = $this->get_client_gcm();

		}

		$list = $client_list;

		return $list;

	}

	//****Fun For GET Student Number List*****//
	function get_client_gcm() {

		$list = array();

		$arr = array();

		$receiver_code = $this->input->post('receiver_code');

		if ($receiver_code == 'Selected_client') {
			$arr = array('list' => $this->input->post('endcode'));
		}

		$result = $this->ObjM->get_client_gcm_q($arr);

		for ($i = 0; $i < count($result); $i++) {

			$list[] = $result[$i]['app_regid'];

		}
		return $list;
	}

	function delete_record($eid) {

		$record = $this->comman_fun->get_table_data('notification', array('noti_code' => $eid));

		$data['status'] = 'Delete';

		$this->comman_fun->update($data, 'notification', array('noti_code' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");

	}

	function get_data_list($receiver_code) {
		if ($receiver_code == 'Selected_client') {

			$html = $this->get_client_list();

			echo $html;
		}

	}

	function get_client_list() {

		$result = $this->ObjM->get_clients();

		$html = '<table class="table table-bordered" id="data-table">
				<thead>
					<tr class="thefilter"">
						<th><input type="checkbox"  id="checkall" class="checkall" value=""></th>
						<th>Name</th>
						<th>Contact No.</th>
						<th>City</th>
						<th>Email</th>
					</tr>
				</thead>
		<tbody>';
		for ($i = 0; $i < count($result); $i++) {

			$name = $result[$i]['fname'] . ' ' . $result[$i]['lname'];

			$html .= '<tr>
						<td><input type="checkbox" name="endcode[]" class="endcode" value="' . $result[$i]['mobileno'] . '">
						</td>
						<td>' . $name . '</td>
						<td>' . $result[$i]['mobileno'] . '</td>
						<td>' . $result[$i]['city'] . '</td>
						<td>' . $result[$i]['emailid'] . '</td>
				  </tr>';
		}
		$html .= '</tbody>
    			</table>';
		return $html;

	}

	function test_notification12() {

		$message = array('title' => 'Hi Test', 'data' => 'Hello Phoenix Binary System 8155  s simply dummy text of the printing and typesetting industry.');

		$registatoin_ids = array("e0gGXWuxDS4:APA91bFmK2s-_IoOhu7Qasuo-HrMzZpsOLUqb0n4Ll69NpyBSDbsUDWcaWMgujTO83QVCPwlbwA27KL8z2OXEDckdh9lzRHzHBhqrx9P-NMOd4tr30W58S_YzdeM7zZgUylMIOheg96y");

		$this->send_notification($registatoin_ids, $message);

	}

	protected function send_notification($registatoin_ids, $message) {

		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array(
			'registration_ids' => $registatoin_ids,
			'data' => $message,
		);

		$headers = array(
			'Authorization: key=' . GOOGLE_API_KEY,
			'Content-Type: application/json',
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		//echo phpinfo();

		//var_dump($fields);
		echo $result;
	}

}
