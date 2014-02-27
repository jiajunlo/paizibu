<?php
class Login extends User_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		$this->load->helper('url');

		if($this->is_login()) {
			redirect('people');
		}

		$this->load->view('sign/login.php');
	}

	public function user_login() {
		$email = $this->input->post('email');
		$password = sha1($this->input->post('password'));
		//$remember = $this->input->post('remember');

		if($this->_isempty($email, $password)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$user_login = $this->user_model->user_login($email, $password);
		
		if(empty($user_login)) {
			return $this->_json_response(NULL, 2, 'Account and password do not match');
		}
		else {
			$user_session = array(
							'user_id' => $user_login->user_id,
							'user_name' => $user_login->user_name,
							'user_email' => $user_login->user_email,
							'user_avatar' => $user_login->user_avatar,
							'user_cover' => $user_login->user_cover,
							'user_auth' => 'USER_OK'
							);
			$this->session->set_userdata($user_session);
		}

		return $this->_json_response(NULL, 1, 'Login success');

	}

	public function logout() {
		$user_session = array(
							'user_id' => '',
							'user_name' => '',
							'user_email' => '',
							'user_avatar' => '',
							'user_cover' => '',
							'user_auth' => ''
							);
		$this->session->unset_userdata($user_session);

		return $this->_json_response(NULL, 1, 'Logout success');
	}
}