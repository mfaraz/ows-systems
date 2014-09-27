<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Settings extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Settings';
	}

	public function index() {
		$this->_data['settings'] = $this->msettings->select_setting();
		$this->load->view('index', $this->_data);
	}

	/**
	 * Save settings
	 */
	public function save_default() {
		$filename = '';
		if ($_FILES['DEFAULT_COMPANY_LOGO']['name']) {
			$filename = $this->save_logo();
		}
		if ($this->msettings->save_default($filename)) {
			$this->session->set_flashdata('message', alert_message("Company settings has been saved!", 'success'));
		} else {
			$this->session->set_flashdata('message', alert_message("Company settings cannot be saved, some error occured!", 'danger'));
		}
		redirect('settings/');
	}

	/**
	 * Save logo
	 */
	public function save_logo() {
		$config['upload_path'] = IMG_PATH;
		$config['max_size'] = 50000000; //kb
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['file_name'] = 'logo';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('DEFAULT_COMPANY_LOGO')) {
			unset($config);
			$filename = $this->upload->data();
			$originW = $filename['image_width'];
			$originH = $filename['image_height'];
			$config['image_library'] = 'gd2';
			$config['source_image'] = IMG_PATH . $filename['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['new_image'] = IMG_PATH . $filename['file_name'];
			$this->load->library('image_lib', $config);

			$newW = $originW;
			$newH = $originH;
			if ($originW > 560) {
				$newW = 560;
				$newH = round(($newW * $originH) / $originW);
			}
			$config['width'] = $newW;
			$config['height'] = $newH;
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			return $filename['file_name'];
		}
		return FALSE;
	}

}

/* End of file home.php */
/* Location: ./application/controllers/settings.php */
