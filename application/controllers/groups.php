<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Groups extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'User Management';
		$this->load->model(array('mroles'));
	}

}
