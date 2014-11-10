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
		$this->load->model(array('mreports', 'mcategories'));
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
		$this->form_validation->set_rules('brand', '', 'trim');
		$this->form_validation->set_select('type');
		$this->form_validation->set_select('cashier');
		$this->form_validation->set_select('category');
		$this->form_validation->set_select('brand');
		$this->form_validation->run();
		$per_page = (int) $this->msettings->display_setting('DEFAULT_PAGINATION');
		$this->_data['reports'] = $this->mreports->findAllReports($per_page, $this->uri->segment(3));
		$this->_data['cashiers'] = $this->musers->select_cashier();
		$this->_data['categories'] = $this->mcategories->select_categorylist();
		$this->_data['brands'] = $this->mcategories->select_brandlist();
		page_browser(base_url() . 'reports/index/', (int) $this->mreports->countAllReports(), $per_page);
		$this->load->view('index', $this->_data);
	}

}

/* End of file reports.php */
/* Location: ./application/controllers/reports.php */
