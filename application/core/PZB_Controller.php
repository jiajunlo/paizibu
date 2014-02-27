<?php
abstract class PZB_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	public function __destruct() {
		$this->db->close();
	}

	/**
	* 对参数数组进行isset判断
	* @return boolean
	*/
	public function _isempty() {
		$args = func_num_args();
		$argv = func_get_args();

		for($i = 0; $i < $args; ++$i) {
			if($argv[$i] == FALSE) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	* 生成json串返回
	* @param array 	$data 		返回数据
	* @param int 	$code 		状态码
	*/
	protected function _json_response($data = NULL, $code = 0, $message = NULL) {
		$response = array("data" => $data, "code" => $code, "message" => $message);
		echo json_encode($response);
		//$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}

/**
* 用户控制器父类
*/
abstract class User_Controller extends PZB_Controller {

	public function __construct() {
		parent::__construct();
	}

	protected function is_login() {
		return $this->session->userdata('user_auth') == 'USER_OK';
	}
}