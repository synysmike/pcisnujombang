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


	
	public function index()
	{
		$this->load->view('public/berita');
	}



	public function ordal()
	{
		$this->check_user_level([2, 3, 4]);
		$this->data['js'] = 'admin/berita/js-req';
		$this->data['css'] = 'admin/berita/css-req';
		$this->data['ct'] = 'admin/berita/home';
		// $this->data['js'] =  $this->load->view('admin/berita/js-req');
		$this->load->view('admin/main', $this->data);
	}

	function get_all_berita()
	{
		$data = $this->M_berita->get_berita();
		header('Content-Type: application/json');
		echo json_encode($data);
	}


	public function get_berita()
	{
		$this->load->model("M_berita");
		$id = $this->input->post('id');
		$data["results"] = $this->M_berita->get_berita_by_id($id);
		echo json_encode($data["results"]);
	}

	function simpan_berita()
	{
		$data = $this->input->post();
		$id = $this->input->post('id');
		$custom_path = './assets/images/berita/';

		if ($id) {
			// Perform soft delete
			$this->_delete_berita_by_id($id);
			// Check if a new file is uploaded, if not retain existing image
			if (!isset($_FILES["file"]["name"]) || $_FILES["file"]["name"] == "") {
				$existing_record = $this->M_berita->get_berita_by_id($id);
				$data['gambar'] = $existing_record->gambar;
			}
			// Remove the id from the data array before creating a new record
			unset($data['id']);
		} else {
			// Check if a new file is uploaded
			if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {
				$data['gambar'] = upload_image($this->input->post('judul'), $custom_path);
			}
		}
		// Create a new record with the updated values or new data
		$result = $this->create_berita($data, $custom_path);
		echo json_encode(['success' => $result]);
	}


	function create_berita($data, $custom_path)
	{
		if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {
			$data['gambar'] = upload_image($data['judul'], $custom_path);
		}
		return $this->M_berita->simpan_berita($data);
	}



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
