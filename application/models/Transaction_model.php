<?php

class Transaction_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	public function createTransaction($transactionDetail)
	{
		//print_r($transactionDetail);
		$result = $this->db->insert('transaction', $transactionDetail);
		return $result;
	}
}

?>