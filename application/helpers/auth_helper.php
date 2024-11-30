<?php defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('is_logged_in')) {
	function is_logged_in()
	{
		$CI = &get_instance();
		return $CI->session->userdata('user_id') !== null;
	}
}
if (!function_exists('check_user_level')) {
	function check_user_level($required_level)
	{
		$CI = &get_instance();
		$user_level = $CI->session->userdata('user_level');
		if ($user_level !== $required_level) {
			redirect('registrasi/login');
		}
	}
}
