<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Welcome extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Welcome';
	}

	public function index() {
		redirect('sales/');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
