<?php
class Forget extends User_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		$this->load->helper('url');
		$this->load->view('password/forget.php');
	}
	
	public function forget_password() {
		$email = $this->input->post('email');
		
		if($this->_isempty($email)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}
		
		$user_data = $this->user_model->search_by_email($email);
		
		if(empty($user_data)) {
			return $this->_json_response(NULL, 2, 'Not registered');
		}
		else {
			$user_id = $user_data->user_id;
			$user_name = $user_data->user_name;
			$user_password = $user_data->user_password;
			
			$encrypt_data = strtolower(sha1(substr($user_password, 0, 10) + $user_id));
			$reset_link = 'http://www.jiajunlo.com/paizibu/password/reset?id='.$user_id.'&mark='. $encrypt_data;
			$message = "亲爱的".$user_name.":<br />您好！请点击以下链接重置您当前密码：<br /><a href='".$reset_link."'>点击重置密码</a><br /><br />如果上述链接失败，请复制以下地址：".$reset_link;
			
			$this->load->library('email');
			
			$this->email->from("paizibu_admin@163.com", "Paizibu");
			$this->email->to($email);
			$this->email->subject("重置密码 - 拍子簿");
			$this->email->message($message);
			$this->email->send();
		}

		return $this->_json_response(NULL, 1, 'Send email success');
	}
}