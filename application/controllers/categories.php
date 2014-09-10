<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Manipulation on categories management
 *
 * @author manmath
 */
class Categories extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Categoires Management';
		$this->load->model(array('mcategories'));
	}

	/**
	 * List all categoires
	 */
	public function index() {
		$this->_data['categorylist'] = $this->mcategories->select_categorylist(1);

		$this->form_validation->set_rules('parent_id', '', 'trim');
		$this->form_validation->set_select('parent_id');
		$this->form_validation->run();

		$this->_data['categories'] = $this->mcategories->select_category();
		$this->_data['brands'] = $this->mcategories->select_brand();
		$this->_data['active'] = $this->input->post('active') ? $this->input->post('active') : 'category';
		$this->load->view('index', $this->_data);
	}

	/**
	 * Add new category
	 *
	 * @access public
	 * @return void
	 */
	public function add_category() {
		$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[50]|min_length[3]|is_unique[ci_categories.name]');
		$this->form_validation->set_rules('description', '', 'trim');
		$this->form_validation->set_rules('status', '', 'trim');
		$this->form_validation->set_checkbox('status');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('index', $this->_data);
		} else {
			if ($this->mcategories->add()) {
				$this->session->set_flashdata('message', alert_message("Category has been saved!", 'success'));
				redirect('categories/');
			} else {
				$this->session->set_flashdata('message', alert_message("Category cannot be saved, please try again!", 'danger'));
				$this->load->view('index', $this->_data);
			}
		}
	}

	/**
	 * Add new brand
	 *
	 * @access public
	 * @return void
	 */
	public function add_brand() {
		$this->_data['categories'] = $this->mcategories->select_categorylist(1);

		$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[50]|min_length[3]|is_unique[ci_categories.name]');
		$this->form_validation->set_rules('parent_id', '', 'trim');
		$this->form_validation->set_rules('description', '', 'trim');
		$this->form_validation->set_rules('status', '', 'trim');
		$this->form_validation->set_select('parent_id');
		$this->form_validation->set_checkbox('status');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('index', $this->_data);
		} else {
			if ($this->mcategories->add()) {
				$this->session->set_flashdata('message', alert_message("Brand has been saved!", 'success'));
				redirect('categories/');
			} else {
				$this->session->set_flashdata('message', alert_message("Brand cannot be saved, please try again!", 'danger'));
				$this->load->view('index', $this->_data);
			}
		}
	}

	/**
	 * Edit
	 *
	 * @param integer $id category id to edit
	 * @access public
	 * @return void
	 */
	public function edit_category($id) {
		$this->_data['category'] = $this->mcategories->select_by_id($id);

		$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[50]|min_length[3]|callback_uniqueExcept[ci_categories.name, cid]');
		$this->form_validation->set_rules('description', '', 'trim');
		$this->form_validation->set_rules('status', '', 'trim');
		$this->form_validation->set_checkbox('status');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('index', $this->_data);
		} else {
			if ($this->mcategories->edit()) {
				$this->session->set_flashdata('message', alert_message("Category has been updated!", 'success'));
				redirect('categories/');
			} else {
				$this->session->set_flashdata('message', alert_message("Category cannot be updated, please try again!", 'danger'));
				$this->load->view('index', $this->_data);
			}
		}
	}

	/**
	 * Edit
	 *
	 * @param integer $id brand id to edit
	 * @access public
	 * @return void
	 */
	public function edit_brand($id) {
		$this->_data['brand'] = $this->mcategories->select_by_id($id);
		$this->_data['categories'] = $this->mcategories->select_categorylist(1);

		$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[50]|min_length[3]|callback_uniqueExcept[ci_categories.name, cid]');
		$this->form_validation->set_rules('parent_id', '', 'trim');
		$this->form_validation->set_rules('description', '', 'trim');
		$this->form_validation->set_rules('status', '', 'trim');
		$this->form_validation->set_select('parent_id');
		$this->form_validation->set_checkbox('status');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('index', $this->_data);
		} else {
			if ($this->mcategories->edit()) {
				$this->session->set_flashdata('message', alert_message("Brand has been updated!", 'success'));
				redirect('categories/');
			} else {
				$this->session->set_flashdata('message', alert_message("Brand cannot be updated, please try again!", 'danger'));
				$this->load->view('index', $this->_data);
			}
		}
	}

	/**
	 * Delete cateogry
	 *
	 * @param integer $id category id to delete
	 * @access public
	 * @return void
	 */
	public function discard_category($id) {
		if ($this->mcategories->discard_by_id($id)) {
			$this->session->set_flashdata('message', alert_message("Category has been deleted!", 'success'));
			redirect('categories/');
		} else {
			$this->session->set_flashdata('message', alert_message("Category cannot be deleted, please try again!", 'danger'));
			redirect('categories/');
		}
	}

	/**
	 * Delete brand
	 *
	 * @param integer $id brand id to delete
	 * @access public
	 * @return void
	 */
	public function discard_brand($id) {
		if ($this->mcategories->discard_by_id($id)) {
			$this->session->set_flashdata('message', alert_message("Brand has been deleted!", 'success'));
			redirect('categories/');
		} else {
			$this->session->set_flashdata('message', alert_message("Brand cannot be deleted, please try again!", 'danger'));
			redirect('categories/');
		}
	}

}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */
