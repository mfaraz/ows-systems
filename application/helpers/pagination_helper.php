<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists("page_browser")) {

	function page_browser($base_url, $total_rows, $per_page) {
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_open'] = '<li>';

		$config['last_tag_open'] = '<li>';
		$config['last_tag_open'] = '<li>';

		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$CI = & get_instance();
		$CI->load->library('pagination');
		$CI->pagination->initialize($config);
	}

}
?>