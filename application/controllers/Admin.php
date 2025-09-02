<?php
// application/controllers/Admin.php
class Admin extends CI_Controller
{
	public function index()
	{
		phpinfo();
		// // Check session or role
		// if (!$this->session->userdata('is_admin')) {
		// 	show_404();
		// }
		// $this->load->view('admin/dashboard');
	}
}
