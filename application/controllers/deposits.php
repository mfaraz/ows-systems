<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Deposits extends HD_Controller {
	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Deposit Management';
		$this->load->model(array('mdeposits'));
	}

	public function index () {
		$this->form_validation->set_rules('invoice_number', '', 'trim|min_length[1]|max_length[12]');
		$this->form_validation->run();
		$this->_data['deposits'] = $this->mdeposits->select_deposit();
		$this->load->view('index', $this->_data);
	}

	public function edit_deposit () {
		if ($this->mdeposits->edit_deposit()) {
			$this->session->set_flashdata('message', alert_message("New complete payment has been updated!",
				'success'));
			redirect('deposits/');
		}
	}
} 
