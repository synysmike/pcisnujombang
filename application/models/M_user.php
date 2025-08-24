<?php
defined('BASEPATH') or exit('No direct script access allowed');

defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function insert_batch_users($batch_data)
	{
		$this->db->trans_start();

		foreach ($batch_data as $entry) {
			$bio_data = $entry['bio'];
			$user_data = $entry['user'];

			// Insert bio first
			$this->db->insert('r_bio', $bio_data);
			$id_bio = $this->db->insert_id();

			// Attach bio ID to user
			$user_data['id_bio'] = $id_bio;
			$this->db->insert('r_user', $user_data);
		}

		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	// Get user by username
	public function get_user_by_username($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('r_user');
		return $query->row();
	}

	public function insert_user($user_data, $bio_data)
	{
		$this->db->trans_start();

		// Insert bio first
		$this->db->insert('r_bio', $bio_data);
		$id_bio = $this->db->insert_id();

		// Attach bio ID to user
		$user_data['id_bio'] = $id_bio;
		$this->db->insert('r_user', $user_data);

		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function update_user($id_user, $user_data, $bio_data)
	{
		$this->db->trans_start();

		// Update user
		$this->db->where('id', $id_user);
		$this->db->update('r_user', $user_data);

		// Get bio ID from user
		$this->db->select('id_bio');
		$this->db->from('r_user');
		$this->db->where('id', $id_user);
		$id_bio = $this->db->get()->row()->id_bio;

		// Update bio
		$this->db->where('id', $id_bio);
		$this->db->update('r_bio', $bio_data);

		$this->db->trans_complete();
		return $this->db->trans_status();
	}


	// Get user by ID
	public function get_user_by_id($id)
	{
		$this->db->select('r_user.id, r_user.username, r_user.id_level, r_user.status, r_bio.nama, r_bio.email, r_bio.jk, r_bio.id_kabkot, r_bio.alamat, r_bio.ktp, r_bio.strata, r_bio.bidang, r_bio.hp, r_bio.kec, r_bio.kel, r_bio.rtrw');
		$this->db->from('r_user');
		$this->db->join('r_bio', 'r_user.id_bio = r_bio.id', 'left');
		$this->db->where('r_user.id', $id);
		$query = $this->db->get();
		return $query->row();
	}


	// Update user level
	public function update_level($id_user, $level)
	{
		$this->db->where('id', $id_user);
		$this->db->update('r_user', array('id_level' => $level));
		return $this->db->affected_rows();
	}

	// Update user status
	public function update_status($id_user, $status)
	{
		$this->db->where('id', $id_user);
		$this->db->update('r_user', array('status' => $status));
		return $this->db->affected_rows();
	}

	// Get all users
	public function get_users()
	{
		$this->db->select('r_user.id, r_user.username, r_user.id_level, r_user.status, r_bio.nama, r_bio.email, r_bio.jk, m_kabkot.kabkot as m_kabkot, r_bio.alamat, r_bio.ktp, r_bio.strata, r_bio.bidang, r_bio.hp, r_bio.kec, r_bio.kel, r_bio.rtrw');
		$this->db->from('r_user');
		$this->db->join('r_bio', 'r_user.id_bio = r_bio.id', 'left');
		$this->db->join('m_kabkot', 'r_bio.id_kabkot = m_kabkot.id', 'left');
		$query = $this->db->get();
		return $query->result();
	}


	// Delete user and bio
	public function delete_user($id_user)
	{
		$this->db->trans_start();
		$this->db->where('id', $id_user);
		$this->db->delete('r_user');
		$this->db->where('id_user', $id_user);
		$this->db->delete('r_bio');
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	// Get kabupaten/kota data
	public function get_kab_kota()
	{
		$query = $this->db->get('m_kabkot');
		return $query->result();
	}
}
