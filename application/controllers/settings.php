<?php
class Settings extends User_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		$data['user_email'] = $this->session->userdata['user_email'];
		$data['user_name'] = $this->session->userdata['user_name'];
		$this->load->view('settings/settings_header.php', $data);
		$this->load->view('nav.php');
		$this->load->view('settings/edit_profile.php');
		$this->load->view('footer');
	}

	public function password() {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		$data['user_name'] = $this->session->userdata['user_name'];
		$this->load->view('settings/settings_header.php', $data);
		$this->load->view('nav.php');
		$this->load->view('settings/edit_password.php');
		$this->load->view('footer');
	}

	public function avatar() {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		$data['user_name'] = $this->session->userdata['user_name'];
		$data['user_avatar'] = $this->session->userdata['user_avatar'];
		$this->load->view('settings/settings_header.php', $data);
		$this->load->view('nav.php');
		$this->load->view('settings/edit_avatar.php');
		$this->load->view('footer');
	}

	public function cover() {
		$this->load->helper('url');

		if(!$this->is_login()) {
			redirect('login');
		}

		$data['user_name'] = $this->session->userdata['user_name'];
		$data['user_cover'] = $this->session->userdata['user_cover'];
		$this->load->view('settings/settings_header.php', $data);
		$this->load->view('nav.php');
		$this->load->view('settings/edit_cover.php');
		$this->load->view('footer');
	}

	public function edit_profile() {
		if(!$this->is_login()) {
			return $this->_json_response(NULL, -1, 'Permission denied');
		}

		$id = $this->session->userdata['user_id'];
		$name = $this->input->post('name');

		if($this->_isempty($id, $name)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$edit_profile = $this->user_model->edit_profile($id, $name);

		if(!$edit_profile) {
			return $this->_json_response(NULL, 2, 'Edit fail');
		}

		$user_new_session = array(
							'user_id' => $this->session->userdata['user_id'],
							'user_name' => $name,
							'user_email' => $this->session->userdata['user_email'],
							'user_avatar' => $this->session->userdata['user_avatar'],
							'user_cover' => $this->session->userdata['user_cover'],
							'user_auth' => $this->session->userdata['user_auth']
							);

		$this->session->set_userdata($user_new_session);

		return $this->_json_response(NULL, 1, 'Edit success');
	}

	public function edit_password() {
		if(!$this->is_login()) {
			return $this->_json_response(NULL, -1, 'Permission denied');
		}

		$id = $this->session->userdata['user_id'];
		$old_password = sha1($this->input->post('old_password'));
		$new_password = sha1($this->input->post('new_password'));

		if($this->_isempty($id, $old_password, $new_password)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$check_password = $this->user_model->check_password($id, $old_password);

		if(empty($check_password)) {
			return $this->_json_response(NULL, 3, 'Old password wrong');
		}

		$edit_password = $this->user_model->edit_password($id, $new_password);

		if(!$edit_password) {
			return $this->_json_response(NULL, 2, 'Edit fail');
		}

		return $this->_json_response(NULL, 1, 'Edit success');
	}

	public function set_default_avatar() {
		if(!$this->is_login()) {
			return $this->_json_response(NULL, -1, 'Permission denied');
		}

		$id = $this->session->userdata['user_id'];
		$avatar = "avatar-default.jpg";

		if($this->_isempty($id, $avatar)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$edit_avatar = $this->user_model->edit_avatar($id, $avatar);

		if(!$edit_avatar) {
			return $this->_json_response(NULL, 2, 'Edit fail');
		}

		$user_new_session = array(
			'user_id' => $this->session->userdata['user_id'],
			'user_name' => $this->session->userdata['user_name'],
			'user_email' => $this->session->userdata['user_email'],
			'user_avatar' => $avatar,
			'user_cover' => $this->session->userdata['user_cover'],
			'user_auth' => $this->session->userdata['user_auth']
		);

		$this->session->set_userdata($user_new_session);

		return $this->_json_response($avatar, 1, 'Edit success');
	}

	public function upload_avatar() {
		$id = $this->session->userdata['user_id'];
		$avatar_name = 'u'.time();
		$file_path = './images/avatar/';
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $avatar_name;

		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload('avatar')) {
			return $this->_json_response($this->upload->display_errors(), 3, 'Upload fail');
		}
		else {
			$data['upload_data'] = $this->upload->data();
			$avatar_name = $data['upload_data']['file_name'];

			//crop
			$this->load->library('image_lib'); 
			list($width, $height) = getimagesize($file_path.$avatar_name);
			$config['image_library'] = 'gd2';
			$config['source_image'] = $file_path.$avatar_name;
			$config['maintain_ratio'] = TRUE;
			if($width >= $height)
			{
				$config['master_dim'] = 'height';
			}else{
				$config['master_dim'] = 'width';
			}
			
			$config['width'] = "300";
			$config['height'] = "300";
			
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
			$config['maintain_ratio'] = FALSE;

			if($width >= $height) {
				$config['x_axis'] = floor((1.0 * ($width - $height)) / (2 * ($height / 300)));
			}
			else{
				$config['y_axis'] = floor((1.0 * ($height - $width)) / (2 * ($width / 300))) ;
			}

			$this->image_lib->initialize($config);
			$this->image_lib->crop();

			//Create thumb
			$configThumb['image_library'] = 'gd2';
			$configThumb['create_thumb'] = TRUE;		
			$configThumb['maintain_ratio'] = TRUE;
			$configThumb['new_image'] = $file_path.'/thumb';
			$configThumb['width'] = 50;
			$configThumb['height'] = 50;
			$configThumb['source_image'] = $file_path.$avatar_name;
			
			$this->image_lib->initialize($configThumb);
			$this->image_lib->resize();

		}
		
		$edit_avatar = $this->user_model->edit_avatar($id, $avatar_name);

		if(!$edit_avatar) {
			return $this->_json_response(NULL, 2, 'Edit fail');
		}

		$user_new_session = array(
			'user_id' => $this->session->userdata['user_id'],
			'user_name' => $this->session->userdata['user_name'],
			'user_email' => $this->session->userdata['user_email'],
			'user_avatar' => $avatar_name,
			'user_cover' => $this->session->userdata['user_cover'],
			'user_auth' => $this->session->userdata['user_auth']
		);

		$this->session->set_userdata($user_new_session);

		return $this->_json_response($avatar_name, 1, 'Edit success');
	}

	public function set_default_cover() {
		if(!$this->is_login()) {
			return $this->_json_response(NULL, -1, 'Permission denied');
		}

		$id = $this->session->userdata['user_id'];
		$cover = "cover-default.jpg";

		if($this->_isempty($id, $cover)) {
			return $this->_json_response(NULL, 0, 'Params cannot be empty');
		}

		$edit_cover = $this->user_model->edit_cover($id, $cover);

		if(!$edit_cover) {
			return $this->_json_response(NULL, 2, 'Edit fail');
		}

		$user_new_session = array(
			'user_id' => $this->session->userdata['user_id'],
			'user_name' => $this->session->userdata['user_name'],
			'user_email' => $this->session->userdata['user_email'],
			'user_avatar' => $this->session->userdata['user_avatar'],
			'user_cover' => $cover,
			'user_auth' => $this->session->userdata['user_auth']
		);

		$this->session->set_userdata($user_new_session);

		return $this->_json_response($cover, 1, 'Edit success');
	}

	public function upload_cover() {
		$id = $this->session->userdata['user_id'];
		$cover_name = 'c'.time();
		$file_path = './images/cover/';
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $cover_name;

		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload('cover')) {
			return $this->_json_response($this->upload->display_errors(), 3, 'Upload fail');
		}
		else {
			$data['upload_data'] = $this->upload->data();
			$cover_name = $data['upload_data']['file_name'];

			//crop
			$this->load->library('image_lib'); 
			list($width, $height) = getimagesize($file_path.$cover_name);
			$config['image_library'] = 'gd2';
			$config['source_image'] = $file_path.$cover_name;
			$config['maintain_ratio'] = TRUE;
			if((1.0 * $width / 960) >= (1.0 * $height / 300))
			{
				$config['master_dim'] = 'height';
			}else{
				$config['master_dim'] = 'width';
			}
			
			$config['width'] = "960";
			$config['height'] = "300";
			
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
			$config['maintain_ratio'] = FALSE;

			if((1.0 * $width / 960) >= (1.0 * $height / 300)) {
				$config['x_axis'] = floor(((1.0 * $width / ($height / 300)) - 960) / 2 );
			}
			else{
				$config['y_axis'] = floor(((1.0 * $height / ($width / 960)) - 300) / 2 );
			}
			$this->image_lib->initialize($config);
			$this->image_lib->crop();
		}
		
		$edit_cover = $this->user_model->edit_cover($id, $cover_name);

		if(!$edit_cover) {
			return $this->_json_response(NULL, 2, 'Edit fail');
		}

		$user_new_session = array(
			'user_id' => $this->session->userdata['user_id'],
			'user_name' => $this->session->userdata['user_name'],
			'user_email' => $this->session->userdata['user_email'],
			'user_avatar' => $this->session->userdata['user_avatar'],
			'user_cover' => $cover_name,
			'user_auth' => $this->session->userdata['user_auth']
		);

		$this->session->set_userdata($user_new_session);

		return $this->_json_response($cover_name, 1, 'Edit success');
	}
}