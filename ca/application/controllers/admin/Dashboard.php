<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (!is_logged_admin()) {

			header('Location: ' . file_path() . 'login');

			exit;

		}
//
		//		$this->load->model('admin/Admin_model');
		//
		$this->load->model('Member_module', 'ObjM', TRUE);
//
		//		$this->load->model('Destiny_module');
		//
		//		$this->load->model('Garden_module');
		//
		//

	}

	public function index() {

		$this->view();

	}

	public function view() {

		$page_info['menu_id'] = 'menu-dashboard';

		$page_info['page_title'] = 'Dashboard';

		//$data['result']				=  $this -> ObjM -> member_login_detail();

		$data['result'] = $this->ObjM->getNotificationList();

		//$data['tot_emp']	=	$this->ObjM->get_tot_emp();
		$data['tot_emp'] = $this->ObjM->get_tot_due();

		$data['tot_client'] = $this->ObjM->get_tot_client();

		$data['tot_task'] = $this->ObjM->get_tot_task();

		$data['tot_notification'] = $this->ObjM->get_tot_notification();

		$this->load->view('comman/topheader');

		$this->load->view('comman/header_admin', $page_info);

		$this->load->view('admin/dashboard_view', $data);

		$this->load->view('comman/footer_admin');

	}

	function ajaxGetAllSummery() {

		//$total_notifiction 				=   $this->Notification_module->getTotalNotification(user_session('usercode'));

//		if($total_notifiction > 0){
		//
		//
		//			$data['html_top_gen_notifiction'] =  '<div class="label-avatar bg-primary">'.$total_notifiction.'</div>';
		//
		//
		//		}else{
		//
		//
		//			$data['html_top_gen_notifiction'] =  '';
		//
		//
		//		}

		$data['quick'] = $this->getQuickNotificationList();

		echo json_encode($data);

		exit;

	}

	private function getQuickNotificationList() {

		$result = $this->ObjM->getQuickNotificationList();

		$this->ObjM->updateQuickNotificationStatus();

		$html = array();

		for ($i = 0; $i < count($result); $i++) {

			$html[] = $this->load->view('admin/notification_quick', array('result' => $result[$i]), true);

		}

		return $html;

	}

	function get_gen_notification() {

		//check_ajax_request();

		$result = $this->ObjM->getNotificationList();

		//echo $this->db->last_query();

		//$this->ObjM->updateNotificationStatus();

		if (count($result) == 0) {

			$output = "<p style='padding-left: 10px; padding-top: 20px; font-weight: 600;'>No Notification</p>";

		}
		for ($i = 0; $i < count($result); $i++) {

			$output .= $this->load->view('admin/notification_li', array('result' => $result[$i]), true);

		}

		echo $output;
	}

	function get_tot_unseen_noti() {

		$result = $this->ObjM->get_count_unseen_notification();

		$output = $result[0]['tot_notifi'];

		echo $output;

	}

	function update_seen_status($type, $id) {

		$this->ObjM->update_seen_status_count($id);

		if ($type == "support") {

			header('Location: ' . file_path('admin') . 'support/view');

			exit;

		} else if ($type == "document") {

			header('Location: ' . file_path('admin') . 'document_master/view');

			exit;

		} else if ($type == "service_request") {

			header('Location: ' . file_path('admin') . 'service_request/view');

			exit;

		} else if ($type == "task_complete") {

			header('Location: ' . file_path('admin') . 'task_mgmt/view');

			exit;

		}

	}

	public function change_password() {
		$this->form_validation->set_rules('uid', 'User Id First', 'required');
		if ($this->form_validation->run() == false) {
			// $page_info['menu_id'] = 'menu-employee';
			$page_info['page_title'] = 'Change Password';
			$this->load->view('comman/topheader');
			$this->load->view('comman/header_admin', $page_info);
			$this->load->view('admin/change_password');
			$this->load->view('comman/footer_admin');
		} else {
			$uid = $this->input->post('uid');
			$oldpass = $this->input->post('old_pass');
			$newpass = $this->input->post('new_pass');
			$cnewpass = $this->input->post('con_pass');
			$ky = '';
			$sel = $this->ObjM->select('membermaster', array('usercode' => $uid));
			foreach ($sel as $ky) {
				$oldpas = $ky->password;
			}
			if ($newpass == $cnewpass && $oldpass == $oldpas) {
				$this->db->set('password', $newpass);
				$this->db->where('usercode', $uid);
				$pass = $this->db->update('membermaster');
				if ($pass == '') {
					$message = "Invalid Password.";
					echo "<script type='text/javascript'>alert('$message');</script>";
					header('Location: ' . file_path('admin') . 'dashboard/change_password');
				} else {
					$this->session->set_flashdata('show_msg', array('class' => 'true', 'msg' => 'Password Change Successfully..'));
					header('Location: ' . file_path('admin') . 'dashboard/');
				}
			} else {
				$this->session->set_flashdata('show_msg', array('class' => 'false', 'msg' => 'Invalid Password.'));
				header('Location: ' . file_path('admin') . 'dashboard/change_password');
			}
		}
	}

}
