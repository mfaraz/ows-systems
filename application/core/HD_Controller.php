<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of HD_Controller
 *
 * @author manmath
 */
class HD_Controller extends CI_Controller {

	protected $_data = array();
	var $CI;

	public function __construct() {
		parent::__construct();
		$this->CI = & get_instance();
		$this->createConstants();
		if (!$this->CI->session->userdata('ci_username')) {
			redirect('login/');
		}
	}

	/**
	 * Create default constants
	 */
	function createConstants () {
		$this->load->model('msettings');
		$constants = $this->msettings->select_setting();
		if ($constants->num_rows() > 0) {
			$constants->result_array();
			$constant = $constants->result_array[0];
			define('COMPANY_NAME', $constant['DEFAULT_COMPANY_NAME']);
			define('COMPANY_ADDRESS', $constant['DEFAULT_COMPANY_ADDRESS']);
			define('COMPANY_PHONE', $constant['DEFAULT_COMPANY_PHONE']);
			define('USD_TO_KH', $constant['DEFAULT_USD_TO_KH']);
			define('DEFAULT_PASSWORD', $constant['DEFAULT_PASSWORD']);
			define('COMPANY_EMAIL', $constant['DEFAULT_COMPANY_EMAIL']);
		}
	}

	/**
	 * Validation unique field
	 *
	 * @param string $str field to validate
	 * @access public
	 * @return boolean
	 */
	function uniqueExcept($str, $table_field) {
		// $f1[0] : table name
		// $f1[1] : field to insert
		// $tf[1] : field id
		$tf = explode(',', $table_field);
		$f1 = explode('.', $tf[0]);
		$this->db->where($f1[1], $str);
		$this->db->where(trim($tf[1]) . '` !=', $this->uri->segment(3));
		$data = $this->db->get($f1[0]);
		if ($data->num_rows() > 0) {
			$this->form_validation->set_message('uniqueExcept', '<strong>' . $str . '</strong> already exist, please enter another one!');
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file HD_Controller.php */
/* Location: ./application/core/HD_Controller.php */
