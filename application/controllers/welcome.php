<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends User_Controller {

	public function index() {
		$this->load->helper('url');

		if($this->is_login()) {
			redirect('people');
		}

		$this->load->view('sign/login.php');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */