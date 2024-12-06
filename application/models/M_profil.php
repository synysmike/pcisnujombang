<?php
class M_profil extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get the latest profile record that is not soft deleted
	public function get_latest_profile()
	{
		$this->db->select('*');
		$this->db->from('m_profil');
		$this->db->where('soft_deletes IS NULL');
		$this->db->order_by('version', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}

	// Insert a new profile version
	public function insert_profile($data)
	{
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['version'] = $this->get_latest_version() + 1;
		$this->db->insert('m_profil', $data);
	}

	// Get the latest version number
	private function get_latest_version()
	{
		$this->db->select_max('version');
		$this->db->from('m_profil');
		$this->db->where('soft_deletes IS NULL');
		$query = $this->db->get();
		$result = $query->row();
		return $result ? $result->version : 0;
	}

	// Soft delete the previous profile version
	public function soft_delete_previous_version()
	{
		$data = array('soft_deletes' => date('Y-m-d H:i:s'));
		$this->db->where('soft_deletes IS NULL');
		$this->db->order_by('version', 'DESC');
		$this->db->limit(1);
		$this->db->update('m_profil', $data);
	}
}
