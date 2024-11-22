<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public $data         = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_home');
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
		$this->data['js'] = 'admin/home/js-req';
		$this->data['css'] = 'admin/home/css-req';
		$this->data['ct'] = 'admin/home/home';
		// $this->data['js'] =  $this->load->view('admin/home/js-req');
		$this->load->view('admin/main', $this->data);
	}

	function get_berita()
	{
		$data = $this->m_home->get_berita();
		echo json_encode($data);
	}
	
	function simpan_berita()
	{



		if (isset($_FILES["file"]["name"])) {
			$tgl = date('Y-m-d');
			$judul = $this->input->post('judul');
			preg_replace("/[^A-Za-z0-9 ]/", '_', $judul);
			$config['upload_path'] = "./assets/images";
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 1000;
			$config['file_name'] = $tgl . "_" . $judul;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('file')) {
				echo $this->upload->display_errors();
			} else {
				$arr_image = array('upload_data' => $this->upload->data());
				$image = $arr_image['upload_data']['file_name'];
				$judul = $this->input->post('judul');
				$isi = $this->input->post('isiBerita');
				$kat = $this->input->post('kategori');
				$result = $this->m_home->simpan_berita($judul, $isi, $kat, $image);
				echo json_encode($result);
				// echo '<img src="' . base_url() . 'upload/' . $data["file_name"] . '" width="300" height="225" class="img-thumbnail" />';
			}
		} 
		// var_dump($_FILES);
		// $config['upload_path'] = "./assets/images";
		// $config['allowed_types'] = 'gif|jpg|png';
		// $config['encrypt_name'] = TRUE;
		// $this->load->library('upload', $config);
		// if ($this->simpan_berita('file')) {
		// 	$data = array('upload_data' => $this->simpan_berita->data());
		// 	$image = $data['upload_data']['file_name'];
		// 	var_dump($image);
			// $judul = $this->input->post('judul');
			// $isi = $this->input->post('isiBerita');
			// $kat = $this->input->post('kategori');
			// $result = $this->m_home->simpan_berita($judul, $isi, $kat, $image);
			// echo json_encode($result);
		// }
	}


	function hapus_berita()
	{
		$id = $this->input->post('id');
		$data = $this->m_home->hapus_berita($id);
		echo json_encode($data);
		
	}
	
}
