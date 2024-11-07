<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function ordal()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/home');
		$this->load->view('admin/footer');
	}
}
