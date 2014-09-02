<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Manipulation on products management
 *
 * @author manmath
 */
class Products extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Categoires Management';
		$this->load->model(array('mproducts', 'mcategories'));
	}

	/**
	 * List all categoires
	 */
	public function index() {
		$this->_data['products'] = $this->mproducts->select();
		$this->load->view('index', $this->_data);
	}

	/**
	 * Add
	 *
	 * @access public
	 * @return void
	 */
	public function add() {
		$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[50]|min_length[2]|is_unique[ci_products.name]');
		$this->form_validation->set_rules('unit_in_stocks', 'unit in stocks', 'required|trim|max_length[50]|min_length[1]|numeric');
		$this->form_validation->set_rules('description', '', 'trim');
		$this->form_validation->set_rules('status', '', 'trim');
		$this->form_validation->set_rules('cid', '', 'trim');
		$this->form_validation->set_select('cid');
		$this->form_validation->set_checkbox('status');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['categories'] = $this->mcategories->select(1);
			$this->load->view('index', $this->_data);
		} else {
			if ($this->mproducts->add()) {
				$this->session->set_flashdata('message', alert_message("Product has been saved!", 'success'));
				redirect('products/');
			} else {
				$this->session->set_flashdata('message', alert_message("Product cannot be saved, please try again!", 'danger'));
				redirect('pproducts/add');
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
		$this->_data['products'] = $this->mproducts->select_by_id($id);

		$this->form_validation->set_rules('name', 'name', 'required|trim|max_length[50]|min_length[2]|callback_uniqueExcept[ci_products.name, pid]');
		$this->form_validation->set_rules('description', '', 'trim');
		$this->form_validation->set_rules('cid', '', 'trim');
		$this->form_validation->set_rules('status', '', 'trim');
		$this->form_validation->set_select('cid');
		$this->form_validation->set_checkbox('status');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['categories'] = $this->mcategories->select(1);
			$this->load->view('index', $this->_data);
		} else {
			if ($this->mproducts->edit()) {
				$this->session->set_flashdata('message', alert_message("Category has been updated!", 'success'));
				redirect('products/');
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
		if ($this->mproducts->discard_by_id($id)) {
			$this->session->set_flashdata('message', alert_message("Product has been deleted!", 'success'));
			redirect('products/');
		} else {
			$this->session->set_flashdata('message', alert_message("Product cannot be deleted, please try again!", 'danger'));
			redirect('products/');
		}
	}

	public function get_product_autocomplete() {
		if (isset($_GET['term'])) {
			$name = strtolower($_GET['term']);
			$this->mproducts->get_product_autocomplete($name);
		}
	}

}

/* End of file products.php */
/* Location: ./application/controllers/products.php */
