<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_kategori');
		$this->load->helper('upload');
	}

	public function index()
	{
		$this->check_user_level([2, 3, 4]);
		$data['kategori'] = $this->M_kategori->get_all_kategori();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/kategori/index', $data);
		$this->load->view('admin/templates/footer');
	}

	public function get_all_kategori()
	{
		$kategori = $this->M_kategori->get_all_kategori();

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($kategori, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK));
	}



	public function get_kategori_by_id($id)
	{
		$kategori = $this->M_kategori->get_kategori_by_id($id);
		header('Content-Type: application/json');
		echo json_encode($kategori);
	}

	public function create()
	{
		$this->load->view('admin/templates/header');
		$this->load->view('admin/kategori/create');
		$this->load->view('admin/templates/footer');
	}

	public function store()
	{
		$result = $this->M_kategori->insert_kategori();
		echo json_encode($result);
	}

	public function update($id)
	{
		$this->M_kategori->update_kategori($id);
		redirect('admin/kategori');
	}

	public function delete($id)
	{
		try {
			$delkat = $this->M_kategori->soft_delete_kategori($id);
			if ($delkat) {
				echo json_encode(array('status' => 'success', 'message' => 'Data Telah Terhapus'));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Gagal menghapus data'));
			}
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()));
		}
	}
}
