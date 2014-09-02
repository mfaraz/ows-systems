<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Execution SQL statement on table ci_categoires
 *
 * @author manmath
 */
class Mcategories extends CI_Model {

	private $_data = array();

	/**
	 * Retreive all categories
	 *
	 * @return boolean/array_object
	 */
	public function select($status = '') {
		if ($status) {
			$this->db->where('status', $status);
		}
		$result = $this->db->get('ci_categories');

		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	public function select_by_id($id) {
		$result = $this->db->select(array('cid', 'name', 'description', 'status'))
			->from('ci_categories')
			->where('cid', $id)
			->limit(1)
			->get();
		if ($result->num_rows() > 0) {
			return $result->row();
		}
		return FALSE;
	}

	/**
	 * Add
	 *
	 * @access public
	 * @return boolean
	 */
	public function add() {
		$this->db->set('cruser', $this->session->userdata('ci_id'));
		$this->db->set('crdate', time(), FALSE);
		$this->_data = $this->input->post();
		return $this->db->insert('ci_categories', $this->_data) ? TRUE : FALSE;
	}

	/**
	 * Edit
	 *
	 * @access public
	 * @return boolean
	 */
	public function edit() {
		$this->db->set('mouser', $this->session->userdata('ci_id'));
		$this->db->set('modate', time(), FALSE);
		$this->_data = $this->input->post();
		if (empty($this->_data['status'])) {
			$this->db->set('status', 0);
		}
		$this->db->where('cid', $this->uri->segment(3));
		return $this->db->update('ci_categories', $this->_data) ? TRUE : FALSE;
	}

	/**
	 * Delete
	 *
	 * @param integer $id
	 * @access public
	 * @return boolean
	 */
	public function discard_by_id($id) {
		$this->db->where('cid', $id);
		return $this->db->delete('ci_categories') ? TRUE : FALSE;
	}

}
