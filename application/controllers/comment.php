<?php
class Comment extends User_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('comment_model');
	}

	public function add_comment($note_id, $comment_content, $comment_parent) {

		if(!$this->is_login()) {
			return $this->_json_response(NULL, -1, 'Permission denied');
		}

		$user_id = $this->session->userdata['user_id'];
		$note_id = $this->input->post('note_id');
		$comment_content = $this->input->post('comment_content');
		$comment_parent = $this->input->post('comment_parent');

		if($this->_isempty($user_id, $note_id, $comment_content, $comment_parent)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$add_comment = $this->comment_model->add_comment($user_id, $note_id, $comment_content, $comment_parent);

		if(!$add_comment) {
			return $this->_json_response(NULL, 2, 'Add comment fail');
		}

		return $this->_json_response(NULL, 1, 'Add comment success');
	}
}