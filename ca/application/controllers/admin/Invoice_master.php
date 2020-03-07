<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Invoice_master extends CI_Controller {
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

		$data['html'] = $this->invoice_listing($usercode);
		$page_info['menu_id'] = 'menu-client';

		$page_info['page_title'] = 'Invoice';

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/invoice_view', $data);

		$this->load->view('comman/footer_admin');

	}

	function invoice_listing($usercode = NULL) {

		$result = $this->ObjM->getadd_invoice($usercode);

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

			$row = $i + 1;
			$html .= '<tr>
						<td>' . $row . '</td>
						<td>' . $record[0]['fname'] . ' ' . $record[0]['lname'] . '</td>
						<td><a target="_blank" href="' . file_path('admin') . '' . $this->uri->rsegment(1) . '/print_order/' . $result[$i]['invoice_id'] . '/' . $result[$i]['usercode'] . '">Print Invoice</a></td>
						<td>' . date('d-M-Y', strtotime($result[$i]['invoice_date'])) . '</td>
						<td><div class="btn-group">
						<button class="btn dropdown-toggle ' . $cls . ' btn_custom" data-toggle="dropdown">' . $current_status . ' <i class="fa fa-angle-down"></i> </button>
						<ul class="dropdown-menu pull-right">

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

	function addnew($mode = NULL, $eid = NULL) {

		if ($mode == 'edit') {
			$data['form_set'] = array('mode' => 'edit', 'eid' => $eid);

			$data['result'] = $this->ObjM->get_record($eid);

		} else {
			$data['form_set'] = array('mode' => 'add');

		}

		$data['cname'] = $this->ObjM->get_all_client_list();

		$data['services'] = $this->ObjM->get_services();

		$data['result'] = $this->ObjM->get_record($usercode);

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

		$data['invoice_date'] = date('Y-m-d', strtotime($_POST['invoice_date']));
		$data['usercode'] = filter_data($_POST['usercode']);
		$data['status'] = 'Active';
		$data['create_date'] = date('Y-m-d h:i:s');

		$inovice_id = $this->comman_fun->additem($data, 'invoice_master');

		$_POST['hidden_service_name'];

		for ($i = 0; $i < count($_POST['hidden_service_name']); $i++) {

			$data_dt = array();

			$data_dt['invoice_id'] = $inovice_id;

			$record = $this->comman_fun->get_table_data('service_master', array('id' => $_POST['hidden_service_name'][$i]));

			$data_dt['service_name'] = $record[0]['name'];

			$data_dt['price'] = $_POST['hidden_price'][$i];

			$data_dt['decription'] = $_POST['hidden_decription'][$i];

			$data_dt['create_date'] = date('Y-m-d h:i:s');

			$this->comman_fun->additem($data_dt, 'invoice_details');

		}
		echo $_POST['usercode'];exit;

	}

	function print_order($eid, $usercode) {

		$data['invoice_master'] = $this->comman_fun->get_table_data('invoice_master', array('invoice_id' => $eid));

		$data['user_details'] = $this->comman_fun->get_table_data('membermaster', array('usercode' => $usercode));

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

	function sub_user_client($eid) {

		$result = $this->comman_fun->client_sub_users(array('usercode' => $eid));

		//var_dump($result);

		echo $result;
	}

}
