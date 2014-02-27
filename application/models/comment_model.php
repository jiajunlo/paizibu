<?php
class User_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_comment($user_id, $article_id, $comment_content, $comment_parent) {
		$sql = 'INSERT INTO `comment`(
					`user_id`, 
					`article_id`, 
					`comment_content`, 
					`comment_parent`
				)VALUES(?, ?, ?, ?)';
		
		$param = array($user_id, $article_id, $comment_content, $comment_parent);

		$query = $this->db->query($sql, $param);

		return $this->db->affected_rows() == 1;
	}
}