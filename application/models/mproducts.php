<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Execution SQL statement on table ci_categoires
 *
 * @author manmath
 */
class Mproducts extends CI_Model {

	private $_data = array();

	/**
	 * Retreive all products
	 *
	 * @return boolean/array_object
	 */
	public function select() {
		$result = $this->db->get('ci_products');

		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	public function select_by_id($id) {
		$result = $this->db->select(array('pid', 'p.cid', 'p.name', 'p.unit_in_stocks', 'p.description', 'p.status'))
			->from('ci_products p')
			->join('ci_categories c', 'c.cid = p.cid')
			->where('pid', $id)
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
		return $this->db->insert('ci_products', $this->_data) ? TRUE : FALSE;
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
		$this->db->where('pid', $this->uri->segment(3));
		return $this->db->update('ci_products', $this->_data) ? TRUE : FALSE;
	}

	/**
	 * Delete
	 *
	 * @param integer $id
	 * @access public
	 * @return boolean
	 */
	public function discard_by_id($id) {
		$this->db->where('pid', $id);
		return $this->db->delete('ci_products') ? TRUE : FALSE;
	}

	/**
	 * Render JSON format of product name for autocomplete
	 *
	 * @param string $name
	 * @access public
	 * @return void
	 */
	public function get_product_autocomplete($name) {
		$result = $this->db->select('name')
			->like('name', $name)
			->where('status', 1)
			->where('unit_in_stocks > ', 0)
			->get('ci_products');
		if ($result->num_rows() > 0) {
			foreach ($result->result_array() as $row) {
				$result_set[] = htmlentities(stripslashes($row['name'])); // build an array
			}
			echo json_encode($result_set); //format the array into json data
		}
	}

}
