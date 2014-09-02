<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 */
class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('musers', 'msettings'));
		$this->_data['title'] = 'Login';
		if ($this->session->userdata('ci_username') && $this->uri->segment(2) !== 'logout') {
			redirect('welcome/', 'refresh');
		}
	}

	/**
	 * Login
	 *
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['title'] = 'Login';
		if ($this->input->post('login')) {
			$this->form_validation->set_rules('username', 'Username', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('login', $data);
			} else {
				$result = $this->musers->validate_login();
				$this->create_session_login($result);
			}
		} else {
			$this->load->view('login', $this->_data);
		}
	}

	/**
	 * Set session after login success
	 *
	 * @param type $result array_object
	 * @access public
	 * @return void
	 */
	public function create_session_login($result) {
		if ($result) {
			$this->session->set_userdata(array(
				'ci_id' => $result->uid,
				'ci_username' => $result->username,
				'ci_firstname' => $result->firstname,
				'ci_fullname' => $result->firstname . ' ' . $result->lastname,
				'ci_role' => $result->name,
				'mul_welcome' => $result->mul_welcome,
				'mul_sales' => $result->mul_sales,
				'mul_products' => $result->mul_products,
				'mul_categories' => $result->mul_categories,
				'mul_reports' => $result->mul_reports,
				'mul_deposits' => $result->mul_deposits,
				'mul_users' => $result->mul_users,
				'mul_settings' => $result->mul_settings
			));
			redirect('welcome/');
		} else {
			$this->session->set_flashdata('message', alert_message('Invalid username or password!', 'danger'));
			redirect('login/', 'refresh');
		}
	}

	/**
	 * Logout
	 *
	 * @access public
	 * @return void
	 */
	public function logout() {
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		$this->session->sess_destroy();
		redirect('welcome', 'refresh');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
