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
		$this->load->view('public/home');
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
		$judul = $this->input->post('judul');
		$isi = $this->input->post('isi');
		$kat = $this->input->post('kat');
		$data = $this->m_home->simpan_berita($judul, $isi, $kat);
		echo json_encode($data);
	}
	function hapus_berita()
	{
		$id = $this->input->post('id');
		$data = $this->m_home->hapus_berita($id);
		echo json_encode($data);
	}
	
}
