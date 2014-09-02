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
		$this->_data['categories'] = $this->mcategories->select();
		$this->load->view('index', $this->_data);
	}

	/**
	 * Add
	 *
	 * @access public
	 * @return void
	 */
	public function add() {
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
				redirect('categories/');
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
	public function edit($id) {
		$this->_data['category'] = $this->mcategories->select_by_id($id);

		$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[50]|min_length[3]|callback_uniqueExcept[ci_categories.name, cid]');
		$this->form_validation->set_rules('description', '', 'trim');
		$this->form_validation->set_rules('status', '', 'trim');
		$this->form_validation->set_select('status');
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
	 * Delete
	 *
	 * @param integer $id category id to delete
	 * @access public
	 * @return void
	 */
	public function discard($id) {
		if ($this->mcategories->discard_by_id($id)) {
			$this->session->set_flashdata('message', alert_message("Category has been deleted!", 'success'));
			redirect('categories/');
		} else {
			$this->session->set_flashdata('message', alert_message("Category cannot be deleted, please try again!", 'danger'));
			redirect('categories/');
		}
	}

	public function confirm($result, $action) {
		if ($result) {
			if ($action === 'insert') {
				$this->session->set_userdata('success', 'New category was added!');
			} elseif ($action === 'update') {
				$this->session->set_userdata('success', 'Category was updated!');
			}
			redirect('categories/');
		}
	}

}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */
