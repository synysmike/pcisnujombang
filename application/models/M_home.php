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
}
