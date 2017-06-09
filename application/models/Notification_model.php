<?php

class Notification_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	public function insert_notification($username_fk, $activity, $notification_type)
	{
		$this->db->insert('notification', 
			array('username_fk'=>$username_fk, 'activity'=>$activity, 'notification_type'=>$notification_type));
	}

	public function get_notification()
	{
		$this->db->select('*');
		$this->db->from('notification');
		$this->db->where('username_fk', $_SESSION['username']);
		$this->db->order_by('timestamp', 'desc');

		$result = $this->db->get();

		if ($result && isset($result))
			return $result->result_array();
	}

	public function update_read($username)
	{
		$this->db->where('username_fk', $username);
		$this->db->update('notification', array('unread' => '0'));
	}
}

?>