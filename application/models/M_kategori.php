<?php
class M_kategori extends CI_Model
{

	public function get_all_kategori()
	{
		$this->db->where('soft_deletes', NULL);
		return $this->db->get('m_kategori')->result_array();
	}

	public function get_kategori_by_id($id)
	{
		$this->db->where('soft_deletes', NULL);
		return $this->db->get_where('m_kategori', ['id' => $id])->row_array();
	}

	public function insert_kategori()
	{
		$data = [
			'kategori' => $this->input->post('categoryName'),
			'description' => $this->input->post('categoryDescription')
		];
		return $this->db->insert('m_kategori', $data);
	}

	public function update_kategori($id)
	{
		$data = [
			'kategori' => $this->input->post('categoryName'),
			'description' => $this->input->post('categoryDescription')
		];
		return $this->db->where('id', $id)->update('m_kategori', $data);
	}

	public function soft_delete_kategori($id)
	{
		$data = ['soft_deletes' => 1];
		return $this->db->where('id', $id)->update('m_kategori', $data);
	}
}
