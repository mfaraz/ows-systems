<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of Musers
 *
 * @author manmath
 */
class Mroles extends CI_Model {

	/**
	 * Retrieve all roles
	 *
	 * @return array records
	 */
	public function get_role() {
		$result = $this->db->get('ci_roles');
		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	/**
	 * Retrive role list
	 */
	public function get_rolelist() {
		$this->db->where('status', 1);
		$result = $this->db->get('ci_roles');
		$data = array();
		if ($result->num_rows() > 0) {
			foreach ($result->result_array() as $row) {
				$data[$row['rid']] = $row['name'];
			}
			return $data;
		}
		return FALSE;
	}

	public function get_role_byid($id) {
		$result = $this->db->where('rid', $id)
			->limit(1)
			->get('ci_roles');
		if ($result->num_rows() > 0) {
			return $result->row();
		}
		return FALSE;
	}

	/**
	 * Create new role
	 *
	 * @return bool
	 */
	public function add() {
		$this->db->set('crdate', time(), FALSE);
		$this->_data = $this->input->post();
		return $this->db->insert('ci_roles', $this->_data) ? TRUE : FALSE;
	}

	/**
	 * Edit role
	 *
	 * @return boolean
	 */
	public function edit() {
		$this->db->set('modate', time(), FALSE);
		$this->_data = $this->input->post();
		if (empty($this->_data['mul_sales'])) {
			$this->db->set('mul_sales', 0);
		}
		if (empty($this->_data['mul_deposits'])) {
			$this->db->set('mul_deposits', 0);
		}
		if (empty($this->_data['mul_products'])) {
			$this->db->set('mul_products', 0);
		}
		if (empty($this->_data['mul_categories'])) {
			$this->db->set('mul_categories', 0);
		}
		if (empty($this->_data['mul_reports'])) {
			$this->db->set('mul_reports', 0);
		}
		if (empty($this->_data['mul_users'])) {
			$this->db->set('mul_users', 0);
		}
		if (empty($this->_data['mul_settings'])) {
			$this->db->set('mul_settings', 0);
		}
		$this->db->where('rid', $this->uri->segment(3));
		return $this->db->update('ci_roles', $this->_data) ? TRUE : FALSE;
	}

	/**
	 * Delete role
	 *
	 * @return bool
	 */
	public function discard() {
		$this->db->where('rid', $this->uri->segment(3));
		return $this->db->delete('ci_roles') ? TRUE : FALSE;
	}

}

/* End of file musers.php */
/* Location: ./application/models/musers.php */
