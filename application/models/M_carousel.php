<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_carousel extends CI_Model
{

	public function get_all()
	{
		return $this->db->get('m_carousel')->result();
	}

	public function get($id)
	{
		return $this->db->get_where('m_carousel', ['id' => $id])->row();
	}

	public function insert($data)
	{
		$this->db->insert('m_carousel', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('m_carousel', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('m_carousel');
	}
}
