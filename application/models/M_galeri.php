<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_galeri extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_galeri()
	{
		$this->db->select('m_galeri.*, r_user.username as user_name'); // Select the necessary fields
		$this->db->from('m_galeri');
		$this->db->join('r_user', 'r_user.id = m_galeri.id_user'); // Join with the r_user table
		$this->db->where('m_galeri.soft_deletes', 0);
		$query = $this->db->get();
		return $query->result();
	}

	public function soft_delete_galeri($id)
	{
		$this->db->where('id', $id);
		$this->db->update('m_galeri', array('soft_deletes' => 1)); // Assuming 'soft_deletes' is the column for soft delete
	}

	public function get_galeri_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->where('soft_deletes', 0);
		$query = $this->db->get('m_galeri');
		return $query->row();
	}


	public function insert_galeri($data)
	{
		return $this->db->insert('m_galeri', $data);
	}

	public function update_galeri($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('m_galeri', $data);
	}

	public function delete_galeri($id)
	{
		$this->db->where('id', $id);
		return $this->db->update('m_galeri', array('soft_deletes' => 1));
	}
}
