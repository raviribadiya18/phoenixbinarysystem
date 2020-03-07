<?php
Class SMS_module extends CI_Model {
	function getAll_noti() {

		$this->db->select('notification.*');

		$this->db->from('notification');

		$this->db->where('notification.status !=', 'Delete');

		$this->db->order_by('notification.noti_code', 'Desc');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_clients() {
		$this->db->select('membermaster.*');

		$this->db->from('membermaster');

		$this->db->where('membermaster.status', 'Active');

		$this->db->where('membermaster.role', 'client');

		$this->db->order_by('membermaster.usercode', 'Desc');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_record($eid) {

		$this->db->select('membermaster.*');

		$this->db->from('membermaster');

		$this->db->where('membermaster.status !=', 'Delete');

		$this->db->where('membermaster.role', 'client');

		$this->db->where('membermaster.usercode', '' . $eid . '');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

	function get_client_gcm_q($arr) {
		$this->db->select('api_gcm_regid.app_regid');

		$this->db->from('membermaster');

		$this->db->join('api_gcm_regid', 'api_gcm_regid.usercode = membermaster.usercode', 'left');

		if (isset($arr['list'])) {

			$names = implode(',', $arr['list']);

			$this->db->where_in('api_gcm_regid.usercode', $names);

		}

		$this->db->where('api_gcm_regid.app_regid !=', '');

		$this->db->where('membermaster.status', 'Active');

		$query = $this->db->get();

		$the_content = $query->result_array();

		return $the_content;

	}

}
?>
