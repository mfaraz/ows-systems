<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Execution SQL statement on table ci_categoires
 *
 * @author manmath
 */
class Msales extends CI_Model {

	private $_data = array();

	/**
	 * Retreive all categories
	 *
	 * @return boolean/array_object
	 */
	public function select($id) {
		$this->db->where('cid', $id);
		$this->db->where('status', 1);
		$this->db->where('unit_in_stocks >', 0);
		$result = $this->db->get('ci_products');

		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	/**
	 * Add
	 *
	 * @access public
	 * @return boolean
	 */
	public function save_invoice() {
		$this->_data = array(
			'cruser' => $this->musers->has_login('sess_id'),
			'crdate' => time()
		);
		$this->db->insert('ci_invoices', $this->_data);

		// Obtain last insert invoice
		$this->session->set_userdata('cur_invoice_id', $this->db->insert_id());

		// Set invoice number
		$invoice_no = $this->generate_invoice_number($this->session->userdata('cur_invoice_id'));
		$this->db->set('invoice_number', $invoice_no);
		$this->db->set('chash', md5($invoice_no));
		$this->db->where('iid', $this->session->userdata('cur_invoice_id'));
		$this->db->update('ci_invoices');

		// Add data to invoice detials
		$this->save_invoice_details();

		return $this->session->userdata('cur_invoice_id');
	}

	/**
	 * Generate invoice number
	 *
	 * @access public
	 * @param integer $id
	 * @return string
	 */
	public function generate_invoice_number($id) {
		$invoice_number = '';
		$l = strlen($id);
		switch ($l) {
			case 1:
				$invoice_number = '00000000000' . $id;
				break;
			case 2:
				$invoice_number = '0000000000' . $id;
				break;
			case 3:
				$invoice_number = '000000000' . $id;
				break;
			case 4:
				$invoice_number = '00000000' . $id;
				break;
			case 5:
				$invoice_number = '0000000' . $id;
				break;
			case 6:
				$invoice_number = '000000' . $id;
				break;
			case 7:
				$invoice_number = '00000' . $id;
				break;
			case 8:
				$invoice_number = '0000' . $id;
				break;
			case 9:
				$invoice_number = '000' . $id;
				break;
			case 10:
				$invoice_number = '00' . $id;
				break;
			default:
				$invoice_number = '0' . $id;
				break;
		}
		return $invoice_number;
	}

	/**
	 * Save invoice detial
	 */
	public function save_invoice_details($invoice_no = '') {
		$this->_data = array(
			'iid' => ($invoice_no != '' ? $invoice_no : $this->session->userdata('cur_invoice_id')),
			'parent_id' => ($this->input->post('parent_id') != '' ? $this->input->post('parent_id') : '3'),
			'cid' => ($this->input->post('parent_id') != '' ? $this->input->post('cid') : '3'),
			'name' => $this->input->post('name'),
			'qty' => $this->input->post('qty'),
			'unit_price' => $this->input->post('unit_price'),
			'sub_total' => ($this->input->post('qty') * $this->input->post('unit_price'))
		);


		$this->db->insert('ci_invoice_details', $this->_data);
	}

	/**
	 * Check purchase product
	 *
	 * @param string $invoice_no
	 * @return bool/array
	 */
	public function check_purchase($invoice_no = '') {
		if ($invoice_no != '') {
			$this->db->where('i.chash', $invoice_no);
		} elseif ($this->session->userdata('cur_invoice_id')) {
			$this->db->where('i.iid', $this->session->userdata('cur_invoice_id'));
		} else {
			$this->db->where('i.iid', 0);
		}
		$this->db->select(array('d.idid', 'd.iid', 'i.invoice_number', 'i.customer', 'i.total',
				'i.cash_receive', 'i.cash_type', 'i.discount', 'i.grand_total', 'i.deposit', 'i.balance',
				'i.cash_exchange', 'i.crdate', 'i.modate', 'i.grand_total', 'd.cid', 'd.name', 'd.qty',
				'd.unit_price', 'd.sub_total'))
			->from('ci_invoices i')
			->join('ci_invoice_details d', 'd.iid = i.iid');
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->result();
		}
		return FALSE;
	}

