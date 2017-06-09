<?php

class Member_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function getDetail($id)
	{
		$result = $this->db->get_where('user', array('username' => $id));

		if ($result)
			return $result->result_array()[0];
		else
			return 0;
	}

	public function getMember($id = '', $password = '')
	{
		$result = "";
		if ($id && $password)
		{
			$result = $this->db->get_where('user', array('username' => $id, 'password' => $password));
		}
		else
		{
			$result = $this->db->get('user');
		}

		if ($result)
			return $result->result_array();
		else
			return 0;
	}

	public function insertMember($user_data)
	{
		$check = $this->db->get_where('user', array('username' => $user_data['username']));
		$check = $check->result_array();
		if (isset($check[0]))
		{
			return 0;
		}

		$result = $this->db->insert('user', $user_data);
		return $result;
	}
	
	public function deleteMember($id)
	{
		// $this->db->where('username_fk', $id);
		// $this->db->delete('goods');
		
		$this->db->where('username', $id);
		$this->db->delete('user');
	}

	public function update($dataUser)
	{
		$data = array('fullname' => $dataUser['fullname'], 
						'photo' => $dataUser['picture'],
						'handphone' => $dataUser['handphone'], 
						'email' => $dataUser['email']);
		$this->db->where('username', $dataUser['username']);
		$this->db->update('user', $data);
	}

	public function get_users($username)
	{
		$x = 0;
		foreach($username as $user)
		{
			if (isset($user['username_sender_fk'])){
				$this->db->select('username, fullname, role, photo');
				$this->db->from('user');
				$this->db->where(array('username' => $user['username_sender_fk']));

				$result = $this->db->get();

				if ($result && isset($result))
				{
					$users[$x++] = $result->result_array()[0];
				}
			}
			if (isset($user['username_receiver_fk'])) 
			{
				$this->db->select('username, fullname, role, photo');
				$this->db->from('user');
				$this->db->where(array('username' => $user['username_receiver_fk']));

				$result = $this->db->get();

				if ($result && isset($result))
				{
					$users[$x++] = $result->result_array()[0];
				}
			}
		}
		if (isset($users)) return $users;
	}

}



?>