<?php
class Note extends User_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('note_model');
	}

	public function index() {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		$data['title'] = "写日记";
		$this->load->view('note/note_header.php', $data);
		$this->load->view('nav.php');
		$this->load->view('note/add_note.php');
		$this->load->view('footer');
	}

	public function add() {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		$data['title'] = "写日记";
		$this->load->view('note/note_header.php', $data);
		$this->load->view('nav.php');
		$this->load->view('note/add_note.php');
		$this->load->view('footer');
	}

	public function p($note_id = 0) {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		if($note_id == 0) {
			$data['title'] = "日志不存在";
			$this->load->view('note/note_header.php', $data);
			$this->load->view('nav.php');
			$this->load->view('note/note_404.php');
			$this->load->view('footer');
		}
		else {
			$user_id = $this->session->userdata['user_id'];

			$note_data = $this->note_model->single_note($user_id, $note_id);

			if($note_data != NULL) {
				$data['title'] = $note_data->note_title;
				$data['note_id'] = $note_data->note_id;
				$data['note_title'] = $note_data->note_title;
				$data['note_content'] = $note_data->note_content;
				$data['note_place'] = $note_data->note_place;
				$data['note_time'] = $note_data->note_time;

				$data['last_note_id'] = $note_data->last_note_id;
				$data['next_note_id'] = $note_data->next_note_id;

				switch($note_data->note_weather) {
					case 2: $data['note_weather'] = "晴"; break;
					case 3: $data['note_weather'] = "阴"; break;
					case 4: $data['note_weather'] = "雨"; break;
					case 5: $data['note_weather'] = "雪"; break;
					default: $data['note_weather'] = "无";
				}

				$this->load->view('note/note_header.php', $data);
				$this->load->view('nav.php');
				$this->load->view('note/post_note.php');
				$this->load->view('footer');
			}
			else {
				$data['title'] = "日志不存在";
				$this->load->view('note/note_header.php', $data);
				$this->load->view('nav.php');
				$this->load->view('note/note_404.php');
				$this->load->view('footer');
			}
		}
	}

	public function add_note() {

		if(!$this->is_login()) {
			return $this->_json_response(NULL, -1, 'Permission denied');
		}

		$user_id = $this->session->userdata['user_id'];
		$note_title = $this->input->post('title');
		$note_content = $this->input->post('content');
		$note_weather = $this->input->post('weather');
		$note_place = $this->input->post('place');

		if($this->_isempty($user_id, $note_title, $note_content, $note_weather, $note_place)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$add_note = $this->note_model->add_note($user_id, $note_title, $note_content, $note_weather, $note_place);

		if(!$add_note) {
			return $this->_json_response(NULL, 2, 'Add note fail');
		}

		return $this->_json_response($add_note, 1, 'Add note success');
	}

	public function delete_note() {

		if(!$this->is_login()) {
			return $this->_json_response(NULL, -1, 'Permission denied');
		}

		$user_id = $this->session->userdata['user_id'];
		$note_id = $this->input->post('note_id');

		if($this->_isempty($note_id)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$delete_note = $this->note_model->invalid_note($user_id, $note_id);

		if(!$delete_note) {
			return $this->_json_response(NULL, 2, 'Delete note fail');
		}

		return $this->_json_response(NULL , 1, 'Delete note success');
	}
}