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
		$this->_data['users'] = $this->musers->get_user();
		$this->_data['roles'] = $this->mroles->get_role();
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
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[3]|max_length[50]'
			),
			array(
				'field' => 'conpassword',
				'label' => 'Confirm Password',
				'rules' => 'trim|required|min_length[3]|max_length[50]|matches[password]'
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
		$this->form_validation->set_select('rid');
		$this->form_validation->set_checkbox('status');
		$this->form_validation->set_message('valid_email', 'Invalid email format!');
		$this->form_validation->set_message('matches', 'Password does not match!');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['active'] = 'user';
			$this->_data['roles'] = $this->mroles->get_rolelist();
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
				$this->session->set_flashdata('message', alert_message("User role cannot be added, please try again", 'danger'));
				redirect('users/add_role');
			}
		}
	}

	public function edit_user($id) {
		$this->_data['user'] = $this->musers->get_user_byid($id);
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
				'label' => 'Username',
				'rules' => 'trim|required|mix_length[50]|alpha_dash|callback_uniqueExcept[ci_users.username, uid]'
			),
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'trim|valid_email|callback_uniqueExcept[ci_users.email, uid]'
			),
			array(
				'field' => 'phone',
				'label' => 'phone',
				'rules' => 'trim|callback_uniqueExcept[ci_users.phone, uid]'
			),
			array(
				'field' => 'rid',
				'label' => '',
				'rules' => 'trim'
			),
			array(
				'field' => 'sex',
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
		$this->form_validation->set_select('rid');
		$this->form_validation->set_checkbox('status');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['active'] = 'user';
			$this->_data['roles'] = $this->mroles->get_rolelist();
			$this->load->view('index', $this->_data);
		} else {
			if ($this->musers->edit()) {
				if (($this->uri->segment(3) == $this->session->userdata('ci_id')) && ($this->input->post('username') != $this->session->userdata('ci_username'))) {
					redirect('login/logout', 'refresh');
				} else {
					$this->session->set_flashdata('message', alert_message("User account has been updated!", 'success'));
					redirect('users/', 'refresh');
				}
			} else {
				$this->session->set_flashdata('message', alert_message("User account cannot be updated, please try again", 'danger'));
				redirect('users/edit_user');
			}
		}
	}

	/**
	 * Edit role
	 *
	 * @param integer $id
	 */
	public function edit_role($id) {
		$this->_data['role'] = $this->mroles->get_role_byid($id);

		$config = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[50]|alpha|callback_uniqueExcept[ci_roles.name, rid]'
			),
			array(
				'field' => 'description',
				'label' => '',
				'rules' => 'trim|max_length[250]'
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
			if ($this->mroles->edit()) {
				$this->session->set_flashdata('message', alert_message("User role has been updated!", 'success'));
				redirect('users/', 'refresh');
			} else {
				$this->session->set_flashdata('message', alert_message("User role cannot be updated, please try again", 'danger'));
				redirect('users/add_role');
			}
		}
	}

	/**
	 * Change password
	 */
	public function change_password() {
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('conpassword', 'Confirm Password', 'required|trim|matches[password]');
		$this->form_validation->set_message('matches', 'Password does not match!');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('index', $this->_data);
		} else {
			if ($this->musers->change_password()) {
				if ($this->uri->segment(3) == $this->session->userdata('ci_id')) {
					redirect('login/logout', 'refresh');
				} else {
					$this->session->set_flashdata('message', alert_message("Password has beed changed!", 'success'));
					redirect('users/', 'refresh');
				}
			} else {
				$this->session->set_flashdata('message', alert_message("Password cannot be changed, some error ocurred!", 'danger'));
				redirect('users/change_password', 'refresh');
			}
		}
	}

	/**
	 * Delete user
	 */
	public function discard_user() {
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
	 * Delete role
	 */
	public function discard_role() {
		if ($this->mroles->discard()) {
			$this->session->set_flashdata('message', alert_message("User role has been deleted!", 'success'));
			redirect('users/', 'refresh');
		} else {
			$this->session->set_flashdata('message', alert_message("User role cannot been deleted, please try again", 'danger'));
			redirect('users/', 'refresh');
		}
	}

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
