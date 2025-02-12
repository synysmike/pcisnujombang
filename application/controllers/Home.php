<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends My_Controller
{
	public $data         = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_home');
		$this->load->model('M_carousel');
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
		$this->data['css'] = 'admin/home/css-req';
		$this->data['js'] = 'admin/home/js-req';
		$this->data['ct'] = 'admin/home/home';
		$this->data['carousels'] = $this->M_carousel->get_all();
		// $this->data['js'] =  $this->load->view('admin/berita/js-req');
		$this->load->view('admin/main', $this->data);
	}

	public function set_config()
	{
		$this->M_home->get_config();
	}

	public function get_config($id)
	{
		$config = $this->M_home->get_config_by_id($id);
		echo json_encode($config);
	}
	public function get_all_config()
	{
		$configs = $this->M_home->get_config();
		echo json_encode($configs);
	}

	public function create()
	{
		$section = $this->input->post('section');
		$carousel = $this->input->post('carousel');

		$data = array(
			'config_profile_name' => $this->input->post('nama_config'),
			'alamat' => $this->input->post('alamat'),
			'kontak' => $this->input->post('kontak'),
			'email' => $this->input->post('email'),
			'date_of_creation' => date('Y-m-d H:i:s'),
			'array_of_id_section' => is_array($section) ? implode(',', $section) : $section, // Convert array to comma-separated string
			'array_of_id_carousel' => is_array($carousel) ? implode(',', $carousel) : $carousel, // Convert array to comma-separated string
			'color_1' => $this->input->post('color_1'),
			'color_2' => $this->input->post('color_2')
		);

		// Insert the data into the database
		$this->M_home->insert($data);

		// Return a JSON response
		echo json_encode(array('status' => 'success'));
	}

	public function edit($id)
	{
		$section = $this->input->post('section');
		$carousel = $this->input->post('carousel');

		$data = array(
			'config_profile_name' => $this->input->post('nama_config'),
			'alamat' => $this->input->post('alamat'),
			'kontak' => $this->input->post('kontak'),
			'email' => $this->input->post('email'),
			'array_of_id_section' => is_array($section) ? implode(',', $section) : $section, // Convert array to comma-separated string
			'array_of_id_carousel' => is_array($carousel) ? implode(',', $carousel) : $carousel, // Convert array to comma-separated string
			'color_1' => $this->input->post('color_1'),
			'color_2' => $this->input->post('color_2')
		);

		// Update the data in the database
		$this->M_home->update_config($id, $data);

		// Return a JSON response
		echo json_encode(array('status' => 'success'));
	}
	public function delete($id)
	{
		$this->M_home->soft_delete($id);
		echo json_encode(array('status' => 'success'));
	}

	public function read()
	{
		$this->data['records'] = $this->M_home->get_all();
		$this->load->view('admin/main', $this->data);
	}

	public function update($id)
	{
		$data = array(
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content')
		);
		$this->M_home->update($id, $data);
		redirect('home/ordal');
	}



	public function get_all_carousels()
	{
		$carousels = $this->M_carousel->get_all();
		echo json_encode(['data' => $carousels]);
	}

	public function store_carousel()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('picture')) {
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error);
		} else {
			$upload_data = $this->upload->data();
			$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'picture' => $upload_data['file_name']
			);
			$this->M_carousel->insert($data);
			echo json_encode(array('status' => 'success'));
		}
	}

	public function edit_carousel($id)
	{
		$carousel = $this->M_carousel->get($id);
		echo json_encode($carousel);
	}

	public function update_carousel($id)
	{
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description')
		);

		if (!empty($_FILES['picture']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('picture')) {
				$upload_data = $this->upload->data();
				$data['picture'] = $upload_data['file_name'];
			}
		}

		$this->M_carousel->update($id, $data);
		redirect('home/ordal');
	}

	public function delete_carousel($id)
	{
		$this->M_carousel->delete($id);
		redirect('home/ordal');
	}
	




	
	
}
