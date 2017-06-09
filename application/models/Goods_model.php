<?php

class Goods_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	public function getGoodsByUsername($username = '')
	{
		$result = "";
		if ($username)
		{
			$result = $this->db->get_where('goods', array('username_fk' => $username));
		}
		else
		{
			$result = $this->db->get('goods');
		}

		if ($result)
			return $result->result_array();
	}

	public function getGoodsByUsernameHome($username = '')
	{
		$result = "";
		if ($username)
		{
			$result = $this->db->get_where('goods', array('username_fk' => $username));
		}
		else
		{
			$result = $this->db->get('goods');
		}

		if ($result)
			return $result->result_array();
	}

	public function getGoods($id = '')
	{
		$result = "";
		if ($id)
		{
			$result = $this->db->get_where('goods', array('goods_id' => $id));
		}
		else
		{
			$result = $this->db->get('goods');
		}

		if ($result)
			return $result->result_array();
	}

	public function getGoodsHome($id = '')
	{
		$result = "";
		if ($id)
		{
			$result = $this->db->get_where('goods', array('goods_id' => $id, 'verified' => 1));
		}
		else
		{
			$result = $this->db->get_where('goods', array('verified' => 1));
		}

		if ($result)
			return $result->result_array();
	}

	public function getGoodsByCategory($category)
	{
		$this->db->select('*');
		$this->db->from('goods');
		$this->db->where('category=\''.$category.'\' AND verified=\'1\'');
		$result = $this->db->get();

		if ($result)
			return $result->result_array();
	}

	public function getGoodsBySearch($keyword)
	{
		$this->db->select("*");
		$this->db->from("goods");
		$this->db->where("(title LIKE '%$keyword%' OR description LIKE '%$keyword%') AND verified = 1");

		$result = $this->db->get();

		if ($result)
			return $result->result_array();
	}

	public function deleteGoods($id)
	{
		$this->db->where('goods_id', $id);
		$this->db->delete('goods');
	}

	public function verifyGoods($id)
	{
		$this->db->where('goods_id', $id);
		$this->db->update('goods', array('verified' => 1));
	}

	public function getDetail($id)
	{
		$result = $this->db->get_where('goods', array('goods_id' => $id));

		if ($result)
			return $result->result_array()[0];
		else
			return 0;
	}

	public function update($id, $title, $category, $picture, $price, $description, $stock)
	{
		$data = array('title' => $title, 'category' => $category, 'picture' => $picture, 'price' => $price, 'description' => $description, 'stock' => $stock);
		$this->db->where('goods_id', $id);
		$this->db->update('goods', $data);
	}

	public function insert($title, $category, $picture, $price, $description, $stock)
	{
		$data = array('username_fk' => $_SESSION['username'], 'title' => $title, 'category' => $category, 'picture' => $picture, 'price' => $price, 'description' => $description, 'stock' => $stock);
		$result = $this->db->insert('goods', $data);

		return $result;
	}
}

?>