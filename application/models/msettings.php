<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of Msettings
 *
 * @author manmath
 */
class Msettings extends CI_Model {

	/**
	 * Retrieve record in table ci_roles
	 *
	 * @param integer $id
	 * @param integer $status
	 * @return array records
	 */
	public function select_role($id = '', $status = '') {
		$this->db->select(array('id', 'name'));

		if ($id !== '') {
			$this->db->where('id', $id);
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

	public function select_setting () {
		return $this->db->get('ci_settings');
	}

	public function save_default() {
		$this->_data = $this->input->post();
		$result = $this->db->get('ci_settings');
		if ($result->num_rows() > 0) {
			return $this->db->update('ci_settings', $this->_data) ? TRUE : FALSE;
		} else {
			return $this->db->insert('ci_settings', $this->_data) ? TRUE : FALSE;
		}
	}

}

/* End of file musers.php */
/* Location: ./application/models/musers.php */
