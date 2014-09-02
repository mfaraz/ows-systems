<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Form Role
 *
 * Return the dropdown list of user role items
 *
 * @access	public
 * @return	string
 */
if (!function_exists('form_select')) {

	function form_select($name, $items, $table, $selected = 0) {
		$id = '';
		switch ($table) {
			case 'category':
				$id = 'cid';
				break;
			case 'role':
				$id = 'rid';
				break;
			case 'product':
				$id = 'pid';
				break;
		}
		$option = array();
		foreach ($items as $item) {
			$option[$item->$id] = ucfirst($item->name);
		}
		return form_dropdown($name, $option, $selected, 'id="' . $name . '" class="form-control input-sm"');
	}

}

/**
 * Form Sex
 *
 * Return the dropdown list for sex Male and Female
 *
 * @access	public
 * @return	string
 */
if (!function_exists('form_sex')) {

	function form_sex($selected = '') {
		$option = array(
			'0' => 'Male',
			'1' => 'Female'
		);
		return form_dropdown('sex', $option, $selected, 'class="form-control input-sm"');
	}

}

/**
 * Form Button Submit
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if (!function_exists('form_button_submit')) {

	function form_button_submit($data = '', $content = '', $value = '', $extra = '') {
		$defaults = array('name' => ((!is_array($data)) ? $data : ''), 'value' => ((!is_array($value)) ? $value : 'Save'), 'type' => 'submit');

		if (is_array($data) AND isset($data['content'])) {
			$content = $data['content'];
			unset($data['content']); // content is not an attribute
		}

		return "<button " . _parse_form_attributes($data, $defaults) . $extra . ">" . $content . "</button>";
	}

}

/**
 * Form Toolbar
 *
 * Return the toolbar for form action with save, add, edit, delete, cancel button submit
 *
 * @access	public
 * @return	string
 */
if (!function_exists('form_toolbar')) {

	function form_toolbar() {
		$CI = & get_instance();
		$_controller = $CI->uri->segment(1);
		$_method = $CI->uri->segment(2);

		$toolbar = '<div class="btn-toolbar" role="toolbar">';
		if (!$_method):
			$toolbar .= anchor($_controller . '/add/', '<span class="glyphicon glyphicon-plus-sign"></span> Create', 'class="btn btn-sm btn-success" title=""');
		else:
			switch ($_method):
				case 'edit':
				default:
					$toolbar .= anchor($_controller, '<span class="glyphicon glyphicon-arrow-left"></span> Back', 'class="btn btn-sm btn-danger" title=""')
						. '<button type="submit" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>'
						. '<button type="reset" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-ban-circle"></span> Reset</button>';
					break;
			endswitch;
		endif;
		$toolbar .= '</div>';

		return $toolbar;
	}

}

/**
 * Form is error
 *
 * Return the html class property name
 *
 * @access	public
 * @return	string
 */
if (!function_exists('form_is_error')) {

	function form_is_error($field) {
		if (FALSE === ($OBJ = & _get_validation_object())) {
			return '';
		}

		return $OBJ->error_css_class($field);
	}

}

/**
 * StyleSheet
 *
 * Load all Cascading stylesheet files
 *
 * @access	public
 * @return	string
 */
if (!function_exists('stylesheets')) {

	function stylesheets() {
		$links = '';

		$links .= link_tag(CSS_PATH . 'bootstrap.min.css', 'all') . "\r\n";
		$links .= link_tag(CSS_PATH . 'font-awesome.min.css', 'all') . "\r\n";
		$links .= link_tag(CSS_PATH . 'datepicker.css', 'all') . "\r\n";
		$links .= link_tag(CSS_PATH . 'jquery-ui.min.css', 'all') . "\r\n";
		$links .= link_tag(CSS_PATH . 'custom.min.css', 'all') . "\r\n";
		$links .= '<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="' . JS_PATH . 'html5shiv.js"></script>
	<script src="' . JS_PATH . 'respond.min.js"></script>
<![endif]-->' . "\r\n";

		return $links;
	}

}

/**
 * JavaScript
 *
 * Load all javascript files
 *
 * @access	public
 * @return	string
 */
if (!function_exists('javascripts')) {

	function javascripts() {
		$scripts = '';

		$scripts .= script_tag(JS_PATH . 'jquery.js') . "\r\n";
		$scripts .= script_tag(JS_PATH . 'bootstrap.min.js') . "\r\n";
		$scripts .= script_tag(JS_PATH . 'bootstrap-datepicker.js') . "\r\n";
		$scripts .= script_tag(JS_PATH . 'jquery-ui.min.js') . "\r\n";
		$scripts .= script_tag(JS_PATH . 'custom.min.js') . "\r\n";

		return $scripts;
	}

}

/**
 * Script
 *
 * Generates script to a CSS file
 *
 * @access	public
 * @param	mixed	script srcs or an array
 * @param	string	type
 * @param	string	language
 * @param	boolean	should index_page be added to the css path
 * @return	string
 */
if (!function_exists('script_tag')) {

	function script_tag($src = '', $type = 'text/javascript', $language = '', $index_page = FALSE) {
		$CI = & get_instance();

		$script = '<script ';

		if (is_array($src)) {
			foreach ($src as $k => $v) {
				if ($k == 'src' AND strpos($v, '://') === FALSE) {
					if ($index_page === TRUE) {
						$script .= 'src="' . $CI->config->site_url($v) . '"';
					} else {
						$script .= 'src="' . $CI->config->slash_item('base_url') . $v . '"';
					}
				} else {
					$script .= "$k=\"$v\"";
				}
			}

			$script .= "></script>";
		} else {
			if (strpos($src, '://') !== FALSE) {
				$script .= 'src="' . $src . '" ';
			} elseif ($index_page === TRUE) {
				$script .= 'src="' . $CI->config->site_url($src) . '" ';
			} else {
				$script .= 'src="' . $CI->config->slash_item('base_url') . $src . '" ';
			}

			$script .= 'type="' . $type . '"';

			if ($language != '') {
				$script .= ' language="' . $language . '"';
			}

			$script .= '></script>';
		}

		return $script;
	}

}

/**
 * Site Title
 *
 * Generates title tag and value
 *
 * @access	public
 * @return	string
 */
if (!function_exists('site_title')) {

	function site_title($title = '') {
		if (isset($title) && $title != '') {
			return '<title>' . $title . ' - ' . PROJECT_NAME . '</title>';
		}
		return '<title> Welcome - ' . PROJECT_NAME . '</title>';
	}

}

if (!function_exists('alert_message')) {

	function alert_message($message = NULL, $type = 'success') {
		$icon = ($type == 'success') ? 'ok-circle' : (($type == 'danger') ? 'remove-circle' : (($type == 'info') ? 'info-sign' : (($type == 'warning') ? 'ban-circle' : 'ban-circle')));
		return '<div class="hidden-print alert alert-' . $type . ' alert-dismissable"><button type="button"
		class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="glyphicon glyphicon-' . $icon . '"></span>&nbsp;' . $message . '</div>';
	}

}
/* End of file utilities_helper.php */
/* Location: ./application/hepers/utilities_helper.php */
