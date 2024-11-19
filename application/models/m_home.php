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

	function get_berita()
	{
		$hasil = $this->db->query("SELECT * FROM r_berita");
		return $hasil->result();
	}
	

	function simpan_berita($judul, $isi, $kat, $image)
	{
		$id = $this->get_id();
		$tgl = date('Y-m-d H:i:s');
		$data = array(
			'id' => $id,
			'tgl' => $tgl,
			'judul' => $judul,
			'isi' => $isi,
			'kat' => $kat,
			'gambar' => $image,

		);
		$result = $this->db->insert('r_berita', $data);
		return $result;
	}

	// function simpan_berita($judul, $isi, $kat)
	// {
	// 	$id = $this->get_id();
	// 	$tgl = date('Y-m-d H:i:s');
	// 	$hasil = $this->db->query("INSERT INTO r_berita (id,judul,isi,id_kat,tgl,soft_deletes)VALUES('$id','$judul','$isi','$kat','$tgl','0')");
	// 	return $hasil;
	// }
	function hapus_berita($id)
	{
		$hasil = $this->db->query("DELETE FROM r_berita WHERE id='$id'");
		return $hasil;
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
