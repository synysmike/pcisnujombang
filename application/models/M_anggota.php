<?php
class M_anggota extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get all anggota with related user, bio, and position data
	public function get_all_anggota()
	{
		$this->db->select('m_anggota.*, r_user.username, r_bio.nama, m_jabatan.name as position_name');
		$this->db->from('m_anggota');
		$this->db->join('r_user', 'm_anggota.id_user = r_user.id');
		$this->db->join('r_bio', 'r_user.id_bio = r_bio.id');
		$this->db->join('m_jabatan', 'm_anggota.id_jabatan = m_jabatan.id');
		$this->db->where('m_anggota.soft_deletes IS NULL');
		$query = $this->db->get();
		return $query->result();
	}
	// Get anggota by ID 
	public function get_anggota_by_id($id)
	{

		$this->db->select('m_anggota.*, r_user.username, r_bio.nama, m_jabatan.name as position_name');
		$this->db->from('m_anggota');
		$this->db->join('r_user', 'm_anggota.id_user = r_user.id');
		$this->db->join('r_bio', 'r_user.id_bio = r_bio.id');
		$this->db->join('m_jabatan', 'm_anggota.id_jabatan = m_jabatan.id');
		$this->db->where('m_anggota.id', $id);
		$this->db->where('m_anggota.soft_deletes IS NULL');
		$query = $this->db->get();
		return $query->row();
	}


	// Insert a new anggota
	public function insert_anggota($data)
	{
		$data['created_at'] = date('Y-m-d H:i:s');
		$this->db->insert('m_anggota', $data);
	}

	// Update an existing anggota
	public function update_anggota($id, $data)
	{
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		$this->db->update('m_anggota', $data);
	}

	// Soft delete an anggota
	public function delete_anggota($id)
	{
		$data = array('soft_deletes' => date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		$this->db->update('m_anggota', $data);
	}
}
