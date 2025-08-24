<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galeri extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_galeri');
		$this->load->helper('upload');
	}

	public function index()
	{
		$this->check_user_level([2, 3, 4]);
		$this->data['js'] = 'admin/galeri/js-req';
		$this->data['css'] = 'admin/galeri/css-req';
		$this->data['ct'] = 'admin/galeri/index';
		$this->load->view('admin/main', $this->data);
	}

	public function get_galeri()
	{
		$galeri = $this->M_galeri->get_all_galeri();
		echo json_encode(array('data' => $galeri));
	}


	public function create()
	{
		$data = $this->input->post();
		$id = $this->input->post('id');
		$custom_path = './assets/images/galeri/';
		if ($id) {
			// Perform soft delete on the existing record
			$this->M_galeri->soft_delete_galeri($id);

			// Prepare data for the new record
			$data = array(
				'judul' => $this->input->post('judul'),
				'ket' => $this->input->post('ket'),
				'tgl' => date('Y-m-d'), // Set the current date
				'id_user' => $this->session->userdata('user_id')
			);

			// Check if a new file is uploaded
			if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {

				$data['file']  = upload_image($this->input->post('judul'), $custom_path, 'file');
			} else {
				// Retain the existing image
				$existing_record = $this->M_galeri->get_galeri_by_id($id);
				if ($existing_record) {
					$data['file'] = $existing_record->file;
				} else {
					$data['file'] = ''; // Handle case where no existing record is found
				}
			}

			// Create a new record with the updated values
			$result = $this->M_galeri->insert_galeri($data);
			echo json_encode(array('status' => 'success', 'message' => 'Galeri updated successfully', 'data' => $result));
		} else {
			// Check if a new file is uploaded
			if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {
				$data['file']  = upload_image($this->input->post('judul'), $custom_path, 'file');
			}
			$data['tgl'] = date('Y-m-d'); // Set the current date
			$data['id_user'] = $this->session->userdata('user_id'); // Get user_id from session
			$result = $this->M_galeri->insert_galeri($data);
			echo json_encode(array('status' => 'success', 'message' => 'Galeri created successfully', 'data' => $result));
		}
	}

	public function get_edit($id)
	{
		$galeri = $this->M_galeri->get_galeri_by_id($id);
		echo json_encode($galeri);
	}

	public function delete($id)
	{
		$this->M_galeri->delete_galeri($id);
		redirect('galeri');
	}
}
