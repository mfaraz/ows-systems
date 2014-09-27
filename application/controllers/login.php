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
		$this->_data['title'] = 'Login - POS Systems';
		if ($this->musers->has_login() && $this->uri->segment(2) !== 'logout') {
			redirect('sales/', 'refresh');
		}
	}

	/**
	 * Login
	 *
	 * @access public
	 * @return void
	 */
	public function index() {
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
			$data = array(
				'sess_id' => $result->uid,
				'sess_username' => $result->username,
				'sess_fullname' => $result->firstname . ' ' . $result->lastname,
				'sess_role' => $result->name,
				'mul_sales' => $result->mul_sales,
				'mul_products' => $result->mul_products,
				'mul_categories' => $result->mul_categories,
				'mul_reports' => $result->mul_reports,
				'mul_deposits' => $result->mul_deposits,
				'mul_users' => $result->mul_users,
				'mul_settings' => $result->mul_settings
			);
			$this->db->insert('ci_sessions', $data);
			redirect('sales/');
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
		$this->db->truncate('ci_sessions');
		$this->session->sess_destroy();
		redirect('login/', 'refresh');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
