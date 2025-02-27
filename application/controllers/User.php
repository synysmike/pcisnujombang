<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->helper('upload');
		$this->load->database();

	}

	public function index()
	{
		$this->check_user_level([2, 3, 4]);
		// Fetch levels from m_level table 
		$query = $this->db->get('m_level');
		$this->data['levels'] = $query->result();
		$this->data['js'] = 'admin/user/js-req';
		$this->data['css'] = 'admin/user/css-req';
		$this->data['ct'] = 'admin/user/user';
		$this->data['kab_kota'] = $this->M_user->get_kab_kota();
		$this->load->view('admin/main', $this->data);
	}
	public function get_all_users()
	{
		$data = $this->M_user->get_users();
		echo json_encode($data);
	}
	public function get_kab_kota()
	{
		$kab_kota = $this->M_user->get_kab_kota();
		echo json_encode($kab_kota);
	}
	public function save()
	{
		$user_data = array(
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'id_level' => $this->input->post('id_level'),
			// Handle id_level 
			'status' => $this->input->post('status')
			// Handle status 
		);
		$bio_data = array(
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'jk' => $this->input->post('jenis_kelamin'),
			'id_kabkot' => $this->input->post('kab_kota'),
			'alamat' => $this->input->post('alamat'),
			'ktp' => $this->input->post('ktp'),
			'strata' => $this->input->post('strata'),
			'bidang' => $this->input->post('bidang'),
			'hp' => $this->input->post('hp'),
			'kec' => $this->input->post('kec'),
			'kel' => $this->input->post('kel'),
			'rtrw' => $this->input->post('rtrw')
		);
		$user_id = $this->input->post('id');
		if ($user_id && $user_id > 0) {
			$status = $this->M_user->update_user($user_id, $user_data, $bio_data);
			// var_dump($this->input->post('id'));
			echo json_encode($this->input->post('id'));
		} else {
			// echo json_encode(['status' => 'id kosong']);
			$status = $this->M_user->insert_user($user_data, $bio_data);
		}
		if ($status) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}
	// New method to update level 
	public function update_level()
	{
		$user_id = $this->input->post('id');
		$level = $this->input->post('id_level');
		$result = $this->M_user->update_level($user_id, $level);
		if ($result) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}
	// New method to update status 
	public function update_status()
	{
		$user_id = $this->input->post('id');
		$status = $this->input->post('status');
		$result = $this->M_user->update_status($user_id, $status);
		if ($result) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}
	public function get_user($id)
	{
		$user = $this->M_user->get_user_by_id($id);
		echo json_encode($user);
	}


	public function	delete($id)
	{
		$this->M_user->delete_user($id);
		echo json_encode(['status' => 'success']);
	}
}
