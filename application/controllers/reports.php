<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Manipulation on reports management
 *
 * @author manmath
 */
class Reports extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Reports Management';
		$this->load->model(array('mreports', 'musers', 'mcategories'));
		$this->mreports->mis_report();
	}

	/**
	 * List all reports by current date
	 */
	public function index() {
		$this->form_validation->set_rules('date', '', 'trim|max_length[10]');
		$this->form_validation->set_rules('type', '', 'trim');
		$this->form_validation->set_rules('cashier', '', 'trim');
		$this->form_validation->set_rules('category', '', 'trim');
		$this->form_validation->set_select('type');
		$this->form_validation->set_select('cashier');
		$this->form_validation->set_select('category');
		$this->form_validation->run();
		$this->_data['reports'] = $this->mreports->generate_report();
		$this->_data['cashiers'] = $this->musers->select_cashier();
		$this->_data['categories'] = $this->mcategories->select(1);
		$this->load->view('index', $this->_data);
	}
}

/* End of file reports.php */
/* Location: ./application/controllers/reports.php */
