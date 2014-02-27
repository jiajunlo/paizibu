<?php
class Note_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_note($user_id, $note_title, $note_content, $note_weather, $note_place) {
		$sql = 'INSERT INTO `note`(
				`user_id`, 
				`note_title`, 
				`note_content`, 
				`note_weather`, 
				`note_place`
			)VALUES(?, ?, ?, ?, ?)';
		
		$param = array($user_id, $note_title, $note_content, $note_weather, $note_place);

		$query = $this->db->query($sql, $param);

		return $this->db->insert_id();
	}

	public function invalid_note($user_id, $note_id) {
		$sql = 'UPDATE `note` 
				SET `note_valid` = ?
				WHERE `user_id` = ? AND `note_id` = ?';

		$invalid_value = $this->config->item('invalid_value', 'pzb_const');
		$param = array($invalid_value, $user_id, $note_id);

		$query = $this->db->query($sql, $param);

		return $this->db->affected_rows() == 1;
	}

	public function note_list($user_id, $last_note_id) {
		$sql = 'SELECT 
					`note_id`,
					`note_title`,
					`note_time`,
					`note_content`
				FROM 
					`note`
				WHERE 
					`user_id` = ? AND `note_id` > ? AND `note_valid` = ?
				LIMIT 10';

		$valid_value = $this->config->item('valid_value', 'pzb_const');
		$param = array($user_id, $last_note_id, $valid_value);

		$query = $this->db->query($sql, $param);
		
		return $query->result();
	}

	public function single_note($user_id, $note_id) {
		$sql = 'SELECT 
					`note_id`,
					`note_title`,
					`note_content`,
					`note_time`,
					`note_weather`,
					`note_place`
				FROM 
					`note`
				WHERE 
					`user_id` = ? AND `note_id` = ? AND `note_valid` = ?';

		$valid_value = $this->config->item('valid_value', 'pzb_const');
		$param = array($user_id, $note_id, $valid_value);

		$query = $this->db->query($sql, $param);

		$row = $query->row();

		if($row == NULL) {
			return $row;
		}

		$last_sql = 'SELECT
						`note_id`
					FROM 
						`note`
					WHERE 
						`user_id` = ? AND `note_id` < ? AND `note_valid` = ?
					ORDER BY
						`note_id` DESC
					LIMIT 1';
		$last_param = array($user_id, $note_id, $valid_value);
		$last_query = $this->db->query($last_sql, $last_param);
		$last_row = $last_query->row();

		$next_sql = 'SELECT
						`note_id`
					FROM 
						`note`
					WHERE 
						`user_id` = ? AND `note_id` > ? AND `note_valid` = ?
					ORDER BY
						`note_id` ASC
					LIMIT 1';
		$next_param = array($user_id, $note_id, $valid_value);
		$next_query = $this->db->query($next_sql, $next_param);
		$next_row = $next_query->row();

		if($last_row == NULL) {
			$row->last_note_id = NULL;
		}
		else {
			$row->last_note_id = $last_row->note_id;
		}

		if($next_row == NULL) {
			$row->next_note_id = NULL;
		}
		else {
			$row->next_note_id = $next_row->note_id;
		}

		return $row;
	}
}