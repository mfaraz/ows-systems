<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of Musers
 *
 * @author manmath
 */
class Musers extends CI_Model {

	private $_data = array();

	/**
	 * Retrieve user record
	 *
	 * @param integer $id
	 * @return boolean/array_object
	 */
	public function select($id = '') {
		$this->db->select(array('u.*', 'r.name'))
				->from('ci_users u')
				->join('ci_roles r', 'r.rid = u.rid')
				->order_by('u.firstname');

		if ($id !== '') {
			$this->db->where('uid', $id)
					->limit(1);
		}

		$result = $this->db->get();

		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	/**
	 * Select all available cashiers
	 *
	 * @return bool/mixed
	 */
	public function select_cashier() {
		$result = $this->db->select('u.firstname')
			->from('ci_users u')
			->join('ci_roles r', 'r.rid = u.rid')
			->where('mul_sales', 1)
			->get();
		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}
	/**
	 * Create user
	 *
	 * @return boolean
	 */
	public function add() {
		$this->_data = array(
			'rid' => $this->input->post('rid'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password') . $this->config->item('encryption_key')),
			'sex' => $this->input->post('sex'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'status' => $this->input->post('status'),
			'crdate' => time()
		);
		return $this->db->insert('ci_users', $this->_data);
	}

	/**
	 * Login validation
	 */
	public function validate_login() {
		$result = $this->db->select(array('u.*', 'r.*'))
				->from('ci_users u')
				->join('ci_roles r', 'r.rid = u.rid')
				->where(array(
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password') . $this->config->item('encryption_key')),
					'u.status' => 1)
				)
				->limit(1)
				->get();
		if ($result->num_rows() > 0) {
			return $result->row();
		}
		return FALSE;
	}

	/**
	 * Delete user
	 *
	 * @return bool
	 */
	public function discard () {
		$this->db->where('uid', $this->uri->segment(3));
		return $this->db->delete('ci_users') ? TRUE : FALSE;
	}
}

/* End of file musers.php */
/* Location: ./application/models/musers.php */
