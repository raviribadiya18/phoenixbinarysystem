<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Client extends CI_Controller {
	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {

			header('Location: ' . file_path() . 'login');

			exit;

		}

		date_default_timezone_set('Asia/Calcutta');

		ob_start();

		ob_end_flush();

		$this->load->model('admin/Client_module', 'ObjM', TRUE);

		$this->load->library('form_validation');

		$this->load->library('upload');

		$this->load->library('image_lib');

	}

	public function view() {

		$data['html'] = $this->listing();
		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Client';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_view', $data);

		$this->load->view('comman/footer_admin');

	}

	function listing() {

		$result = $this->ObjM->getAll_client();

		$html = '';

		for ($i = 0; $i < count($result); $i++) {

			if ($result[$i]['status'] == 'Active') {
				$current_status = 'Active';
				$update_status = 'Inactive';
				$cls = 'btn-success';
			} else {
				$current_status = 'Inactive';
				$update_status = 'Active';
				$cls = 'btn-danger';
			}

			$result = $this->ObjM->getAll_client();

			$result_due_amt = $this->ObjM->get_due_amt_all_user($result[$i]['usercode']);

			if ($result_due_amt[0]['tot_due_amt'] != 0) {

				$amt = $result_due_amt[0]['tot_due_amt'];

			} else {

				$amt = "0.00";

			}

			// <td>' . $result[$i]['username'] . '</td>
			// <td>' . $result[$i]['password'] . '</td>

			$row = $i + 1;
			$html .= '<tr>
						<td>' . $row . '</td>
						<td>' . $result[$i]['fname'] . ' ' . $result[$i]['lname'] . '</td>
						<td>' . $result[$i]['company_name'] . '</td>
						<td>' . $result[$i]['mobileno'] . '</td>
						<td>' . $result[$i]['emailid'] . '</td>
						<td>' . $result[$i]['city'] . '</td>
						<td>' . $amt . ' /-</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle ' . $cls . ' btn_custom" data-toggle="dropdown">' . $current_status . ' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right myDropDown">
							<li><a class="status_change" href="' . file_path('admin') . 'sub_client/view/' . $result[$i]['usercode'] . '">View Member</a></li><li><a href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/invoice_view/' . $result[$i]['usercode'] . '">Generate Invoice</a></li>
							<li><a href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/addnew/edit/' . $result[$i]['usercode'] . '">Edit</a></li><li><a class="status_change" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/status_update/' . $update_status . '/' . $result[$i]['usercode'] . '">' . $update_status . '</a></li>';

			$html .= '<li><a class="delete_record" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/delete_record/' . $result[$i]['usercode'] . '">Delete</a></li>';
			//<li><a href="'.file_path('admin').''.$this->uri->rsegment(1).'/addnew_dueamt/edit/'.$result[$i]['usercode'].'">Enter Due Amount</a></li>
			//<li><a href="' . file_path('admin') . 'change_account/member/' . $result[$i]['usercode'] . '">Swap to Client Account</a></li>
			$html .= '</ul>
						</div>

						</td>
					</tr>';
		}

		return $html;
	}

	function addnew($mode = NULL, $eid = NULL) {

		if ($mode == 'edit') {
			$data['form_set'] = array('mode' => 'edit', 'eid' => $eid);

			$data['result'] = $this->ObjM->get_record($eid);

		} else {
			$data['form_set'] = array('mode' => 'add');

		}

		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Client';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);
		$this->load->view('admin/' . $this->uri->rsegment(1) . '_add', $data);

		$this->load->view('comman/footer_admin');

	}

	function insert() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('fname', 'First Name', 'required|trim');

			$this->form_validation->set_rules('lname', 'Last Name', 'required|trim');

			// $this->form_validation->set_rules('company_name', 'Company Name', 'required|trim');

			$this->form_validation->set_rules('mobileno', 'mobileno', 'required|trim');
			//if($_POST['mode']=='edit'){
			//
			//				$this->form_validation->set_rules('mobileno', 'mobileno', 'required|trim|callback_check_edit_unique');
			//
			//			}else{
			//				$this->form_validation->set_rules('mobileno', 'mobileno', 'required|trim|is_unique[membermaster.mobileno]',
			//
			//						array('is_unique' => 'This Mobileno is already taken. Please use a different Mobileno.')
			//					 );
			//			}
			$this->form_validation->set_rules('emailid', 'Email id', 'required|trim');
			//if($_POST['mode']=='edit'){
			//
			//				$this->form_validation->set_rules('emailid', 'Email id', 'required|trim|callback_check_edit_unique_email');
			//
			//			}else{
			//
			//				$this->form_validation->set_rules('emailid', 'Email Id', 'required|trim|is_unique[membermaster.emailid]',
			//
			//						array('is_unique' => 'This Email id is already taken. Please use a different Email id.')
			//					 );
			//			}
			$this->form_validation->set_rules('address', 'Address', 'required|trim');

			$this->form_validation->set_rules('city', 'City', 'required|trim');

			//$this->form_validation->set_rules('username','Username', 'required|trim');
			//if($_POST['mode']!='edit'){
			//				$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[membermaster.username]',
			//
			//					array('is_unique' => 'This Username is already taken. Please use a different Username.')
			//				 );
			//			}
			// $this->form_validation->set_rules('password', 'Password', 'required|trim');

			if ($_POST['mode'] == 'edit') {

				$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			}

			if ($this->form_validation->run() === FALSE) {

				$this->addnew($_POST['mode'], $_POST['eid']);
			} else {

				$this->_insert();

				echo '<script>window.location.href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view"</script>';

				header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view');

				exit;
			}
		}
	}

	function check_edit_unique() {

		$id = $this->input->post('eid');

		$mobileno = $this->input->post('mobileno');

		$res = $this->ObjM->get_record_not_in($id, $mobileno);

		if (count($res) > 0) {

			$this->form_validation->set_message('check_edit_unique', 'This Mobileno is already taken. Please use a different Mobileno.');

			return FALSE;

		} else {

			return TRUE;

		}

	}

	function check_edit_unique_email() {

		$id = $this->input->post('eid');

		$emailid = $this->input->post('emailid');

		$res = $this->ObjM->get_record_email_not_in($id, $emailid);

		if (count($res) > 0) {

			$this->form_validation->set_message('check_edit_unique_email', 'This Email id is already taken. Please use a different Email id.');

			return FALSE;

		} else {

			return TRUE;

		}

	}

	protected function _insert() {

		$data = array();

		$data['fname'] = filter_data($_POST['fname']);

		$data['lname'] = filter_data($_POST['lname']);
		$data['company_name'] = filter_data($_POST['company_name']);
		$data['mobileno'] = filter_data($_POST['mobileno']);

		$data['emailid'] = filter_data($_POST['emailid']);
		$data['address'] = filter_data($_POST['address']);
		$data['city'] = filter_data($_POST['city']);

		// $data['password'] = filter_data($_POST['password']);

//		forsub master table
		$data1['fname'] = filter_data($_POST['fname']);

		$data1['lname'] = filter_data($_POST['lname']);
		$data1['company_name'] = filter_data($_POST['company_name']);
		$data1['mobileno'] = filter_data($_POST['mobileno']);

		$data1['emailid'] = filter_data($_POST['emailid']);

		$data1['address'] = filter_data($_POST['address']);
		$data1['city'] = filter_data($_POST['city']);

		if ($_POST['mode'] == 'add') {
			//$data['username']		=	filter_data($_POST['username']);

			// $data['username'] = $_POST['fname'];

			$data['status'] = 'Active';

			$data['create_date'] = date('Y-m-d h:i:s');

			$data['role'] = 'client';

			$user_code = $this->comman_fun->additem($data, 'membermaster');

			$this->add_to_submem($user_code);

			$this->session->set_flashdata("success", "Record Insert Successfully.....");

			$u_data = array(
				'username' => strtolower($_POST['fname']) . $user_code,
			);
			$this->comman_fun->update($u_data, 'membermaster', array('usercode' => $user_code));

		}
		if ($_POST['mode'] == 'edit') {
			$data['amount'] = filter_data($_POST['amount']);

			$data['last_update'] = date('Y-m-d h:i:s');

			$this->comman_fun->update($data, 'membermaster', array('usercode' => $_POST['eid']));

			$this->comman_fun->update($data1, 'sub_membermaster', array('usercode' => $_POST['eid'], 'self' => '0'));

			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}

	}

	function add_to_submem($usercode) {

		$data = array();

		$data['fname'] = filter_data($_POST['fname']);

		$data['lname'] = filter_data($_POST['lname']);
		$data['company_name'] = filter_data($_POST['company_name']);
		$data['mobileno'] = filter_data($_POST['mobileno']);

		$data['emailid'] = filter_data($_POST['emailid']);

		$data['address'] = filter_data($_POST['address']);
		$data['city'] = filter_data($_POST['city']);
		$data['usercode'] = $usercode;
		$data['status'] = 'Active';
		$data['self'] = '0';

		$data['create_by'] = '1';
		$data['create_date'] = date('Y-m-d h:i:s');

		$data['last_update'] = date('Y-m-d h:i:s');
		$this->comman_fun->additem($data, 'sub_membermaster');

	}

	function handle_upload() {
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name'])) {
			$config = array();
			$config['upload_path'] = './upload/web/slider/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['max_size'] = '0';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$_FILES['userfile']['name'] = $_FILES['upload_file']['name'];
			$_FILES['userfile']['type'] = $_FILES['upload_file']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['upload_file']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['upload_file']['error'];
			$_FILES['userfile']['size'] = $_FILES['upload_file']['size'];
			$rand = md5(uniqid(rand(), true));
			$fileName = $_POST['option_type'] . '_' . $rand . '' . $_FILES['upload_file']['name'];
			$fileName = str_replace(" ", "", $fileName);
			$config['file_name'] = $fileName;
			$this->upload->initialize($config);

			if ($this->upload->do_upload()) {
				$upload_data = $this->upload->data();
				$_POST['file_name'] = $upload_data['file_name'];

				if ($_POST['option_type'] == "slider") {
					$this->_create_slider($upload_data['file_name'], 1349, 500);
				}
				$this->_create_thumbnail($upload_data['file_name'], 250, 250);
				return true;
			} else {

				echo $this->upload->display_errors();
			}
		}

	}

	protected function _create_thumbnail($fileName, $width, $height) {

		$config['image_library'] = 'gd2';
		$config['source_image'] = media_path() . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['new_image'] = media_path() . 'web/slider/thum/' . $fileName;
		$config['thumb_marker'] = '';

		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
	}

	function status_update($st, $eid) {

		$record = $this->comman_fun->get_table_data('membermaster', array('usercode' => $eid));
		$data['status'] = $st;
		$this->comman_fun->update($data, 'membermaster', array('usercode' => $eid));
		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Status ' . $st . ' Successfully.....'));
		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");

	}

	function delete_record($eid) {
		$record = $this->comman_fun->get_table_data('membermaster', array('usercode' => $eid));

		$data['status'] = 'Delete';

		$this->comman_fun->update($data, 'membermaster', array('usercode' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");

	}

	public function invoice_view($usercode = NULL, $sub_uid = NULL) {

		$data['html'] = $this->invoice_listing($usercode, $sub_uid);

		$data['all_option'] = $this->comman_fun->get_table_data('sub_membermaster', array('usercode' => $usercode, 'status' => 'Active'));
		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Invoice';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/invoice_view', $data);

		$this->load->view('comman/footer_admin');

	}

	function invoice_listing($usercode = NULL, $sub_uid = NULL) {

		$result = $this->ObjM->getadd_invoice($usercode, $sub_uid);

		$html = '';

		for ($i = 0; $i < count($result); $i++) {

			if ($result[$i]['status'] == 'Active') {
				$current_status = 'Active';
				$update_status = 'Inactive';
				$cls = 'btn-success';
			} else {
				$current_status = 'Inactive';
				$update_status = 'Active';
				$cls = 'btn-danger';
			}

			$record = $this->comman_fun->get_table_data('membermaster', array('usercode' => $result[$i]['usercode']));

			$record_user = $this->comman_fun->get_table_data('sub_membermaster', array('usercode' => $result[$i]['usercode'], 'id' => $result[$i]['sub_uid']));

			if ($result[$i]['bill_paid'] != "Yes") {

				$color = "style='color:red;'";

				$bt = '<li><a class="status_change" href="' . file_path('admin') . 'fees_collection/view/' . $result[$i]['usercode'] . '/' . $result[$i]['sub_uid'] . '">Fee Collection</a></li>';

			} else {

				$color = "style='color:green;'";

				$bt = "";

			}

			$row = $i + 1;
			$html .= '<tr>
						<td>' . $row . '</td>
						<td>' . $record_user[0]['fname'] . ' ' . $record_user[0]['lname'] . '</td>
						<td><a target="_blank" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/print_order/' . $result[$i]['invoice_id'] . '/' . $result[$i]['usercode'] . '/' . $result[$i]['sub_uid'] . '">Print Invoice</a></td>
						<td>' . $result[$i]['total_amt'] . ' /-</td>
						<td ' . $color . '>' . $result[$i]['bill_paid'] . '</td>
						<td>' . date('d-M-Y', strtotime($result[$i]['invoice_date'])) . '</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle ' . $cls . ' btn_custom" data-toggle="dropdown">' . $current_status . ' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							' . $bt . '
							<li><a class="status_change" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/status_update_invoice/' . $update_status . '/' . $result[$i]['invoice_id'] . '/' . $result[$i]['usercode'] . '">' . $update_status . '</a></li>';

			$html .= '<li><a class="delete_record" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/delete_record_invoice/' . $result[$i]['invoice_id'] . '/' . $result[$i]['usercode'] . '">Delete</a></li>';

			$html .= '</ul>
						</div>

						</td>
					</tr>';
		}

		return $html;
	}

	function status_update_invoice($st, $eid, $usercode) {

		$record = $this->comman_fun->get_table_data('invoice_master', array('invoice_id' => $eid));

		$data['status'] = $st;

		$this->comman_fun->update($data, 'invoice_master', array('invoice_id' => $eid));
		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Status ' . $st . ' Successfully.....'));
		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/invoice_view/" . $usercode);

	}

	function delete_record_invoice($eid, $usercode) {

		$record = $this->comman_fun->get_table_data('invoice_master', array('invoice_id' => $eid));

		$data['status'] = 'Delete';

		$this->comman_fun->update($data, 'invoice_master', array('invoice_id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/invoice_view/" . $usercode);

	}

	function invoiceaddnew($mode = NULL, $usercode = NULL, $eid = NULL) {

		if ($mode == 'edit') {
			$data['form_set'] = array('mode' => 'edit', 'eid' => $eid);

			$data['result'] = $this->ObjM->get_record($eid);

		} else {
			$data['form_set'] = array('mode' => 'add', 'usercode' => $usercode);

		}

		$data['services'] = $this->ObjM->get_services();

		$data['result'] = $this->ObjM->get_record($usercode);

		$data['all_users_list'] = $this->ObjM->get_all_sub_client($usercode);

		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Client';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);
		$this->load->view('admin/invoice_add', $data);

		$this->load->view('comman/footer_admin');

	}

	function insert_invoice() {

		$data = array();

		$data['total_amt'] = filter_data($_POST['total_amt']);

		$data['due_amount'] = filter_data($_POST['total_amt']);

		$data['invoice_date'] = date('Y-m-d', strtotime($_POST['invoice_date']));
		$data['usercode'] = filter_data($_POST['usercode']);

		$data['sub_uid'] = filter_data($_POST['sub_uid']);
		$data['status'] = 'Active';

		$data['bill_paid'] = 'No';
		$data['create_date'] = date('Y-m-d h:i:s');

		$inovice_id = $this->comman_fun->additem($data, 'invoice_master');

//		//here the code for due amount
		//
		//		$record	=	$this->comman_fun->get_table_data('sub_membermaster',array('usercode'=>$_POST['usercode'],'sub_uid'=>$_POST['sub_uid']));
		//
		$_POST['hidden_service_name'];

		for ($i = 0; $i < count($_POST['hidden_service_name']); $i++) {

			$data_dt = array();

			$data_dt['invoice_id'] = $inovice_id;

			$record = $this->comman_fun->get_table_data('service_master', array('id' => $_POST['hidden_service_name'][$i]));

			$data_dt['service_name'] = $record[0]['name'];

			$data_dt['price'] = $_POST['hidden_price'][$i];

			$data_dt['create_date'] = date('Y-m-d h:i:s');

			$this->comman_fun->additem($data_dt, 'invoice_details');

		}
		echo $_POST['usercode'];exit;

	}

	function print_order($eid, $usercode, $sub_uid) {

		$data['invoice_master'] = $this->comman_fun->get_table_data('invoice_master', array('invoice_id' => $eid));

		//$data['user_details']	=	$this->comman_fun->get_table_data('membermaster',array('usercode'=>$usercode));

		$data['user_details'] = $this->comman_fun->get_table_data('sub_membermaster', array('usercode' => $usercode, 'id' => $sub_uid));

		$data['invoice_det'] = $this->comman_fun->get_table_data('invoice_details', array('invoice_id' => $eid));

		$data['rs_in_words'] = $this->no_to_words(round($data['invoice_master'][0]['total_amt']));

		$this->load->view('comman/topheader');

		$this->load->view('admin/print_invoice', $data);

	}

	function no_to_words($no) {
		$words = array('0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fourteen', '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty', '40' => 'fourty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy', '80' => 'eighty', '90' => 'ninty', '100' => 'hundred', '1000' => 'thousand', '100000' => 'lakh', '10000000' => 'crore');
		if ($no == 0) {
			return ' ';
		} else {

			$novalue = '';
			$highno = $no;
			$remainno = 0;
			$value = 100;
			$value1 = 1000;
			while ($no >= 100) {

				if (($value <= $no) && ($no < $value1)) {

					$novalue = $words["$value"];

					$highno = (int) ($no / $value);

					$remainno = $no % $value;
					break;
				}

				$value = $value1;

				$value1 = $value * 100;

			}

			if (array_key_exists("$highno", $words)) {

				return $words["$highno"] . " " . $novalue . " " . $this->no_to_words($remainno);

			} else {

				$unit = $highno % 10;

				$ten = (int) ($highno / 10) * 10;

				return $words["$ten"] . " " . $words["$unit"] . " " . $novalue . " " . $this->no_to_words($remainno);
			}
		}
	}

	function addnew_dueamt($mode = NULL, $eid = NULL) {

		if ($mode == 'edit') {
			$data['form_set'] = array('mode' => 'edit', 'eid' => $eid);

			$data['result'] = $this->ObjM->get_record($eid);

		} else {
			$data['form_set'] = array('mode' => 'add');

		}

		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Due Amount';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);
		$this->load->view('admin/dueamt_add', $data);

		$this->load->view('comman/footer_admin');

	}

	function insert_amt() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');

			if ($this->form_validation->run() === FALSE) {

				$this->addnew($_POST['mode'], $_POST['eid']);
			} else {

				$this->_insertamt();

				echo '<script>window.location.href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view"</script>';

				header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view');

				exit;
			}

		}
	}

	protected function _insertamt() {

		$data = array();

		$data['amount'] = filter_data($_POST['amount']);

		if ($_POST['mode'] == 'edit') {

			$data['last_update'] = date('Y-m-d h:i:s');

			$this->comman_fun->update($data, 'membermaster', array('usercode' => $_POST['eid']));

			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}

	}

	function test() {

		$start_date = '2019-02-04';

		$end_date = '2019-02-28';

		$res = $this->ObjM->get_income_report_new($start_date, $end_date);

		echo $this->db->last_query();

	}

	function export_income_report_view() {

		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Client';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/client_income_report');

		$this->load->view('comman/footer_admin');

//		$start_date	= '2019-02-04';
		//
		//		$end_date	= '2019-02-28';
		//
		//		$res = $this->ObjM->get_income_report_new($start_date,$end_date);
		//
		//		echo $this->db->last_query();

	}

	function calculate_report_data() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('start_date', 'Start Date', 'required');

			$this->form_validation->set_rules('end_date', 'End Date', 'required');

			if ($this->form_validation->run() === FALSE) {

				$this->export_income_report_view();
			} else {

				$this->export_income_report();

				echo '<script>window.location.href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view"</script>';

				header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view');

				exit;
			}

		}
	}

	function export_income_report() {

		$start_date = filter_data(date('Y-m-d', strtotime($_POST['start_date'])));

		$end_date = filter_data(date('Y-m-d', strtotime($_POST['end_date'])));

		$result = $this->ObjM->get_income_report_new($start_date, $end_date);

		if (count($result) > 0) {

			$output = "";
			$output .= '"Client Name",';
			$output .= '"Sub Member Name",';
			$output .= '"Total Amount",';
			$output .= '"Total Recieved Amount",';
			$output .= '"Total Due Amount",';
			$output .= "\n";
			for ($i = 0; $i < count($result); $i++) {
				$tot_rec_amt = $result[$i]['tot_amt'] - $result[$i]['tot_due_amt'];
				$output .= '"' . $result[$i]['main_client'] . '",';
				$output .= '"' . $result[$i]['sub_client'] . '",';
				$output .= '"' . $result[$i]['tot_amt'] . '",';
				$output .= '"' . $tot_rec_amt . '",';
				$output .= '"' . $result[$i]['tot_due_amt'] . '",';
				$output .= "\n";
			}
			$dt = date("d-m-Y");
			$filename = "Income_Report" . $dt . ".csv";
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename=' . $filename);
			header('Cache-Control: max-age=0'); //no cache
			ob_get_contents();
			echo $output;

		} else {

			$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'No Data found.!'));

			header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view');
		}

	}

}
