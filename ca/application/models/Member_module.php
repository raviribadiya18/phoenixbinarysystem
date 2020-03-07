<?php
Class Member_module extends CI_Model {
	function check_login() {

		$this->db->select('*');

		$this->db->from('membermaster');

		$this->db->where('username', '' . $_POST['username'] . '');

		$this->db->where('password', '' . $_POST['password'] . '');

		$this->db->where('status', 'Active');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function member_login_detail() {

		$this->db->select('web_login_info.*');

		$this->db->select('membermaster.*');

		$this->db->from('web_login_info');

		$this->db->join('membermaster', 'membermaster.usercode=web_login_info.usercode', 'left');

		$this->db->where('web_login_info.status', 'Sucess');

		$this->db->order_by('web_login_info.login_code', 'DESC');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_tot_emp() {
		$this->db->select('count(*) as tot_user');

		$this->db->from('membermaster');

		$this->db->where('membermaster.status', 'Active');

		$this->db->where('membermaster.role', 'emp');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_tot_client() {
		$this->db->select('count(*) as tot_user');

		$this->db->from('membermaster');

		$this->db->where('membermaster.status', 'Active');

		$this->db->where('membermaster.role', 'client');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_tot_due() {
		$this->db->select('sum(due_amount) as tot_user');

		$this->db->from('invoice_master');

		$this->db->where('invoice_master.status', 'Active');

		//$this -> db -> where('invoice_master.usercode', ''.$usercode.'');

		$this->db->where('invoice_master.bill_paid', 'No');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_tot_task() {
		$this->db->select('count(*) as tot_user');

		$this->db->from('task_master');

		$this->db->where('task_master.status', 'Active');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_tot_notification() {
		$this->db->select('count(*) as tot_noti');

		$this->db->from('notification');

		$this->db->where('notification.status', 'Active');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function add_notification($arr = array()) {

		if (!empty($arr)) {

			$data = array(

				'type' => (isset($arr['type'])) ? $arr['type'] : '',

				'class_type' => (isset($arr['class_type'])) ? $arr['class_type'] : '',

				'usercode_sender' => (isset($arr['usercode_sender'])) ? $arr['usercode_sender'] : '0',

				'usercode_reciever' => (isset($arr['usercode_reciever'])) ? $arr['usercode_reciever'] : '0',

				'message' => (isset($arr['message'])) ? $arr['message'] : '0',

				'rec_id' => (isset($arr['rec_id'])) ? $arr['rec_id'] : '0',

				'status' => 0,

				'timedt' => time(),

			);

			$id = $this->comman_fun->addItem($data, 'notification_master');

		}

	}

	function updateNotificationStatus() {

		$data = array(

			'quick_view' => 1,

		);

		$this->comman_fun->update($data, 'notification_master', array('usercode' => user_session('usercode'), 'status' => 0));

	}

	function updateQuickNotificationStatus() {

		$data = array(

			'quick_view' => 1,

		);

		$this->comman_fun->update($data, 'notification_master', array('usercode_reciever' => '1', 'quick_view' => 0));

	}

	function getQuickNotificationList() {

		$sQuery = '

		SELECT notification_master.*,

		CONCAT(m.fname," ",m.lname) as member_name,m.username

		FROM notification_master

		LEFT JOIN membermaster as m   ON  m.usercode = notification_master.usercode_sender

		WHERE notification_master.usercode_reciever = "1"  AND notification_master.status = "0" AND notification_master.quick_view = "0"

		ORDER BY notification_master.timedt DESC';

		$query = $this->db->query($sQuery);

		$the_content = $query->result_array();

		return $the_content;

	}

	function getNotificationList() {

		$sQuery = '

		SELECT notification_master.*,

		CONCAT(m.fname," ",m.lname) as member_name,m.username

		FROM notification_master

		LEFT JOIN membermaster as m   ON  m.usercode = notification_master.usercode_sender

		WHERE notification_master.usercode_reciever = "1"

		ORDER BY notification_master.timedt DESC';

		$query = $this->db->query($sQuery);

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_count_unseen_notification() {

		$sQuery = '

		SELECT count(*) as tot_notifi

		FROM notification_master

		WHERE notification_master.usercode_reciever = "1"

		AND notification_master.seen_status = "No"';

		$query = $this->db->query($sQuery);

		$the_content = $query->result_array();

		return $the_content;

	}

	function updateNotificationStatus1() {

		$data = array(

			'status' => 1,

		);

		$this->comman_fun->update($data, 'notification_master', array('usercode' => '1', 'status' => 0));

	}

	function update_seen_status_count($id) {

		$data = array(

			'seen_status' => 'Yes',

		);

		$this->comman_fun->update($data, 'notification_master', array('id' => $id));

	}

	function select($table, $where = '') {
		$this->db->select('*');
		$this->db->from($table);
		if ($where != '') {
			$this->db->where($where);
		}
		return $this->db->get()->result();
	}

}
?>
