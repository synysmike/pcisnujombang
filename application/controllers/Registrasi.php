<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->database();
		$this->load->helper('auth'); // Load the auth helper
		$this->load->helper('upload');
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
}
