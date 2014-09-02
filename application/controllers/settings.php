<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Settings extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Settings';
		$this->load->model(array('msettings'));
	}

	public function index() {
		$this->_data['settings'] = $this->msettings->select_setting();
		$this->load->view('index', $this->_data);
	}

	public function save_default() {
		if ($this->msettings->save_default()) {
			$this->session->set_flashdata('message', alert_message("Company has been saved!", 'success'));
			redirect('settings/');
		}
	}

}

/* End of file home.php */
/* Location: ./application/controllers/settings.php */
