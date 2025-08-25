<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_carousel extends CI_Model
{

	public function get_all()
	{
		$this->db->where('softdeletes_date IS NULL');
		return $this->db->get('m_carousel')->result();
	}

	public function get($id)
	{
		return $this->db->get_where('m_carousel', ['id' => $id])->row();
	}

	public function insert($data)
	{
		return $this->db->insert('m_carousel', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('m_carousel', $data);
	}

	public function delete($id)
	{
		if (!$id) return false;

		$this->db->where('id', $id);
		return $this->db->update('m_carousel', ['softdeletes_date' => date('Y-m-d H:i:s')]);
	}

	public function getJumbotronActive()
	{
		$sql = "SELECT * FROM m_video_carousels WHERE is_active = 1 ORDER BY id DESC LIMIT 1";
		$query = $this->db->query($sql);
		$jumbotron = $query->row();
		return $jumbotron;
	}
}
