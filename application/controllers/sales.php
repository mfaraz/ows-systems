<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Manipulation on sales management
 *
 * @author manmath
 */
class Sales extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Sale Management';
		$this->load->model(array('msales', 'mcategories'));
	}

	/**
	 * List all categoires
	 */
	public function index() {
		// check in case invoice exist
		$this->_data['invoice_items'] = $this->msales->check_purchase();

		$this->form_validation->set_rules('name', 'Product', 'required|min_length[1]|max_length[50]|trim');
		$this->form_validation->set_rules('cid', '', 'trim');
		$this->form_validation->set_rules('qty', 'Quantity', 'required|min_length[1]|max_length[5]|trim|numeric');
		$this->form_validation->set_rules('unit_price', 'Unit Price', 'required|min_length[1]|max_length[25]|trim|numeric');
		$this->form_validation->set_select('cid');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['categories'] = $this->mcategories->select(1);
			$this->load->view('index', $this->_data);
		} else {
			if (!$this->session->userdata('cur_invoice_id')) {
				$this->msales->save_invoice();
			} else {
				$this->msales->save_invoice_details();
			}
			$this->session->set_flashdata('message', alert_message("Product has been added to invoice!", 'success'));
			redirect('sales/');
		}
	}

	/**
	 * Remove current purchase item
	 */
	public function discard() {
		if ($this->msales->discard($this->uri->segment(3))) {
			$this->session->set_flashdata('message', alert_message("Product has been added to invoice!", 'success'));
			redirect('sales/');
		}
	}

}

/* End of file sales.php */
/* Location: ./application/controllers/sales.php */
