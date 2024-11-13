<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{


	public function index()
	{
		$this->load->view('public/berita');
	}



	public function ordal()
	{
		$this->data['css'] = $this->load->view('admin/home/css-req');
		$this->data['js'] =  $this->load->view('admin/home/js-req');
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/home/home');
		$this->load->view('admin/footer');
	}
}
