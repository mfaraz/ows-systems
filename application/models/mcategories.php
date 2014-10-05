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
	public function select_category() {
		$result = $this->db->where('parent_id', 0)
			->get('ci_categories');
		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	/**
	 * Retreive categories list
	 *
	 * @return boolean/array
	 */
	public function select_categorylist() {
		$this->db->where('status', 1);
		$this->db->where('parent_id', 0);
		$result = $this->db->get('ci_categories');
		$data = array();
		if ($result->num_rows() > 0) {
			foreach ($result->result_array() as $row) {
				$data[$row['cid']] = $row['name'];
			}
			return $data;
		}
		return FALSE;
	}

	/**
	 * Retreive all brands
	 *
	 * @return boolean/array_object
	 */
	public function select_brand() {
		if ($this->input->post('parent_id') != '') {
			$this->db->where('parent_id', $this->input->post('parent_id'));
		}
		$result = $this->db->where('parent_id >', 0)
			->get('ci_categories');
		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	/**
	 * Retreive brands list
	 *
	 * @return boolean/array
	 */
	public function select_brandlist($parent_id = '') {
		$this->db->where('status', 1);
		if (!empty($parent_id)) {
			$this->db->where('parent_id', $parent_id);
		} else {
			$this->db->where('parent_id >', 0);
		}
		$result = $this->db->get('ci_categories');
		$data = array();
		if ($result->num_rows() > 0) {
			foreach ($result->result_array() as $row) {
				$data[$row['cid']] = $row['name'];
			}
			return $data;
		}
		return FALSE;
	}

	/**
	 * Retreive single item
	 *
	 * @param integer $id
	 * @return boolean/array
	 */
	public function select_by_id($id) {
		$result = $this->db->where('cid', $id)
			->limit(1)
			->get('ci_categories');
		if ($result->num_rows() > 0) {
			return $result->row();
		}
		return FALSE;
	}

	/**
	 * Add new category/brand
	 *
	 * @access public
	 * @return boolean
	 */
	public function add() {
		$this->db->set('cruser', $this->musers->has_login('sess_id'));
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
		$result = $this->db->where('parent_id', $id)->get('ci_categories');
		$this->db->where('cid', $id);
		if ($result->num_rows > 0) {
			$this->db->or_where('parent_id', $id);
		}
		return $this->db->delete('ci_categories') ? TRUE : FALSE;
	}

}
