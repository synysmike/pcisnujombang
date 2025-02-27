
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_anggota');
		$this->load->model('M_jabatan');
		$this->load->model('M_user');
		$this->load->helper('upload');
	}

	// Display all anggota
	public function index()
	{

		$this->data['js'] = 'admin/anggota/js-req';
		$this->data['css'] = 'admin/anggota/css-req';
		$this->data['ct'] = 'admin/anggota/index';
		$this->load->view('admin/main', $this->data);
	}

	// Fetch all anggota for AJAX request
	public function fetch_all()
	{
		$anggota = $this->M_anggota->get_all_anggota();
		echo json_encode($anggota);
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
