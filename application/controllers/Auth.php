<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->database();
		$this->load->helper('auth');
	}

	public function index()
	{
		$sess = $this->session->userdata('user_id');
		if ($sess) {
			$this->db->where('id', $sess);
			$query = $this->db->get('r_user'); // Assuming your table name is 'users' 
			$userdata =  $query->row();
			// Set flash data for Swal notification 
			$this->session->set_flashdata('login_success', 'Anda Sudah login - Sdr. ' . $userdata->username);
			// Redirect to the dashboard if the user is already logged in 
			redirect('home');
		} else {

			$this->load->view('public/login');
		} // Load the login view
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->M_user->get_user_by_username($username);

		if ($user) {
			if (password_verify($password, $user->password)) {
				if ($user->status === 'Approved') {
					// Set session data
					$this->session->set_userdata('user_id', $user->id);
					$this->session->set_userdata('username', $user->username);
					$this->session->set_userdata('user_level', $user->id_level);
					// Include user level in session
					// Redirect based on user level 
					// Redirect based on user level 
					switch ($user->id_level) {
						case 1:
							$redirect_url = 'berita/ordal';
							break;
						case 2:
							$redirect_url = 'berita/ordal';
							break;
						case 3:
							$redirect_url = 'berita/ordal';
							break;
						default:
							$redirect_url = 'user';
							break;
					}
					echo json_encode(array('status' => 'success', 'redirect_url' => site_url($redirect_url)));
				} else {
					echo json_encode(array('status' => 'not_approved'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Invalid password'));
			}
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'User not found'));
		}
	}

	public function logout()
	{
		// Destroy the session 
		$this->session->sess_destroy();
		// Redirect to the login page 
		redirect('login');
	}
}
