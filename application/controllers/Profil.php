<?php
class Profil extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_profil');
	}

	// Display the latest profile
	public function index()
	{
		$this->check_user_level([2, 3, 4]);
		$this->data['js'] = 'admin/profil/js-req';
		$this->data['css'] = 'admin/profil/css-req';
		$this->data['ct'] = 'admin/profil/index';
		$this->load->view('admin/main', $this->data);
	}
	// Fetch profile data for AJAX request 
	public function get_profile_data()
	{
		$profile = $this->M_profil->get_latest_profile();
		echo json_encode($profile);
	}

	// Update the profile's visi
	// Update the profile's visi 
	public function update_visi()
	{
		if ($this->input->post()) {
			$current_profile = $this->M_profil->get_latest_profile();
			$data = array(
				'visi' => $this->input->post('visi'),
				'misi' => $current_profile->misi,
				'sejarah' => $current_profile->sejarah
			);
			$this->M_profil->soft_delete_previous_version();
			$this->M_profil->insert_profile($data);
			echo json_encode(array('status' => 'success'));
		}
	} // Update the profile's misi 
	public function update_misi()
	{
		if ($this->input->post()) {
			$current_profile = $this->M_profil->get_latest_profile();
			$data = array(
				'visi' => $current_profile->visi,
				'misi' => $this->input->post('misi'),
				'sejarah' => $current_profile->sejarah
			);
			$this->M_profil->soft_delete_previous_version();
			$this->M_profil->insert_profile($data);
			echo json_encode(array('status' => 'success'));
		}
	} // Update the profile's sejarah
	public function update_sejarah()
	{
		if ($this->input->post()) {
			$current_profile = $this->M_profil->get_latest_profile();
			$data = array(
				'visi' => $current_profile->visi,
				'misi' => $current_profile->misi,
				'sejarah' => $this->input->post('sejarah')
			);
			$this->M_profil->soft_delete_previous_version();
			$this->M_profil->insert_profile($data);
			echo json_encode(array('status' => 'success'));
		}
	}
}
