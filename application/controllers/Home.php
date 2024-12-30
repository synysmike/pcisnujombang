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
	public function login() {
		
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
		// $this->data['js'] =  $this->load->view('admin/berita/js-req');
		$this->load->view('admin/main', $this->data);
	}
	




	
	
}
