<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends MY_Controller
{
	public $data         = array();
	public function __construct()
	{

		parent::__construct();
		$this->load->model('M_anggota');
		$this->load->model('M_jabatan');
		$this->load->model('M_user');
		$this->load->helper('upload');
	}

	public function get_struktur()
	{
		$query = $this->db->select('a.*, u.username, b.nama, j.name as position_name, a.id_jabatan')
			->from('m_anggota a')
			->join('r_user u', 'a.id_user = u.id')
			->join('r_bio b', 'u.id_bio = b.id')
			->join('m_jabatan j', 'a.id_jabatan = j.id')
			->where('a.soft_deletes IS NULL')
			->order_by('a.id_jabatan ASC, j.name ASC, b.nama ASC')
			->get();

		$raw = $query->result_array();
		$struktur = [];

		foreach ($raw as $row) {
			$level = $row['id_jabatan'];
			$role = $row['position_name'];
			$name = $row['nama'];

			$struktur[$level][$role][] = $name;
		}
		$this->data['css'] = 'public/home/css-req';
		$this->data['js'] = 'public/home/js-req';
		$this->data['js_func'] = 'public/isi_berita/jsfunc';
		$this->data['page'] = 'public/struktur_view';
		$this->data['mobile_menu'] = 'public/mobile_menu';
		$this->data['header'] = 'public/header';
		$this->data['footer'] = 'public/footer';
		$this->data['struktur'] = $struktur;
		$this->load->view('public/main', $this->data);
		// $this->load->view('public/struktur_view', $data);
	}


	// Display all anggota
	public function index()
	{
		$this->check_user_level([3, 4]);
		$this->data['js'] = 'admin/anggota/js-req';
		$this->data['css'] = 'admin/anggota/css-req';
		$this->data['ct'] = 'admin/anggota/index';
		$this->load->view('admin/main', $this->data);
	}

	// Fetch all anggota for AJAX request
	public function fetch_all()
	{
		$anggota = $this->M_anggota->get_all_anggota();
		echo json_encode([
			'draw' => intval($this->input->get('draw')),
			'recordsTotal' => count($anggota),
			'recordsFiltered' => count($anggota),
			'data' => $anggota
		]);
	}

	// Add a new anggota
	public function add()
	{
		if ($this->input->post()) {
			$data = array(
				'id_user' => $this->input->post('user_id'),
				'id_jabatan' => $this->input->post('position_id'),
				'membership_date' => $this->input->post('membership_date'),
				'status' => $this->input->post('status')
			);
			$this->M_anggota->insert_anggota($data);
			echo json_encode(array('status' => 'success'));
		} else {
			$data['positions'] = $this->M_jabatan->get_all_positions();
			$data['users'] = $this->M_user->get_all_users();
			$this->load->view('anggota/add', $data);
		}
	}
	// Get anggota by ID for AJAX request 
	public function get_anggota_by_id($id)
	{
		$anggota = $this->M_anggota->get_anggota_by_id($id);
		echo json_encode($anggota);
	}
	// Edit an existing anggota
	public function edit($id)
	{
		if ($this->input->post()) {
			$data = array(
				'position_id' => $this->input->post('position_id'),
				'membership_date' => $this->input->post('membership_date'),
				'status' => $this->input->post('status')
			);
			$this->M_anggota->update_anggota($id, $data);
			echo json_encode(array('status' => 'success'));
		} else {
			$data['anggota'] = $this->M_anggota->get_anggota_by_id($id);
			$data['positions'] = $this->M_jabatan->get_all_positions();
			$this->load->view('anggota/edit', $data);
		}
	}

	// Soft delete an anggota
	public function delete($id)
	{
		$this->M_anggota->delete_anggota($id);
		echo json_encode(array('status' => 'success'));
	}
}
