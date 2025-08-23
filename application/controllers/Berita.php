<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_berita');
		$this->load->helper('upload');
	}

	// pyblic berita
	public function index()
	{
		$this->load->view('public/berita');
	}

	// admin berita
	public function ordal()
	{
		$this->check_user_level([2, 3, 4]);
		$this->data['js'] = 'admin/berita/js-req';
		$this->data['css'] = 'admin/berita/css-req';
		$this->data['ct'] = 'admin/berita/home';
		// $this->data['js'] =  $this->load->view('admin/berita/js-req');
		$this->load->view('admin/main', $this->data);
	}

	// get all berita
	function get_all_berita()
	{
		$data = $this->M_berita->get_berita();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK));
	}
	function get_berita()
	{
		$id = $this->input->post('id');
		$data = $this->M_berita->get_berita_by_id($id);
		if ($data) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data[0], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK));
		} else {
			show_404();
		}
	}


	//get berita by id
	function simpan_berita()
	{
		$data = $this->input->post();
		$id = $this->input->post('id');
		$custom_path = './assets/images/berita/';

		// Handle image upload
		if (!empty($_FILES["file"]["name"])) {
			$data['gambar'] = upload_image($data['judul'], $custom_path, 'file');
		} elseif ($id) {
			// Retain existing image if editing and no new file uploaded
			$existing = $this->M_berita->get_berita_by_id($id);
			$data['gambar'] = !empty($existing[0]->gambar) ? $existing[0]->gambar : null;
		}

		// Save or update
		$result = $id
			? $this->M_berita->update_berita($id, $data)
			: $this->M_berita->simpan_berita($data);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['success' => $result]));
	}





	// delete berita
	public function delete_berita()
	{
		$id = $this->input->post('id'); // Get the id from the POST data

		// Ensure $id is valid
		if ($id) {
			// Perform delete operation
			$result = $this->_delete_berita_by_id($id);
			// Send response
			if ($result) {
				echo json_encode(['success' => true]);
			} else {
				echo json_encode(['success' => false]);
			}
		} else {
			echo json_encode(['success' => false]);
		}
	}

	// Private method to handle the actual deletion logic
	private function _delete_berita_by_id($id)
	{
		// Perform delete operation
		return $this->M_berita->delTemp_berita($id);
	}
}
