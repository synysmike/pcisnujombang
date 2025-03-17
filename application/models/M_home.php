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

	public function get_config_by_apply()
	{
		$this->db->select('r_home_config.*, r_section.name as section_name, r_section.content as section_content, m_carousel.title as carousel_title, m_carousel.description as carousel_description, m_carousel.picture as carousel_picture');
		$this->db->from('r_home_config');
		$this->db->where('r_home_config.apply', 1);

		// Join with r_section
		$this->db->join('r_section', 'FIND_IN_SET(r_section.id, r_home_config.array_of_id_section) > 0', 'left');

		// Join with m_carousel
		$this->db->join('m_carousel', 'FIND_IN_SET(m_carousel.id, r_home_config.array_of_id_carousel) > 0', 'left');

		$query = $this->db->get();
		return $query->result();
	}


	public function insert($data)
	{
		return $this->db->insert('r_home_config', $data); // Change 'config_table' to the actual table name
	}
	// Update an existing configuration by ID
	public function update_config($id, $data)
	{
		return $this->db->where('id', $id)
			->update('r_home_config', $data); // Change 'config_table' to the actual table name
	}




	public function get_all_sections()
	{
		$this->db->select('*');
		$this->db->from('r_section');
		$this->db->where('softdeletes_date IS NULL');
		$query = $this->db->get();
		return [
			"data" => $query->result_array()
		];
	}





	public function insert_section($data)
	{
		$this->db->insert('r_section', $data);
		return $this->db->insert_id();
	}

	public function get_section_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('r_section');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function soft_delete_section($id)
	{
		$this->db->where('id', $id);
		return $this->db->update('r_section', ['softdeletes_date' => date('Y-m-d H:i:s')]);
	}
	public function update_section($id, $data)
	{
		// Soft delete the existing section
		$this->db->where('id', $id);
		$this->db->update('r_section', ['softdeletes_date' => date('Y-m-d H:i:s')]);

		// Insert the new section data
		$this->db->insert('r_section', $data);
		return $this->db->insert_id();
	}





	public function apply_config($id)
	{
		// Remove apply value from other records where it is 1
		$this->db->where('apply', 1);
		$this->db->update('r_home_config', ['apply' => null]);

		// Set apply value to 1 for the given id
		$this->db->where('id', $id);
		return $this->db->update('r_home_config', ['apply' => 1]);
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
