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
	 * Retrieve record in table ci_roles
	 *
	 * @param integer $id
	 * @param integer $status
	 * @return array records
	 */
	public function select_role($id = '', $status = '') {
		$this->db->select('*');

		if ($id !== '') {
			$this->db->where('rid', $id);
		}

		if ($status !== '') {
			$this->db->where('status', $status);
		}

		$result = $this->db->get('ci_roles');
		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	/**
	 * Create new role
	 *
	 * @return bool
	 */
	public function add () {
		$this->db->set('crdate', time(), FALSE);
		$this->_data = $this->input->post();
		return $this->db->insert('ci_roles', $this->_data) ? TRUE : FALSE;
	}

	/**
	 * Delete role
	 *
	 * @return bool
	 */
	public function discard () {
		$this->db->where('rid', $this->uri->segment(3));
		return $this->db->delete('ci_roles') ? TRUE : FALSE;
	}
}

/* End of file musers.php */
/* Location: ./application/models/musers.php */
