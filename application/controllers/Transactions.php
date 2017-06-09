<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// public function index()
	// {

	// }
	
	public function buy($goods_id, $buyer, $seller)
	{
		$detail['username_seller_fk'] = $seller;
		$detail['username_buyer_fk'] = $buyer;
		$detail['goods_id_fk'] = $goods_id;
		$this->Transaction_model->createTransaction($detail);
		header('location: ' . base_url() . 'Messages/buy/' . $goods_id . '/' . $seller);
	}
}