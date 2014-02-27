<?php
class Register extends User_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		$this->load->helper('url');
		$this->load->view('sign/register.php');
	}

	public function check_email() {
		$email = $this->input->post('email');
		if($this->_isempty($email)) {
			return $this->_json_response(NULL, 0, "Params cannot be empty");
		}

		$check_email = $this->user_model->check_email($email);

		if($check_email > 0) {
			return $this->_json_response(NULL, 2, "Already be registered");
		}
		
		return $this->_json_response("hello", 1, "Can be registered");
	}

	public function user_register() {
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$password = sha1($this->input->post('password'));
		$avatar = "avatar-default.jpg";
		$cover = "cover-default.jpg";

		if($this->_isempty($email, $name, $password)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$check_email = $this->user_model->check_email($email);
		
		if($check_email > 0) {
			return $this->_json_response(NULL, 2, 'Already be registered');
		}

		$add_user_id = $this->user_model->add_user($email, $name, $password, $avatar, $cover);

		if(empty($add_user_id)) {
			return $this->_json_response(NULL, 3, 'Insert error');
		}

		$user_session = array(
						'user_id' => $add_user_id,
						'user_name' => $name,
						'user_email' => $email,
						'user_avatar' => $avatar,
						'user_cover' => 'cover-default.jpg',
						'user_auth' => 'USER_OK'
						);
		$this->session->set_userdata($user_session);

		return $this->_json_response(NULL, 1, 'Register success');
	}

}