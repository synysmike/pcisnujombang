<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->database();
	}

	public function get_kabkota()
	{
		$query = $this->db->get('m_kabkot');
		$kabkota = $query->result_array();
		// Ensure the result is an array 
		echo json_encode($kabkota);
	}
	
	public function index()
	{
		$this->data['header'] = 'public/header';
		$this->data['footer'] = 'public/footer';
		$this->data['mobile_menu'] = 'public/mobile_menu';
		$this->data['css'] = "/public/register/css-req";
		$this->data['js'] = "/public/register/js-req";
		$this->data['page'] = "/public/register/index";
		$this->load->view('public/main', $this->data);
	}

	public function save()
	{
		$user_data = array(
			'username' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'id_level' => 1,
			// Default level 
			'status' => 'Pending'
		);
		$bio_data = array(
			'nama' => $this->input->post('nama_lengkap'),
			'jk' => $this->input->post('jenis_kelamin'),
			'ktp' => $this->input->post('no_ktp'),
			'strata' => $this->input->post('strata_pendidikan'),
			'bidang' => $this->input->post('bidang_pendidikan'),
			'email' => $this->input->post('email'),
			'hp' => $this->input->post('nomor_hp'),
			'alamat' => $this->input->post('alamat_lengkap'),
			'id_kabkot' =>  $this->input->post('kab_kota'),
			'kec' => $this->input->post('kecamatan'),
			'kel' => $this->input->post('kelurahan'),
			'rtrw' => $this->input->post('rt_rw')
		);
		$this->M_user->insert_user($user_data, $bio_data);
		redirect('registrasi/success');
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
					$this->session->set_userdata('user_level', $user->id_level); // Include user level in session
					echo json_encode(array('status' => 'success'));
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
	

	public function ordal()
	{
		$this->data['css'] = $this->load->view('admin/home/css-req');
		$this->data['js'] =  $this->load->view('admin/home/js-req');
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/home/home');
		$this->load->view('admin/footer');
	}
}
