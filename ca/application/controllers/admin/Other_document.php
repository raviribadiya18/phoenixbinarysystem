<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Other_document extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {

			header('Location: ' . file_path() . 'login');

			exit;

		}

		$this->load->model('admin/Other_document_module', 'ObjM', TRUE);

		$this->load->library('form_validation');

		$this->load->library('upload');

		$this->load->library('image_lib');

	}

	public function view() {

		$data['html'] = $this->listing();

		$page_info['menu_id'] = 'menu-od';

		$page_info['page_title'] = 'Other Document List';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_view', $data);

		$this->load->view('comman/footer_admin');

	}

	function listing() {

		$result = $this->ObjM->get_document();

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

			if ($result[$i]['upload_file'] != "") {

				$file = "<a href='" . base_url() . "upload/web/doc/" . $result[$i]['upload_file'] . "' download>Download File Here</a>";

			} else {

				$file = "-";
			}

			$row = $i + 1;
			$html .= '<tr>
						<td>' . $row . '</td>
						<td>' . $result[$i]['fname'] . ' ' . $result[$i]['lname'] . '</td>
						<td>' . $result[$i]['sub_fname'] . ' ' . $result[$i]['sub_lname'] . '</td>
						<td>' . $result[$i]['title'] . '</td>
						<td>' . $file . '</td>

						<td><div class="btn-group">
						<button class="btn dropdown-toggle ' . $cls . ' btn_custom" data-toggle="dropdown">' . $current_status . '  </button>
						<ul class="dropdown-menu pull-right"><li><a class="status_change" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/status_update/' . $update_status . '/' . $result[$i]['id'] . '">' . $update_status . '</a></li>
						<li><a href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/addnew/edit/' . $result[$i]['id'] . '">Edit</a></li>';

			$html .= '<li><a class="delete_record" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/delete_record/' . $result[$i]['id'] . '">Delete</a></li>';

			$html .= '</ul>
						</div>

						</td>
					</tr>';
		}

		return $html;
	}

	function delete_record123($eid) {

		$record = $this->comman_fun->get_table_data('other_document_master', array('id' => $eid));

		$data['status'] = 'Delete';

		$url = './upload/web/doc/' . $record[0]['upload_file'];

		unlink($url);

		$this->comman_fun->update($data, 'other_document_master', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");

	}

	function addnew($mode = NULL, $eid = NULL) {

		if ($mode == 'edit') {
			$data['form_set'] = array('mode' => 'edit', 'eid' => $eid);

			$data['result'] = $this->ObjM->get_record($eid);

		} else {
			$data['form_set'] = array('mode' => 'add');

		}

		$data['cname'] = $this->ObjM->get_all_client_list();

		$page_info['menu_id'] = 'menu-od';

		$page_info['page_title'] = 'Other Document';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/' . $this->uri->rsegment(1) . '_add', $data);

		$this->load->view('comman/footer_admin');

	}

	function insert() {
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			//$this->form_validation->set_rules('upload_file', 'Upload file', 'callback_check_file_require');

			if ($_POST['mode'] != 'edit') {

				$this->form_validation->set_rules('upload_file', 'Upload file', 'callback_check_file_require');
			}

			$this->form_validation->set_rules('cname', 'Client Name', 'required');

			$this->form_validation->set_rules('title', 'Title', 'required');

			if ($this->form_validation->run() === FALSE) {

				$this->addnew($_POST['mode'], $_POST['eid']);
			} else {

				$this->_insert();

				echo '<script>window.location.href="' . file_path('client') . '' . $this->uri->rsegment(1) . '/view"</script>';

				header('Location: ' . file_path('admin') . '' . $this->uri->rsegment(1) . '/view');

				exit;

			}

		}
	}

	protected function _insert() {

		if ($_POST['mode'] == 'add') {

			$cpt = count($_FILES['upload_file']['name']);

			$files = $_FILES;

			$config = array();

			$config['upload_path'] = './upload/web/doc/';

			$config['allowed_types'] = 'pdf'; //|jpeg|jpg|png|docx|csv|xlsx|xls

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

					$fileName = 'od_' . $rand . '' . $_FILES['upload_file']['name'];

					$fileName = str_replace(" ", "", $fileName);

					$config['file_name'] = $fileName;

					$this->upload->initialize($config);

					$image_info = getimagesize($_FILES["upload_file"]["tmp_name"]);

					if ($this->upload->do_upload()) {

						$upload_count++;

						$upload_data = $this->upload->data();

						$_POST['file_name'] = $upload_data['file_name'];

						$data = array();

						$data['title'] = filter_data($_POST['title']);

						$data['usercode'] = filter_data($_POST['cname']);

						$data['sub_id'] = filter_data($_POST['sub_id']);

						$data['upload_file'] = $upload_data['file_name'];

						$data['status'] = 'Active';

						$data['add_from'] = 'panel';

						$data['create_date'] = date('Y-m-d h:i:s');

						$this->comman_fun->additem($data, 'other_document_master');

						$data = false;

					}
				}

			}

			$this->session->set_flashdata("success", "Record Insert Successfully.....");

		}
		if ($_POST['mode'] == 'edit') {
			$data = array();

			if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name'])) {
				$this->handle_upload();

				$data['upload_file'] = $_POST['file_name'];

			}

			$data['title'] = filter_data($_POST['title']);

			$data['usercode'] = filter_data($_POST['cname']);

			$data['sub_id'] = filter_data($_POST['sub_id']);

			$data['update_date'] = date('Y-m-d h:i:s');

			$this->comman_fun->update($data, 'other_document_master', array('id' => $_POST['eid']));

			$this->session->set_flashdata("success", "Record Update Successfully.....");
		}

	}

	function status_update($st, $eid) {

		$record = $this->comman_fun->get_table_data('other_document_master', array('id' => $eid));

		$data['status'] = $st;

		$this->comman_fun->update($data, 'other_document_master', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Status ' . $st . ' Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");

	}

	function sub_user_client($eid) {

		$result = $this->comman_fun->client_sub_users(array('usercode' => $eid));

		//var_dump($result);

		echo $result;
	}

	function delete_record($eid) {

		$record = $this->comman_fun->get_table_data('other_document_master', array('id' => $eid));

		$data['status'] = 'Delete';

		$url = './upload/web/doc/' . $record[0]['upload_file'];

		unlink($url);

		$this->comman_fun->update($data, 'other_document_master', array('id' => $eid));

		$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Record Delete Successfully.....'));

		redirect(file_path('admin') . "" . $this->uri->rsegment(1) . "/view");

	}

	function check_file_require() {

		if (!empty($_FILES['upload_file']['name'])) {

			return TRUE;

		} else {

			$this->form_validation->set_message('check_file_require', 'This Field is Require.');

			return FALSE;
		}

	}

	function handle_upload() {
		if (isset($_FILES['upload_file']) && !empty($_FILES['upload_file']['name'])) {
			$config = array();
			$config['upload_path'] = './upload/web/doc/';
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '0';
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$_FILES['userfile']['name'] = $_FILES['upload_file']['name'];
			$_FILES['userfile']['type'] = $_FILES['upload_file']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['upload_file']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['upload_file']['error'];
			$_FILES['userfile']['size'] = $_FILES['upload_file']['size'];

			$rand = md5(uniqid(rand(), true));

			$fileName = 'od_' . $rand . '' . $_FILES['upload_file']['name'];

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

}
