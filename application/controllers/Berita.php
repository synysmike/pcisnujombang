<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends My_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_berita');
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
		// echo json_encode($data);
		$id = $this->input->post('id');

		if ($id) {
			// Perform soft delete on the existing record
			$this->M_berita->delTemp_berita($id);

			// Check if a new file is uploaded
			if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {
				$data['gambar'] = $this->upload_image($this->input->post('judul'));
			} else {
				// Retain the existing image
				$existing_record = $this->M_berita->get_berita_by_id($id);
				$data['gambar'] = $existing_record->gambar;
			}
			// Create a new record with the updated values
			unset($data['id']); // Remove the id from the data array
			$result = $this->M_berita->simpan_berita($data);
		} else {
			// Check if a new file is uploaded
			if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {
				$data['gambar'] = $this->upload_image($this->input->post('judul'));
				// echo json_encode($data);
			}
			$result = $this->M_berita->simpan_berita($data);
		}

		echo json_encode($result);
	}

	private function upload_image($judul)
	{
		$tgl = date('Y-m-d');
		$judul = preg_replace("/[^A-Za-z0-9 ]/", '_', $judul);
		$config['upload_path'] = "./assets/images";
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 1000;
		$config['file_name'] = $tgl . "_" . $judul;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file')) {
			return '';
		} else {
			$arr_image = array('upload_data' => $this->upload->data());
			return $arr_image['upload_data']['file_name'];
		}
	}




	function hapus_berita()
	{
		$id = $this->input->post('id');
		$data = $this->M_berita->hapus_berita($id);
		echo json_encode($data);
	}
	function delTemp_berita()
	{
		$id = $this->input->post('id');
		$data = $this->M_berita->delTemp_berita($id);
		echo json_encode($data);
		
	}
}
