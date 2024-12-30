<?php

class M_berita extends CI_Model
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
		$this->db->select('r_berita.*, m_kategori.kategori as kategori_nama');
		$this->db->from('r_berita');
		$this->db->join('m_kategori', 'r_berita.id_kat = m_kategori.id');
		$this->db->where('r_berita.soft_deletes IS NULL');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_berita_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('r_berita');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	function simpan_berita($data)
	{
		$id = $this->get_id();
		$tgl = date('Y-m-d H:i:s');
		$slug = preg_replace("/[^A-Za-z0-9 ]/", '-', $data['judul']);
		if ($data['gambar']) {
			$data = array(
				'id' => $id,
				'tgl' => $tgl,
				'judul' => $data['judul'],
				'isi' => $data['isiBerita'],
				'id_kat' => $data['kategori'],
				'gambar' => $data['gambar'],
				'slug' => $slug,
			);
		} else {
			$data = array(
				'id' => $id,
				'tgl' => $tgl,
				'judul' => $data['judul'],
				'isi' => $data['isiBerita'],
				'id_kat' => $data['kategori'],
				'slug' => $slug,
			);
		}
		// var_dump($data);
		$result = $this->db->insert('r_berita', $data);
		return $result;
	}




	function update_berita($id, $data)
	{
		$slug = preg_replace("/[^A-Za-z0-9 ]/", '-', $data['judul']);
		$tgl = date('Y-m-d H:i:s');
		if ($data['gambar']) {
			$data = array(
				'id' => $id,
				'tgl' => $tgl,
				'tgl' => $tgl,
				'judul' => $data['judul'],
				'isi' => $data['isiBerita'],
				'gambar' => $data['gambar'],
				'id_kat' => $data['kat'],
				'slug' => $slug,
			);
		} else {
			$data = array(
				'id' => $data['id'],
				'tgl' => $tgl,
				'judul' => $data['judul'],
				'isi' => $data['isiBerita'],
				'id_kat' => $data['kat'],
				'slug' => $slug,
			);
		}
		// var_dump($data);
		$this->db->where('id', $id);
		$result = $this->db->update('r_berita', $data);
		return $result;
	}

	// function simpan_berita($judul, $isi, $kat)
	// {
	// 	$id = $this->get_id();
	// 	$tgl = date('Y-m-d H:i:s');
	// 	$hasil = $this->db->query("INSERT INTO r_berita (id,judul,isi,id_kat,tgl,soft_deletes)VALUES('$id','$judul','$isi','$kat','$tgl','0')");
	// 	return $hasil;
	// }
	function delTemp_berita($id)
	{ // Get the row with the specified id 
		$this->db->where('id', $id);
		$query = $this->db->get('r_berita');
		$row = $query->row();
		// Check if the row exists 
		if ($row) {
			// Perform soft delete by setting the soft_deletes column 
			$this->db->where('id', $id);
			$data = array('soft_deletes' => date('Y-m-d H:i:s'));
			// Set the current timestamp 
			$hasil = $this->db->update('r_berita', $data);
			return $hasil;
		} else {

			// Handle the case where the row does not exist 
			return false;
		}
	}
	function hapus_berita($id)
	{
		// Get the row with the specified id 
		$this->db->where('id', $id);
		$query = $this->db->get('r_berita');
		$row = $query->row();
		// Check if the row exists 
		if ($row) {
			$nama_gambar = $row->gambar;
			// Check if the gambar field is not empty 
			if ($nama_gambar != "") {
				$path = "./assets/images/" . $nama_gambar;
				if (file_exists($path)) {
					// Remove file 
					unlink($path);
				}
			}
			// Delete the row from the database 
			$this->db->where('id', $id);
			$hasil = $this->db->delete('r_berita');
			return $hasil;
		} else {
			// Handle the case where the row does not exist 
			return false;
		}
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
