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
		$this->load->library(array('upload'));
		$this->load->helper('upload');
		// $this->load->library('input');
	}
	public function login() {
		
	}
	public function get_section()
	{
		$sections = $this->M_home->get_section();
		echo json_encode($sections);
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

	public function apply_config($id)
	{
		$this->M_home->apply_config($id);
		echo json_encode(array('status' => 'success', 'message' => 'Configuration applied successfully'));
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


	// Section
	public function get_all_sections()
	{
		$sections = $this->M_home->get_all_sections();
		echo json_encode($sections);
	}
	public function update_section($id)
	{
		$data = array(
			'name' => $this->input->post('section_name'),
			'content' => $this->input->post('section_content'),
		);

		$this->M_home->update_section($id, $data);
		echo json_encode(array('status' => 'success', 'message' => 'Section updated successfully'));
	}
	public function store_section()
	{
		$data = array(
			'name' => $this->input->post('section_name'),
			'content' => $this->input->post('section_content'),
			'date_of_creation' => date('Y-m-d H:i:s')
		);

		$result = $this->M_home->insert_section($data);
		echo json_encode(array('status' => 'success', 'message' => 'Section created successfully', 'data' => $result));
	}


	public function edit_section($id)
	{
		$section = $this->M_home->get_section_by_id($id);
		echo json_encode($section);
	}

	public function delete_section($id)
	{
		$this->M_home->soft_delete_section($id);
		echo json_encode(array('status' => 'success'));
	}
	
	// Carousel

	public function get_all_carousels()
	{
		$carousels = $this->M_carousel->get_all();
		echo json_encode(['data' => $carousels]);
	}

	public function store_carousel()
	{
		$data = $this->input->post();
		$id = $this->input->post('id');

		if ($id) {
			// Perform soft delete on the existing record
			$this->M_carousel->delete($id);

			// Prepare data for the new record
			$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'created_at' => date('Y-m-d H:i:s')
			);

			// Check if a new file is uploaded
			if (isset($_FILES["picture"]["name"]) && $_FILES["picture"]["name"] != "") {
				$data['picture'] = $this->upload_image($this->input->post('title'));
			} else {
				// Retain the existing image
				$existing_record = $this->M_carousel->get($id);
				if ($existing_record) {
					$data['picture'] = $existing_record->picture;
				} else {
					$data['picture'] = ''; // Handle case where no existing record is found
				}
			}

			// Create a new record with the updated values
			$result = $this->M_carousel->insert($data);
			echo json_encode(array('status' => 'success', 'message' => 'Carousel updated successfully', 'data' => $result));
		} else {
			// Check if a new file is uploaded
			if (isset($_FILES["picture"]["name"]) && $_FILES["picture"]["name"] != "") {
				$data['picture'] = $this->upload_image($this->input->post('title'));
			}
			$data['created_at'] = date('Y-m-d H:i:s'); // Set the current date
			$result = $this->M_carousel->insert($data);
			echo json_encode(array('status' => 'success', 'message' => 'Carousel created successfully', 'data' => $result));
		}
	}

	private function upload_image($title)
	{
		$tgl = date('Y-m-d');
		$title = preg_replace("/[^A-Za-z0-9 ]/", '_', $title);
		$config['upload_path'] = "./assets/images/carousel"; // Ensure this path exists
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 3000; // 3 MB
		$config['file_name'] = $tgl . "_" . $title;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('picture')) {
			log_message('error', $this->upload->display_errors());
			return '';
		} else {
			$arr_image = array('upload_data' => $this->upload->data());
			return $arr_image['upload_data']['file_name'];
		}
	}


	public function edit_carousel($id)
	{
		$carousel = $this->M_carousel->get($id);
		echo json_encode($carousel);
	}

	public function update_carousel($id)
	{
		$data = $this->input->post();
		// echo json_encode($data);
		// Perform soft delete on the existing record
		$this->M_carousel->delete($id);

		// Use the store_carousel function to create a new record
		$this->store_carousel();
	}

	public function delete_carousel($id)
	{
		$this->M_carousel->delete($id);
		redirect('home/ordal');
	}
	




	
	
}
