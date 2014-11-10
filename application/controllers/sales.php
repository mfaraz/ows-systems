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
			$this->_data['categories'] = $this->mcategories->select_categorylist();
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
			$this->session->set_flashdata('message', alert_message("Product has been removed!", 'success'));
			redirect('sales/');
		}
	}

	/**
	 * Returnable product
	 */
	public function returnable() {
		// check in case invoice exist
		$chash = $this->uri->segment(3);
		$this->_data['invoice_items'] = $this->msales->check_purchase($chash);

		$this->form_validation->set_rules('name', 'Product', 'required|min_length[1]|max_length[50]|trim');
		$this->form_validation->set_rules('cid', '', 'trim');
		$this->form_validation->set_rules('qty', 'Quantity', 'required|min_length[1]|max_length[5]|trim|numeric');
		$this->form_validation->set_rules('unit_price', 'Unit Price', 'required|min_length[1]|max_length[25]|trim|numeric');
		$this->form_validation->set_select('cid');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['categories'] = $this->mcategories->select_categorylist();
			$this->load->view('index', $this->_data);
		} else {
			$this->msales->save_invoice_details($this->uri->segment(4));
			$this->session->set_flashdata('message', alert_message("Product has been exchanged!", 'success'));
			redirect('sales/returnable/' . $chash . '/' . $this->uri->segment(4));
		}
	}

	/**
	 * Returnable product
	 */
	public function removeitem() {
		$idid = $this->uri->segment(3); // invoice detail id
		$name = urldecode($this->uri->segment(4)); // product name
		$qty = $this->uri->segment(5); // Qty
		$iid = $this->uri->segment(6); // invoice id
		$chash = $this->uri->segment(7);

		// remove item from invoice detail
		$this->db->where('idid', $idid);
		$this->db->where('iid', $iid);
		if ($this->db->delete('ci_invoice_details')) {
			$this->msales->cut_stock($name, $qty, TRUE);
		}

		// update invoice
		$this->updateInvoice($iid);
		redirect('sales/returnable/' . $chash . '/' . $iid);
	}

	public function updateInvoice($iid) {
		$this->db->where('iid', $iid);
		$result = $this->db->get('ci_invoice_details');
		if ($result->num_rows() < 1) {
			$data = array(
				'cash_recive' => 0.00,
				'total' => 0.00,
				'grand_total' => 0.00,
				'discount' => 0,
				'cash_exchange' => 0.00
			);
			$this->db->update('ci_invoices', $data);
		}
	}

}

/* End of file sales.php */
/* Location: ./application/controllers/sales.php */
