<?php defined('BASEPATH') or exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	protected function check_user_level($allowed_levels)
	{
		$user_level = $this->session->userdata('user_level');
		if (!in_array($user_level, $allowed_levels)) {
			redirect('login');
			// ok
		}
	}
}
