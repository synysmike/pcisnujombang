<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;


class Registrasi extends CI_Controller
{
	public function test_upload_path()
	{
		$path = FCPATH . 'assets/uploads';
		echo 'Upload path: ' . $path . '<br>';
		echo 'is_dir: ' . (is_dir($path) ? 'yes' : 'no') . '<br>';
		echo 'is_writable: ' . (is_writable($path) ? 'yes' : 'no') . '<br>';
		echo 'realpath: ' . realpath($path) . '<br>';
	}

	public function import_excel()
	{
		$config['upload_path']   = FCPATH . 'assets/uploads';
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['max_size']      = 2048;

		$this->load->library('upload');
		$this->upload->initialize($config, true);

		if (!$this->upload->do_upload('excelFile')) {
			log_message('error', 'Upload failed: ' . $this->upload->display_errors());
			echo $this->upload->display_errors();
			return;
		}

		$uploadData = $this->upload->data();
		$inputFileName = $uploadData['full_path'];

		try {
			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();

			$header = array_map('strtolower', array_map('trim', $sheetData[0])); // Normalize headers
			unset($sheetData[0]); // Remove header row

			foreach ($sheetData as $row) {
				$data = array_combine($header, $row);

				if (empty($data['username']) || empty($data['password']) || empty($data['nama_lengkap'])) {
					continue; // Skip incomplete rows
				}

				// Step 1: Insert into r_bio
				$bio_data = array(
					'nama' => $data['nama_lengkap']
				);

				$this->db->insert('r_bio', $bio_data);
				$id_bio = $this->db->insert_id();

				// Step 2: Insert into r_user with id_bio
				$user_data = array(
					'username' => $data['username'],
					'password' => password_hash($data['password'], PASSWORD_BCRYPT),
					'id_level' => 1,
					'status'   => 'Pending',
					'id_bio'   => $id_bio // <-- this is the fix
				);

				$this->db->insert('r_user', $user_data);
			}

			echo "Import successful!";
		} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
			echo 'Error loading file: ' . $e->getMessage();
		}
	}

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

	public function import_page()
	{


		$this->data['js'] = 'admin/user/js-req';
		$this->data['css'] = 'admin/user/css-req';
		$this->data['ct'] = 'admin/user/batch_excel';
		$this->load->view('admin/main', $this->data);
	}
}
