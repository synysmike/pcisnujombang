<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_comment extends CI_Model
{

	public function get_comments_by_post($post_id)
	{

		$this->db->select('
		    r_comment.*,
		    r_guest.uname,
		    r_guest.email,
		    r_guest.phone_number,
		    r_guest.ip_address,
		    r_guest.country,
		    r_guest.region
		');
		$this->db->from('r_comment');
		$this->db->join('r_guest', 'r_comment.guest_id = r_guest.guest_id', 'left');
		$this->db->where('r_comment.berita_id', $post_id);
		$this->db->order_by('r_comment.created_at', 'ASC');
		return $this->db->get()->result();
	}


	// Get a single comment by ID
	public function get_comment($comment_id)
	{
		return $this->db->where('comment_id', $comment_id)->get('r_comment')->row();
	}

	// Insert new comment
	public function insert_comment($data)
	{
		return $this->db->insert('r_comment', $data);
	}

	// Update comment
	public function update_comment($comment_id, $data)
	{
		return $this->db->where('comment_id', $comment_id)->update('r_comment', $data);
	}

	// Delete comment
	public function delete_comment($comment_id)
	{
		return $this->db->where('comment_id', $comment_id)->delete('r_comment');
	}
}
