<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Sub_client extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {

			header('Location: ' . file_path() . 'login');

			exit;

		}

		$this->load->model('admin/Client_module', 'ObjM', TRUE);

		$this->load->library('form_validation');

		$this->load->library('upload');

		$this->load->library('image_lib');

	}

	public function view($usercode = NULL) {

		$data['html'] = $this->listing($usercode);

		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Client Member';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_view', $data);

		$this->load->view('comman/footer_admin');

	}

	function listing($usercode = NULL) {

		$result = $this->ObjM->get_sub_client($usercode);

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

			if ($result[$i]['self'] == 0) {

				$name = $result[$i]['fname'] . ' ' . $result[$i]['lname'] . ' <span style="color:green;">(Self)</span>';

			} else {

				$name = $result[$i]['fname'] . ' ' . $result[$i]['lname'];
			}

			$result_due_amt = $this->ObjM->get_due_amt_by_subuser($result[$i]['usercode'], $result[$i]['id']);

			if ($result_due_amt[0]['tot_due_amt'] != 0) {

				$amt = $result_due_amt[0]['tot_due_amt'];

			} else {

				$amt = "0.00";

			}

			$row = $i + 1;
			$html .= '<tr>
						<td>' . $row . '</td>
						<td>' . $name . '</td>
						<td>' . $result[$i]['company_name'] . '</td>
						<td>' . $result[$i]['mobileno'] . '</td>
						<td>' . $result[$i]['emailid'] . '</td>
						<td>' . $amt . ' /-</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle ' . $cls . ' btn_custom" data-toggle="dropdown">' . $current_status . ' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">
							<li><a href="' . file_path('admin') . 'fees_collection/view/' . $result[$i]['usercode'] . '/' . $result[$i]['id'] . '">Fee Collection</a></li>
							<li><a class="status_change" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/status_update/' . $update_status . '/' . $result[$i]['usercode'] . '/' . $result[$i]['id'] . '">' . $update_status . '</a></li>
							<li><a href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/addnew_member/edit/' . $result[$i]['usercode'] . '/' . $result[$i]['id'] . '">Edit</a></li>';
			if ($result[$i]['self'] != 0) {
				$html .= '<li><a class="delete_record" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/delete_record/' . $result[$i]['usercode'] . '/' . $result[$i]['id'] . '">Delete</a></li>';
			}

			$html .= '</ul>
						</div>

						</td>
					</tr>';
		}

		return $html;
	}

	function addnew_member($mode = NULL, $usercode = NULL, $eid = NULL) {

		if ($mode == 'edit') {
			$data['form_set'] = array('mode' => 'edit', 'eid' => $eid, 'usercode' => $usercode);

			$data['result'] = $this->ObjM->get_sub_record($eid);

		} else {

			$data['form_set'] = array('mode' => 'add', 'usercode' => $usercode);

		}

		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Client Member';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_add', $data);

		$this->load->view('comman/footer_admin');

	}

	function insert() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$this->form_validation->set_rules('fname', 'First Name', 'required|trim');

			$this->form_validation->set_rules('lname', 'Last Name', 'required|trim');

			// $this->form_validation->set_rules('company_name','Company Name', 'required|trim');

			$this->form_validation->set_rules('mobileno', 'mobileno', 'required|trim');

			$this->form_validation->set_rules('emailid', 'Email id', 'required|trim');

			if ($this->form_validation->run() === FALSE) {

				$this->addnew($_POST['mode'], $_POST['usercode'], $_POST['eid']);
			} else {

				$this->_insert();

				echo '<script>window.location.href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view"</script>';

				header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view/' . $_POST['usercode']);

				exit;

			}

		}
	}

	protected function _insert() {

		$data = array();

		$data['fname'] = filter_data($_POST['fname']);

		$data['lname'] = filter_data($_POST['lname']);

		$data['company_name'] = filter_data($_POST['company_name']);

		$data['mobileno'] = filter_data($_POST['mobileno']);

		$data['emailid'] = filter_data($_POST['emailid']);

		$data['usercode'] = filter_data($_POST['usercode']);

		if ($_POST['mode'] == 'add') {
			$data['status'] = 'Active';

			$data['create_by'] = '1';

			$data['create_date'] = date('Y-m-d h:i:s');

			$this->comman_fun->additem($data, 'sub_membermaster');

			$this->session->set_flashdata("success", "Record Insert Successfully.....");

		}
		if ($_POST['mode'] == 'edit') {

			$data['last_update'] = date('Y-m-d h:i:s');

			$this->comman_fun->update($data, 'sub_membermaster', array('id' => $_POST['eid']));

			$this->session->set_flashdata("success", "Record Update Successfully.....");

			$data1['fname'] = filter_data($_POST['fname']);

			$data1['lname'] = filter_data($_POST['lname']);

			$data1['company_name'] = filter_data($_POST['company_name']);

			$data1['mobileno'] = filter_data($_POST['mobileno']);

			$data1['emailid'] = filter_data($_POST['emailid']);

			$this->comman_fun->update($data1, 'membermaster', array('usercode' => $_POST['usercode']));

		}

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

	function status_update($st, $usercode, $eid) {

		$record = $this->comman_fun->get_table_data('sub_membermaster', array('id' => $eid));

		$data['status'] = $st;

		$this->comman_fun->update($data, 'sub_membermaster', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Status ' . $st . ' Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view/" . $usercode);

	}

	function delete_record($usercode, $eid) {

		$record = $this->comman_fun->get_table_data('sub_membermaster', array('id' => $eid));

		$data['status'] = 'Delete';

		$this->comman_fun->update($data, 'sub_membermaster', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view/" . $usercode);

	}

}
