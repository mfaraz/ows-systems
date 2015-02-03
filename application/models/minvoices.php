<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of Minvoices
 *
 * @author manmath
 */
class Minvoices extends CI_Model {

	/**
	 * Retreive all invoice records
	 *
	 * @param type $num_row
	 * @param type $from_row
	 * @return array
	 */
	public function findAllInvoices($num_row, $from_row) {
		if ($this->musers->has_login('sess_id') != 1) {
			$this->db->where('i.cruser', $this->musers->has_login('sess_id'));
		}
		if ($this->input->post('invoice_number') != '') {
			$this->db->like('i.invoice_number', $this->input->post('invoice_number'));
		}
		if ($this->input->post('customer') != '') {
			$this->db->like('i.customer', $this->input->post('customer'));
		}
		$this->db->select(array('CONCAT(u.firstname," ", u.lastname) AS cashier', 'i.*'));
		$this->db->from('ci_invoices i')
			->join('ci_users u', 'u.uid = i.cruser')
			->where('i.status', 1)
			->order_by('i.invoice_number', 'DESC')
			->limit($num_row, $from_row);
		return $this->db->get();
	}

	/**
	 * Count all invoice records
	 * @return integer
	 */
	public function countAllInvoices() {
		if ($this->musers->has_login('sess_id') != 1) {
			$this->db->where('cruser', $this->musers->has_login('sess_id'));
		}
		$data = $this->db->where('status', 1)
			->get('ci_invoices');
		return $data->num_rows() > 0 ? (int) $data->num_rows() : FALSE;
	}

	/**
	 * Count all invoice records
	 * @return integer
	 */
	public function countAllInvoicesDeposit() {
		$data = $this->db->where('status', 1)
			->where('deposit <>', '0.00')
			->where('balance <>', '0.00')
			->group_by('iid')
			->get('ci_invoices');
		return $data->num_rows();
	}

	/**
	 * View invoice detail list
	 *
	 * @param string $invoice_number
	 */
	public function view($invoice_number) {
		$fields = array(
			'I.iid AS invoice_id',
			'I.invoice_number AS invoice_number',
			'I.customer AS customer',
			'I.total AS total',
			'I.discount AS discount',
			'I.grand_total AS grand_total',
			'I.deposit AS deposit',
			'I.balance AS balance',
			'I.crdate AS crdate',
			'D.name AS product_name',
			'D.qty AS quality',
			'D.unit_price AS unit_price',
			'D.sub_total AS sub_total'

		);
		$this->db->select($fields)
			->from('ci_invoices I')
			->join('ci_invoice_details D', 'D.iid = I.iid')
			->where('I.invoice_number', $invoice_number);
		return $this->db->get();
	}
}

/* End of file minvoices.php */
/* Location: ./application/models/minvoices.php */
