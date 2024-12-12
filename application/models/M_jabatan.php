<?php
class M_jabatan extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get all positions
	public function get_all_positions()
	{
		$this->db->select('p1.*, p2.name as parent_name');
		$this->db->from('m_jabatan p1');
		$this->db->join('m_jabatan p2', 'p1.parent_id = p2.id', 'left');
		$this->db->where('p1.soft_deletes IS NULL');
		$query = $this->db->get();
		return $query->result();
	}

	// Get position by ID 
	public function get_position_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('m_jabatan');
		$this->db->where('id', $id);
		$this->db->where('soft_deletes IS NULL');
		$query = $this->db->get();
		return $query->row();
	}

	// Insert a new position
	public function insert_position($data)
	{
		$data['created_at'] = date('Y-m-d H:i:s');
		$this->db->insert('m_jabatan', $data);
	}

	// Update an existing position
	public function update_position($id, $data)
	{
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		$this->db->update('m_jabatan', $data);
	}

	// Soft delete a position
	public function delete_position($id)
	{
		$data = array('soft_deletes' => date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		$this->db->update('m_jabatan', $data);
	}
}
