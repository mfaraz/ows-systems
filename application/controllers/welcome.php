<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Welcome extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Welcome';
	}

	public function index() {
		$this->load->view('index', $this->_data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
