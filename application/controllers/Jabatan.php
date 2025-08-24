<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_jabatan');
		$this->load->helper('upload');
	}

	// Display all positions
	public function index()
	{
		$this->check_user_level([3, 4]);
		$this->data['js'] = 'admin/jabatan/js-req';
		$this->data['css'] = 'admin/jabatan/css-req';
		$this->data['ct'] = 'admin/jabatan/index';
		$this->load->view('admin/main', $this->data);
	}

	// Fetch all positions for AJAX request
	public function fetch_all()
	{
		$positions = $this->M_jabatan->get_all_positions();
		echo json_encode($positions);
	}

	// Add a new position
	public function add()
	{
		if ($this->input->post()) {
			$data = array(
				'name' => $this->input->post('name'),
				'parent_id' => $this->input->post('parent_id')
			);
			$this->M_jabatan->insert_position($data);
			echo json_encode(array('status' => 'success'));
		} else {
			$this->load->view('positions/add');
		}
	}

	// Edit an existing position
	public function edit($id)
	{
		if ($this->input->post()) {
			$data = array(
				'name' => $this->input->post('name'),
				'parent_id' => $this->input->post('parent_id')
			);
			$this->M_jabatan->update_position($id, $data);
			echo json_encode(array('status' => 'success'));
		} else {
			$data['position'] = $this->M_jabatan->get_position_by_id($id);
			$this->load->view('positions/edit', $data);
		}
	}

	// Get position by ID for AJAX request
	public function get_position_by_id($id)
	{
		$position = $this->M_jabatan->get_position_by_id($id);
		echo json_encode($position);
	}

	// Soft delete a position
	public function delete($id)
	{
		$this->M_jabatan->delete_position($id);
		echo json_encode(array('status' => 'success'));
	}
}
