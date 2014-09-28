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

	public function select_setting() {
		return $this->db->get('ci_settings');
	}

	public function save_default($filename = '') {
		if (!empty($filename)) {
			$this->db->set('DEFAULT_COMPANY_LOGO', $filename);
		}
		$this->db->set('DEFAULT_COMPANY_NAME', $this->input->post('DEFAULT_COMPANY_NAME'))
			->set('DEFAULT_COMPANY_ADDRESS', $this->input->post('DEFAULT_COMPANY_ADDRESS'))
			->set('DEFAULT_COMPANY_PHONE', $this->input->post('DEFAULT_COMPANY_PHONE'))
			->set('DEFAULT_USD_TO_KH', $this->input->post('DEFAULT_USD_TO_KH'))
			->set('DISPLAY_CUSTOMER', $this->input->post('DISPLAY_CUSTOMER') == '' ? 0 : 1);
		$result = $this->db->get('ci_settings');
		if ($result->num_rows() > 0) {
			return $this->db->update('ci_settings') ? TRUE : FALSE;
		} else {
			return $this->db->insert('ci_settings') ? TRUE : FALSE;
		}
	}

	/**
	 * Display company settings
	 *
	 * @param string $field
	 * @return boolean/mixed
	 */
	public function display_setting($field) {
		$result = $this->db->select($field)
			->from('ci_settings')
			->get();
		if ($result->num_rows() > 0) {
			$data = $result->row(0);
			return $data->$field;
		}
		return FALSE;
	}

}

/* End of file musers.php */
/* Location: ./application/models/musers.php */
