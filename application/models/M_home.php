<?php

class M_home extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	public function get_id()
	{
		$char1 = random_string('alpha', 3);
		$char2 = random_string();
		$char3 = random_string('alpha', 1);
		return $char1 . $char2 . $char3;
	}
	public function get_config()
	{
		$this->db->select('*');
		$this->db->from('r_home_config');
		$this->db->where('softdeletes_date IS NULL');
		$query = $this->db->get();
		return [
			"data" => $query->result_array()
		];
	}

	public function get_config_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('r_home_config');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function update_config($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('r_home_config', $data);
	}

	public function soft_delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->update('r_home_config', ['softdeletes_date' => date('Y-m-d H:i:s')]);
	}
	public function get_all($limit, $start)
	{
		$this->db->select('*, ambil_total_berita(url) jumlah_visitor');
		$this->db->from('info');
		$this->db->like('kat', 'berita', 'after');
		$this->db->order_by('tglup', 'DESC');
		$this->db->limit($start, $limit);
		$query = $this->db->get();
		// dump($start);
		return $query->result_array();
	}

	public function get_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('info');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function insert($data)
	{
		return $this->db->insert('r_home_config', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('info', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('info');
	}
}
