<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_guest extends CI_Model
{

	// Fetch all guests
	public function get_all_guests()
	{
		return $this->db->get('r_guest')->result();
	}
	// Get guest by email
	public function get_guest_by_email($email)
	{
		return $this->db->where('email', $email)->get('r_guest')->row();
	}


	// Get a single guest by ID
	public function get_guest($guest_id)
	{
		return $this->db->where('guest_id', $guest_id)->get('r_guest')->row();
	}


	// Insert new guest
	public function insert_guest($data)
	{
		return $this->db->insert('r_guest', $data);
	}

	// Update guest
	public function update_guest($guest_id, $data)
	{
		return $this->db->where('guest_id', $guest_id)->update('r_guest', $data);
	}

	// Delete guest
	public function delete_guest($guest_id)
	{
		return $this->db->where('guest_id', $guest_id)->delete('r_guest');
	}
}
