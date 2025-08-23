<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('upload_image')) {
	function upload_image($title, $upload_path, $field_name)
	{
		$CI = &get_instance();

		// Check if the folder exists, if not create it
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0755, true);
		}
		if (!is_writable($upload_path)) {
			log_message('error', 'Upload path not writable: ' . $upload_path);
		}


		$tgl = date('Y-m-d');
		$title = strtolower(preg_replace("/[^a-zA-Z0-9]+/", '_', $title));
		$config['upload_path'] = $upload_path; // Use the custom path
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 3000; // 3 MB
		$config['file_name'] = $tgl . "_" . $title;


		$CI->load->library('upload', $config);
		$CI->upload->initialize($config);

		if (!$CI->upload->do_upload($field_name)) {
			log_message('error', $CI->upload->display_errors());
			return '';
		} else {
			$arr_image = array('upload_data' => $CI->upload->data());
			return $arr_image['upload_data']['file_name'];
		}
	}
}
