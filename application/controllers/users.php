<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'User Management';
		$this->load->model(array('musers', 'mroles'));
	}

	/**
	 * Retrieve all roles and users
	 */
	public function index() {
		$this->_data['active'] = 'user';
		$this->_data['users'] = $this->musers->select();
		$this->_data['roles'] = $this->mroles->select_role();
		$this->load->view('index', $this->_data);
	}

	/**
	 * Add new user
	 */
	public function add_user() {
		$config = array(
			array(
				'field' => 'firstname',
				'label' => 'first name',
				'rules' => 'trim|max_length[50]|alpha'
			),
			array(
				'field' => 'lastname',
				'label' => 'last name',
				'rules' => 'trim|max_length[50]|alpha'
			),
			array(
				'field' => 'username',
				'label' => 'username',
				'rules' => 'required|trim|max_length[50]|alpha_dash|is_unique[ci_users.username]'
			),
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'trim|valid_email|is_unique[ci_users.email]'
			),
			array(
				'field' => 'phone',
				'label' => 'phone',
				'rules' => 'trim|is_unique[ci_users.phone]'
			),
			array(
				'field' => 'rid',
				'label' => 'role',
				'rules' => 'trim'
			),
			array(
				'field' => 'sex',
				'label' => 'sex',
				'rules' => 'trim'
			),
			array(
				'field' => 'status',
				'label' => 'status',
				'rules' => 'trim'
			)
		);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_checkbox('status');
		$this->form_validation->set_message('valid_email', 'Invalid email format!');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['active'] = 'user';
			$this->_data['role'] = $this->mroles->select_role('', 1);
			$this->load->view('index', $this->_data);
		} else {
			if ($this->musers->add()) {
				$this->session->set_flashdata('message', alert_message("User account has been saved!", 'success'));
				redirect('users/', 'refresh');
			} else {
				$this->session->set_flashdata('message', alert_message("User account cannot be added, please try again", 'danger'));
				redirect('users/add');
			}
		}
	}

	/**
	 * Delete user
	 */
	public function discard_user () {
		if ($this->musers->discard()) {
			$this->session->set_flashdata('message', alert_message("User account has been deleted!", 'success'));
			redirect('users/', 'refresh');
		} else {
			$this->session->set_flashdata('message', alert_message("User account cannot been deleted,
			please try again", 'danger'));
			redirect('users/', 'refresh');
		}
	}

	/**
	 * Add new role
	 */
	public function add_role() {
		$config = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[50]|alpha|is_unique[ci_roles.name]'
			),
			array(
				'field' => 'description',
				'label' => '',
				'rules' => 'trim|max_length[250]'
			),
			array(
				'field' => 'mul_welcome',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'mul_sales',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'mul_deposits',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'mul_products',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'mul_categories',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'mul_reports',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'mul_users',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'mul_settings',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'status',
				'label' => '',
				'rules' => 'trim'
			)
		);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_checkbox('mul_welcome');
		$this->form_validation->set_checkbox('mul_sales');
		$this->form_validation->set_checkbox('mul_deposits');
		$this->form_validation->set_checkbox('mul_products');
		$this->form_validation->set_checkbox('mul_categories');
		$this->form_validation->set_checkbox('mul_reports');
		$this->form_validation->set_checkbox('mul_users');
		$this->form_validation->set_checkbox('mul_settings');
		$this->form_validation->set_checkbox('status');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['active'] = 'role';
			$this->load->view('index', $this->_data);
		} else {
			if ($this->mroles->add()) {
				$this->session->set_flashdata('message', alert_message("User role has been saved!", 'success'));
				redirect('users/', 'refresh');
			} else {
				$this->session->set_flashdata('message', alert_message("User role cannot be added, please try again",
					'danger'));
				redirect('users/add_role');
			}
		}
	}

	/**
	 * Delete role
	 */
	public function discard_role () {
		if ($this->mroles->discard()) {
			$this->session->set_flashdata('message', alert_message("User role has been deleted!", 'success'));
			redirect('users/', 'refresh');
		} else {
			$this->session->set_flashdata('message', alert_message("User role cannot been deleted, please try again",
				'danger'));
			redirect('users/', 'refresh');
		}
	}

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
