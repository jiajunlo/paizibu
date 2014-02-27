<?php
class Reset extends User_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		$this->load->helper('url');
		$this->load->view('password/reset.php');
	}
	
	public function reset_password() {
		$id = $this->input->post('id');
		$mark = strtolower($this->input->post('mark'));
		$new_password = sha1($this->input->post('password'));

		if($this->_isempty($id, $mark, $new_password)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$check_user = $this->user_model->search_by_id($id);

		if(empty($check_user)) {
			return $this->_json_response(NULL, 3, 'Params are wrong');
		}
		else {
			$user_password = $check_user->user_password;
			$encrypt_data = strtolower(sha1(substr($user_password, 0, 10) + $id));
			
			if($mark == $encrypt_data) {
				$edit_password = $this->user_model->reset_password($id, $new_password);
		
				if(!$edit_password) {
					return $this->_json_response(NULL, 2, 'Edit fail');
				}
			}
			else {
				return $this->_json_response(NULL, 3, 'Params are wrong');
			}
		}

		return $this->_json_response(NULL, 1, 'Edit success');
	}
		
}