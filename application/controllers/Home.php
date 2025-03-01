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
	public function login() {}
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

	public function set_home_config()
	{
		$config = $this->M_home->get_config_by_apply();
		echo json_encode($config);
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


	public function save_config()
	{
		$data = $this->input->post();
		$id = $this->input->post('id');
		$custom_path = './assets/images/logo/'; // Directory to store logos

		// Handle file upload for logo
		if (isset($_FILES["logo"]["name"]) && $_FILES["logo"]["name"] != "") {
			$data['logo'] = upload_image($this->input->post('config_profile_name'), $custom_path, 'logo');
		}

		if ($id) {
			// Update existing config
			$existing_record = $this->M_home->get_config_by_id($id);

			if ($existing_record) {
				// Retain existing data that isn't being updated
				foreach ($existing_record as $key => $value) {
					if (!isset($data[$key])) {
						$data[$key] = $value;
					}
				}

				// Retain existing logo if no new file uploaded
				if (!isset($data['logo']) && isset($existing_record->logo)) {
					$data['logo'] = $existing_record->logo;
				}

				// Convert arrays to comma-separated strings if needed
				$section = $this->input->post('array_of_id_section');
				$carousel = $this->input->post('array_of_id_carousel');
				$data['array_of_id_section'] = is_array($section) ? implode(',', $section) : $section;
				$data['array_of_id_carousel'] = is_array($carousel) ? implode(',', $carousel) : $carousel;

				// Debug log
				log_message('debug', 'Update data: ' . print_r(
						$data,
						true
					));

				// Update the data in the database
				$this->M_home->update_config($id, $data);
			}
		} else {
			// Add new config
			$data['date_of_creation'] = date('Y-m-d H:i:s');

			// Convert arrays to comma-separated strings if needed
			$section = $this->input->post('array_of_id_section');
			$carousel = $this->input->post('array_of_id_carousel');
			$data['array_of_id_section'] = is_array($section) ? implode(',', $section) : $section;
			$data['array_of_id_carousel'] = is_array($carousel) ? implode(',', $carousel) : $carousel;

			// Insert the new data into the database
			$this->M_home->insert($data);
		}

		// Return a JSON response
		echo json_encode(['status' => 'success']);
	}



	public function delete_config()
	{
		$id = $this->input->post('id'); // Get the id from the POST data

		// Ensure $id is valid
		if ($id) {
			// Perform delete operation
			$result = $this->_delete_config_by_id($id);
			// Send response
			if ($result) {
				echo json_encode(['success' => true]);
			} else {
				echo json_encode(['success' => false]);
			}
		} else {
			echo json_encode(['success' => false]);
		}
	}
	// Private method to handle the actual deletion logic
	private function _delete_config_by_id($id)
	{
		// Perform delete operation
		return $this->M_home->delTemp_config($id);
	}


	//delete config
	public function delete($id)
	{
		$this->M_home->soft_delete($id);
		echo json_encode(array('status' => 'success'));
	}
	//apply config
	public function apply_config($id)
	{
		$this->M_home->apply_config($id);
		echo json_encode(array('status' => 'success', 'message' => 'Configuration applied successfully'));
	}
	// Home
	public function read()
	{
		$this->data['records'] = $this->M_home->get_all();
		$this->load->view('admin/main', $this->data);
	}



	// Load Section
	public function get_all_sections()
	{
		$sections = $this->M_home->get_all_sections();
		echo json_encode($sections);
	}
	//update section
	public function update_section($id)
	{
		$data = array(
			'name' => $this->input->post('section_name'),
			'content' => $this->input->post('section_content'),
		);

		$this->M_home->update_section($id, $data);
		echo json_encode(array('status' => 'success', 'message' => 'Section updated successfully'));
	}
	//store section
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

	//edit section
	public function edit_section($id)
	{
		$section = $this->M_home->get_section_by_id($id);
		echo json_encode($section);
	}
	//
	public function delete_section($id)
	{
		$this->M_home->soft_delete_section($id);
		echo json_encode(array('status' => 'success'));
	}

	// Carousel
	//
	public function get_all_carousels()
	{
		$carousels = $this->M_carousel->get_all();
		echo json_encode(['data' => $carousels]);
	}
	//store carousel
	public function store_carousel()
	{
		$data = $this->input->post();
		$id = $this->input->post('id');
		$custom_path = './assets/images/carousel/'; // Directory to store carousel images
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
				$data['picture'] = upload_image($this->input->post('title'), $custom_path, 'picture');
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

				$data['picture'] = upload_image($this->input->post('title'), $custom_path, 'picture');
			}
			$data['created_at'] = date('Y-m-d H:i:s'); // Set the current date
			$result = $this->M_carousel->insert($data);
			echo json_encode(array('status' => 'success', 'message' => 'Carousel created successfully', 'data' => $result));
		}
	}



	// get carousel by id
	public function edit_carousel($id)
	{
		$carousel = $this->M_carousel->get($id);
		echo json_encode($carousel);
	}

	//delete carousel
	public function delete_carousel($id)
	{
		$this->M_carousel->delete($id);
		redirect('home/ordal');
	}
}
