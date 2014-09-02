<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Mdeposits extends CI_Model {

	private $_data = array();

	/**
	 * Retrieve all deposits
	 *
	 * @return mixed
	 */
	public function select_deposit() {
		if ($this->input->post('invoice_number')) {
			$this->db->like('i.invoice_number', $this->input->post('invoice_number'));
		}
		return $this->db->select(array('i.iid', 'i.invoice_number', 'i.chash', 'i.customer_phone', 'i.cash_type', 'i.grand_total',
					'i.deposit', 'i.balance', 'i.crdate', 'u.firstname'))
				->from('ci_invoices i')
				->join('ci_users u', 'u.uid = i.cruser')
				->where('i.deposit !=', '0.00')
				->get()->result();
	}

	/**
	 * Clear deposit after completed payment
	 * 
	 * @param string $invoice_no
	 * @return boolean
	 */
	public function clear_deposit($invoice_no) {
		$this->db->set('deposit', '0.00');
		$this->db->set('balance', '0.00');
		$this->db->where('invoice_number', $invoice_no);
		return $this->db->update('ci_invoices') ? TRUE : FALSE;
	}

}
