<?php

class Comment_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	public function insert_comment($username_fk, $goods_id_fk, $comment)
	{
		$inserted_data = array('username_fk' => $username_fk, 'goods_id_fk' => $goods_id_fk, 'comment' => $comment);
		$this->db->insert('comment', $inserted_data);
	}

	public function getComments($goods_id)
	{
		$this->db->select('*');
		$this->db->from('comment');
		$this->db->where("goods_id_fk='$goods_id'");

		$result = $this->db->get();

		if ($result)
			return $result->result_array();
	}

	public function delete_comment($comment_id)
	{
		$this->db->where('comment_id', $comment_id);
		$this->db->delete('comment');
	}

	public function edit_comment($comment_id, $new_comment)
	{
		$this->db->where('comment_id', $comment_id);
		$this->db->update('comment', array('comment' => $new_comment));
	}
}

?>