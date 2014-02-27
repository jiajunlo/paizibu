<?php
class About extends User_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		$this->load->view('about/about_header');
		$this->load->view('nav.php');
		$this->load->view('about/about.php');
		$this->load->view('footer');
	}
}