	/**
	 * Sub total
	 *
	 * @return mixed
	 */
	public function get_total($iid = '') {
		/**
		 * TODO: Finalize why $iid is empty for saving data for printing
		 */
		$iid = $this->session->userdata('cur_invoice_id');

		$this->db->select('(SELECT SUM(sub_total) FROM ci_invoice_details WHERE iid = '.$iid.') AS total', FALSE);
		$result = $this->db->get('ci_invoice_details')->result();
		if ($result) {
			foreach ($result as $r) {
				$result = $r->total;
				break;
			}
		}

		return $result;
	}

	/**
	 * Get customer
	 *
	 * @param string $chash
	 * @return array
	 */
	public function get_customer($chash = '') {
		if (!empty($chash)) {
			$this->db->where('chash', $chash);
		} else {
			$this->db->where('iid', $this->session->userdata('cur_invoice_id'));
		}

		return $this->db->select(array('customer', 'grand_total'))
				->limit(1)
				->get('ci_invoices');
	}

	// Update invoice before printing
	public function update_invoice($data = array()) {
		$this->db->where('iid', $this->session->userdata('cur_invoice_id'));
		if ($this->db->update('ci_invoices', $data)) {
			return TRUE;
		}
		return FALSE;
	}

	// Update status of invoice after printing
	public function print_invoice() {
		$this->db->set('status', 1)
			->where('iid', $this->session->userdata('cur_invoice_id'))
			->update('ci_invoices');
	}

	/**
	 * Auto cut stock
	 *
	 * @param string $name
	 * @param integer $qty
	 * @param boolean $returnable
	 */
	public function cut_stock($name, $qty, $returnable = FALSE) {
		$result = $this->db->select(array('unit_in_stocks', 'unit_in_sales'))
			->where('name', $name)
			->where('unit_in_stocks > ', 0)
			->get('ci_products');

		if ($result->num_rows() > 0) {
			foreach ($result->result() as $arr) {
				if ($returnable == TRUE) {
					$new_unit_in_stocks = $arr->unit_in_stocks + $qty;
					$new_unit_in_sales = $arr->unit_in_sales - $qty;
				} else {
					$new_unit_in_stocks = $arr->unit_in_stocks - $qty;
					$new_unit_in_sales = $arr->unit_in_sales + $qty;
				}

				$this->db->set('unit_in_stocks', $new_unit_in_stocks)
					->set('unit_in_sales', $new_unit_in_sales)
					->where('name', $name)
					->update('ci_products');
				return TRUE;
			}
		}
	}

	/**
	 * Clear invoice previous history
	 *
	 * @param string $chash
	 */
	public function clear_invoice_history($chash) {
		$this->db->set('cash_receive', 0.00)
			->set('cash_exchange', 0.00)
			->where('chash', $chash)
			->update('ci_invoices');
	}

	/**
	 * Update new invoice cash payment
	 *
	 * @param string $invoice_no
	 * @param array $data
	 */
	public function new_invoice_hostory($invoice_no, $data = array()) {
		$this->db->where('chash', $invoice_no)
			->update('ci_invoices', $data);
	}

	/**
	 * Discard purchase invoice
	 *
	 * @param type $id
	 * return boolean
	 */
	public function discard($id) {
		$this->db->where('idid', $id);
		return $this->db->delete('ci_invoice_details') ? TRUE : FALSE;
	}

	/**
	 * Remove invoice if no detail
	 *
	 * @param integer $iid
	 * @return bool
	 */
	public function discardCurrentInvoice($iid) {
		$this->db->where('iid', $iid);
		return $this->db->delete('ci_invoices') ? TRUE : FALSE;
	}
}
