<?php

class Message_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	public function get_messages($username_sender_fk, $me)
	{
		$this->db->select('*');
		$this->db->from('message');
		// $this->db->where(array('username_receiver_fk' => $username_receiver_fk));
		// $this->db->where("(username_receiver_fk='$me' OR username_sender_fk='$me') AND
		// 	username_sender_fk='$username_sender_fk' OR username_receiver_fk='$username_sender_fk'");
		$this->db->where("username_receiver_fk='$me' AND username_sender_fk='$username_sender_fk' OR username_receiver_fk='$username_sender_fk' AND username_sender_fk='$me'");
		$this->db->order_by('sending_time', 'desc');

		$result = $this->db->get();

		if ($result)
			return $result->result_array();
	}

	public function get_related_users($username_receiver_fk)
	{
		$this->db->select('username_sender_fk');
		$this->db->distinct();
		$this->db->from('message'); 
		$this->db->where('username_receiver_fk', $username_receiver_fk); 

		$result = $this->db->get();

		if ($result)
			$array1 = $result->result_array();

		$this->db->select('username_receiver_fk');
		$this->db->distinct();
		$this->db->from('message'); 
		$this->db->where('username_sender_fk', $_SESSION['username']); 

		$result = $this->db->get();
		if ($result)
			$array2 = $result->result_array();

		if (isset($array1[0]) AND isset($array2[0]))
		{
			foreach ($array1 as $key1 => $value1)
			{
				foreach ($array2 as $key2 => $value2)
				{
					if ($value2['username_receiver_fk'] === $value1['username_sender_fk'])
					{
						unset($array2[$key2]);
					}
				}
			}
		}
		
		return array_merge($array1, $array2);
	}

	public function create_message($new_message)
	{
		$this->db->insert('message', $new_message);
	}
}

?>