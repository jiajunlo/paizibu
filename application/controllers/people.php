<?php
class People extends User_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('note_model');
	}

	public function index() {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		$data['user_name'] = $this->session->userdata['user_name'];
		$data['user_avatar'] = $this->session->userdata['user_avatar'];
		$data['user_cover'] = $this->session->userdata['user_cover'];
		$this->load->view('people/people_header.php', $data);
		$this->load->view('nav.php');
		$this->load->view('people/people.php');
		$this->load->view('footer.php');
	}

	public function note_list() {
		if(!$this->is_login()) {
			return $this->_json_response(NULL, -1, 'Permission denied');
		}

		$user_id = $this->session->userdata['user_id'];
		$last_note_id = $this->input->post('last_note_id');

		if($last_note_id == -1) {
			$last_note_id == 0;
		}

		if($this->_isempty($user_id, $last_note_id)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$note_list = $this->note_model->note_list($user_id, $last_note_id);

		if(!$note_list) {
			return $this->_json_response(NULL, 2, 'Do not have note');
		}

		return $this->_json_response($note_list, 1, 'Load note list success');
	}
}