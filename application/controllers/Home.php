<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends My_Controller
{
	public $data         = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_home');
		$this->load->model('M_berita');
		$this->load->model('M_carousel');
		$this->load->model('M_comment');
		$this->load->model('M_guest');
		$this->load->model('M_profil');
		$this->load->library(array('upload'));
		$this->load->library('session');
		$this->load->helper('upload');
		// $this->load->library('input');
	}

	public function index()
	{
		$query = $this->db->select('a.*, u.username, b.nama, j.name as position_name, a.id_jabatan')
			->from('m_anggota a')
			->join('r_user u', 'a.id_user = u.id')
			->join('r_bio b', 'u.id_bio = b.id')
			->join('m_jabatan j', 'a.id_jabatan = j.id')
			->where('a.soft_deletes IS NULL')
			->order_by('a.id_jabatan ASC, j.name ASC, b.nama ASC')
			->get();

		$raw = $query->result_array();
		$struktur = [];

		foreach ($raw as $row) {
			$level = $row['id_jabatan'];
			$role = $row['position_name'];
			$name = $row['nama'];

			$struktur[$level][$role][] = $name;
		}
		$this->data['struktur'] = $struktur;
		$this->data['profile'] = $this->M_profil->get_latest_profile();
		$this->data['css'] = 'public/home/css-req';
		$this->data['js'] = 'public/home/js-req';
		$this->data['js_func'] = 'public/home/home-jsfunc';
		$this->data['page'] = 'public/home';
		$this->data['mobile_menu'] = 'public/mobile_menu';
		$this->data['hero'] = 'public/home/hero';
		// $this->data['hero'] = 'public/home/hero_video';
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
		$this->load->view('public/main', $this->data);
	}

	public function get_geo_info($ip_address)
	{
		$api_key = '081aa4913cbc4324950e5600c7007aed'; // Replace with your API key
		$url = "https://api.ipgeolocation.io/ipgeo?apiKey=$api_key&ip=$ip_address";

		// Use cURL to call the API
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		// Decode API response
		$data = json_decode($response, true);

		return [
			'country' => $data['country_name'] ?? 'Unknown',
			'region' => $data['state_prov'] ?? 'Unknown',
		];
	}



	public function process_comment()
	{
		$this->load->library('form_validation');

		// Step 0: Validate input
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|regex_match[/^[0-9\-\+\s\(\)]+$/]');
		$this->form_validation->set_rules('uname', 'Username', 'required|min_length[3]');
		$this->form_validation->set_rules('comment_text', 'Comment', 'required|min_length[5]');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'success' => false,
				'message' => validation_errors()
			]);
			return;
		}

		// Step 1: Get IP and geolocation
		$ip_address = $this->input->ip_address();
		$geo_info = $this->get_geo_info($ip_address);

		// Step 2: Prepare guest data
		$guest_data = array(
			'uname' => $this->input->post('uname', TRUE),
			'email' => $this->input->post('email', TRUE),
			'phone_number' => $this->input->post('phone_number', TRUE),
			'ip_address' => $ip_address,
			'country' => $geo_info['country'],
			'region' => $geo_info['region'],
			'created_at' => date('Y-m-d H:i:s')
		);

		// Step 3: Insert or retrieve guest
		$existing_guest = $this->M_guest->get_guest_by_email($guest_data['email']);
		if ($existing_guest) {
			$guest_id = $existing_guest->guest_id;
		} else {
			$this->M_guest->insert_guest($guest_data);
			$guest_id = $this->db->insert_id();
			if (!$guest_id) {
				log_message('error', 'Guest insert failed: ' . json_encode($guest_data));
				echo json_encode(['success' => false, 'message' => 'Failed to register guest.']);
				return;
			}
		}

		// Step 4: Insert comment
		$comment_data = array(
			'guest_id' => $guest_id,
			'berita_id' => $this->input->post('post_id', TRUE),
			'comment_text' => $this->input->post('comment_text', TRUE),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
			'parent_comment_id' => $this->input->post('parent_comment_id', TRUE),
		);

		$comment_result = $this->M_comment->insert_comment($comment_data);

		// Step 5: Respond
		if ($comment_result) {
			echo json_encode(['success' => true, 'message' => 'Comment added successfully.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to add comment.']);
		}
	}

	// Add a new comment




	public function get_comment($post_id)
	{

		// echo '<pre>';
		// var_dump($post_id);
		// echo '</pre>';
		// Step 1: Fetch all comments for the given post_id
		$comments = $this->M_comment->get_comments_by_post($post_id);
		// var_dump($comments);

		// Step 2: Organize comments into a hierarchical structure
		$nested_comments = $this->build_comment_hierarchy($comments);

		// Step 3: Return comments as JSON response
		echo json_encode($nested_comments);
		// echo json_encode($nested_comments);
	}

	// Helper function to build comment hierarchy
	private function build_comment_hierarchy($comments)
	{
		// Create an associative array for quick lookup
		$comment_map = [];
		foreach ($comments as $comment) {
			$comment_map[$comment->comment_id] = $comment;
			$comment_map[$comment->comment_id]->children = []; // Add 'children' property to each comment
		}

		// Build the hierarchy
		$nested_comments = [];
		foreach ($comments as $comment) {
			if ($comment->parent_comment_id != 0) {
				// If the comment has a parent, add it to the parent's 'children' array
				$comment_map[$comment->parent_comment_id]->children[] = $comment;
			} else {
				// If the comment is a top-level comment, add it to the root array
				$nested_comments[] = $comment;
			}
		}

		return $nested_comments;
	}


	// Update an existing comment
	public function edit_comment($comment_id)
	{
		$data = array(
			'comment_text' => $this->input->post('comment_text'),
		);

		$result = $this->M_comment->update_comment($comment_id, $data);
		echo json_encode(['success' => $result]);
	}

	// Delete a comment
	public function delete_comment($comment_id)
	{
		$result = $this->M_comment->delete_comment($comment_id);
		echo json_encode(['success' => $result]);
	}







	// Display all guests (AJAX)
	public function get_guests()
	{
		$data['guests'] = $this->M_guest->get_all_guests();
		echo json_encode($data);
	}



	// Update guest information
	public function edit_guest($guest_id)
	{
		$data = array(
			'email' => $this->input->post('email'),
			'phone_number' => $this->input->post('phone_number'),
			'ip_address' => $this->input->post('ip_address'),
			'country' => $this->input->post('country'),
			'region' => $this->input->post('region'),
		);

		$result = $this->M_guest->update_guest($guest_id, $data);
		echo json_encode(['success' => $result]);
	}

	// Delete guest
	public function delete_guest($guest_id)
	{
		$result = $this->M_guest->delete_guest($guest_id);
		echo json_encode(['success' => $result]);
	}

	public function get_section()
	{
		$sections = $this->M_home->get_section();
		echo json_encode($sections);
	}






	public function get_all_berita()
	{
		$berita = $this->M_berita->get_berita();
		if (!$berita) {
			echo json_encode(["error" => "No data found"]);
			return;
		}

		$formattedBerita = [];
		foreach ($berita as $item) {
			$formattedBerita[] = [
				"title" => $item->judul,
				"url" => $item->slug,
				"id" =>  $item->id,
				"image" => base_url('assets/images/berita/' . $item->gambar),
				"date" => date('F d, Y', strtotime($item->tgl)),
				"category" => $item->kategori_nama
			];
		}
		echo json_encode($formattedBerita);
	}




	public function get_berita_detail()
	{
		$slug = $this->input->post('slug');

		$berita = $this->M_berita->get_berita_by_slug($slug);

		$response = !empty($berita)
			? (array) $berita
			: ['error' => 'Berita not found'];


		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function blog_detail($slug = null)
	{
		$this->data['berita'] = (array) $this->M_berita->get_berita_by_slug($slug);
		// Load model
		$this->data['css'] = 'public/home/css-req';
		$this->data['js'] = 'public/home/js-req';
		$this->data['js_func'] = 'public/isi_berita/jsfunc';
		$this->data['page'] = 'public/isi_berita/blog-detail';
		$this->data['mobile_menu'] = 'public/mobile_menu';
		$this->data['header'] = 'public/header';
		$this->data['footer'] = 'public/footer';
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
		return $this->M_home->soft_delete($id);
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
		////////////////////////////////// FOR DEBUGGING FILE////////////////////////

		// $tmp = $_FILES['picture']['tmp_name'];
		// $target = './assets/images/carousel/test.png';
		// if (move_uploaded_file($tmp, $target)) {
		// 	log_message('debug', 'Manual move_uploaded_file succeeded');
		// } else {
		// 	log_message('error', 'Manual move_uploaded_file failed');
		// }

		////////////////////////////////// END OF DEBUGGING FILE////////////////////////


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
		if ($this->input->method() !== 'post') {
			show_error('Forbidden', 403);
		}

		$deleted = $this->M_carousel->delete($id);

		if ($deleted) {
			echo json_encode(['status' => 'success']);
		} else {
			http_response_code(500);
			echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
		}
	}
}
