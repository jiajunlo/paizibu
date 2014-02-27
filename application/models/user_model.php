<?php
class User_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_user($user_email, $user_name, $user_password, $user_avatar, $user_cover) {
		$sql = 'INSERT INTO `user`(
					`user_email`, 
					`user_name`, 
					`user_password`, 
					`user_avatar`,
					`user_cover`
				)VALUES(?, ?, ?, ?, ?)';

		$param = array($user_email, $user_name, $user_password, $user_avatar, $user_cover);

		$query = $this->db->query($sql, $param);

		return $this->db->insert_id();
	}

	public function check_email($user_email) {
		$sql = 'SELECT * FROM `user`
				WHERE `user_email` = ?';

		$param = array($user_email);

		$query = $this->db->query($sql, $param);

		return $query->num_rows();
	}

	public function user_login($user_email, $user_password) {
		$sql = 'SELECT * FROM `user`
				WHERE `user_email` = ? AND `user_password` = ? AND `user_valid` = ?';

		$valid_value = $this->config->item('valid_value', 'pzb_const');
		$param = array($user_email, $user_password, $valid_value);

		$query = $this->db->query($sql, $param);

		return $query->row();
	}

	public function edit_profile($user_id, $user_name) {
		$sql = 'UPDATE `user` 
				SET `user_name` = ?
				WHERE `user_id` = ?';

		$param = array($user_name, $user_id);

		$query = $this->db->query($sql, $param);

		return $this->db->affected_rows() == 1;
	}

	public function edit_avatar($user_id, $user_avatar) {
		$sql = 'UPDATE `user` 
				SET `user_avatar` = ?
				WHERE `user_id` = ?';

		$param = array($user_avatar, $user_id);

		$query = $this->db->query($sql, $param);

		return $this->db->affected_rows() == 1;
	}

	public function edit_cover($user_id, $user_cover) {
		$sql = 'UPDATE `user` 
				SET `user_cover` = ?
				WHERE `user_id` = ?';

		$param = array($user_cover, $user_id);

		$query = $this->db->query($sql, $param);

		return $this->db->affected_rows() == 1;
	}

	public function edit_password($user_id, $user_password) {
		$sql = 'UPDATE `user` 
				SET `user_password` = ?
				WHERE `user_id` = ?';

		$param = array($user_password, $user_id);

		$query = $this->db->query($sql, $param);

		return $this->db->affected_rows() == 1;
	}

	public function check_password($user_id, $user_password) {
		$sql = 'SELECT * 
				FROM `user`
				WHERE `user_id` = ? AND `user_password` = ?';

		$param = array($user_id, $user_password);

		$query = $this->db->query($sql, $param);

		return $query->result();
	}
	
	public function search_by_email($user_email) {
		$sql = 'SELECT * FROM `user`
				WHERE `user_email` = ?';

		$valid_value = $this->config->item('valid_value', 'pzb_const');
		$param = array($user_email);

		$query = $this->db->query($sql, $param);

		return $query->row();
	}
	
	public function search_by_id($user_id) {
		$sql = 'SELECT * FROM `user`
				WHERE `user_id` = ?';

		$valid_value = $this->config->item('valid_value', 'pzb_const');
		$param = array($user_id);

		$query = $this->db->query($sql, $param);

		return $query->row();
	}
	
	public function reset_password($user_id, $user_password) {
		$sql = 'UPDATE `user` 
				SET `user_password` = ?
				WHERE `user_id` = ?';

		$param = array($user_password, $user_id);

		$query = $this->db->query($sql, $param);

		return true;
	}
}