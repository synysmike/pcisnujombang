<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{


	public function index()
	{
		$this->data['css'] = "/public/register/css-req";
		$this->data['js'] = "/public/register/js-req";
		$this->data['page'] = "/public/register/index";
		$this->load->view('public/main', $this->data);
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
