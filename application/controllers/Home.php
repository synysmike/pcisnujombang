<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends My_Controller
{
	public $data         = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_home');
	}
	public function login()
	{
		$sess = $this->session->userdata('user_id');
		if ($sess) {
			$this->db->where('id', $sess);
			$query = $this->db->get('r_user'); // Assuming your table name is 'users' 
			$userdata =  $query->row();
			// Set flash data for Swal notification 
			$this->session->set_flashdata('login_success', 'Anda Sudah login - Sdr. ' . $userdata->username);
			// Redirect to the dashboard if the user is already logged in 
			redirect('home');
		} else {

			$this->load->view('public/login');
		}
	}
	
	public function index()
	{
		$this->data['css'] = 'public/home/css-req';
		$this->data['js'] = 'public/home/js-req';
		$this->data['page'] = 'public/home';
		$this->data['mobile_menu'] = 'public/mobile_menu';
		$this->data['hero'] = 'public/home/hero';
		$this->data['about'] = 'public/home/about';
		$this->data['blog'] = 'public/home/blog';
		$this->data['brand'] = 'public/home/brand';
		$this->data['cta1'] = 'public/home/cta1';
		$this->data['cta2'] = 'public/home/cta2';
		$this->data['service'] = 'public/home/service';
		$this->data['faq'] = 'public/home/faq';
		$this->data['donation'] = 'public/home/donation';
		$this->data['project'] = 'public/home/project';
		$this->data['story'] = 'public/home/story';
		$this->data['team'] = 'public/home/team';
		$this->data['testimoni'] = 'public/home/testi';
		$this->data['video'] = 'public/home/video';
		$this->data['header'] = 'public/header';
		$this->data['footer'] = 'public/footer';
		// $this->data[''] = 'public/home/';
		$this->load->view('public/main', $this->data);
	}
	public function ordal()
	{
		$this->check_user_level([2, 3, 4]);
		$this->data['js'] = 'admin/home/js-req';
		$this->data['css'] = 'admin/home/css-req';
		$this->data['ct'] = 'admin/home/home';
		// $this->data['js'] =  $this->load->view('admin/home/js-req');
		$this->load->view('admin/main', $this->data);
	}

	function get_all_berita()
	{
		$data = $this->M_home->get_berita();
		echo json_encode($data);
	}

	
	public function get_berita()
	{
		$this->load->model("M_home");
		$id = $this->input->post('id');
		$data["results"] = $this->M_home->get_berita_by_id($id);
		echo json_encode($data["results"]);
	}



	function simpan_berita()
	{
		$data = $this->input->post();
		// echo json_encode($data);
		$id = $this->input->post('id');

		if ($id) {
			// Perform soft delete on the existing record
			$this->M_home->delTemp_berita($id);

			// Check if a new file is uploaded
			if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {
				$data['gambar'] = $this->upload_image($this->input->post('judul'));
			} else {
				// Retain the existing image
				$existing_record = $this->M_home->get_berita_by_id($id);
				$data['gambar'] = $existing_record->gambar;
			}
			// Create a new record with the updated values
			unset($data['id']); // Remove the id from the data array
			$result = $this->M_home->simpan_berita($data);
		} else {
			// Check if a new file is uploaded
			if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "") {
				$data['gambar'] = $this->upload_image($this->input->post('judul'));
				// echo json_encode($data);
			} 
			$result = $this->M_home->simpan_berita($data);
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
		$data = $this->M_home->hapus_berita($id);
		echo json_encode($data);
	}
	function delTemp_berita()
	{
		$id = $this->input->post('id');
		$data = $this->M_home->delTemp_berita($id);
		echo json_encode($data);
		
	}
	
}
