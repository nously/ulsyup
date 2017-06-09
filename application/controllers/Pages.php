<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

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
	public function index()
	{
		if (isset($_GET['search']))
		{
			$data['goods'] = $this->Goods_model->getGoodsBySearch($_GET['keyword']);
			$data['notif'] = 'Search Result for <strong>'.$_GET['keyword'].'</strong>';
		}
		else if (isset($_GET['category']))
		{
			$data['goods'] = $this->Goods_model->getGoodsByCategory($_GET['category']);
			$data['notif'] = 'Products in <strong>'.$_GET['category'].'</strong>';
		}
		else
		{
			$data['goods'] = $this->Goods_model->getGoodsHome();
		}
		$data['members'] = $this->Member_model->getMember();

		if (isset($_SESSION['username']))
		{
			$data['member'] = $this->Member_model->getDetail($_SESSION['username']);

			if ($_SESSION['role'] === "1")
			{
				$this->load->view('home_logged-in_admin', $data);
			}
			else 
			{
				$this->load->view('home_logged-in', $data);
			}
		}
		else
		{
			$data['footer'] = $this->load->view('template/footer', '', true);
			$this->load->view('home_not_logged-in', $data , false);
		}
	}

	// This will handle the profile pages
	public function profile ($id)
	{
		$data['member'] = $this->Member_model->getDetail($id);
		if (isset($_SESSION['username']) && $id === $_SESSION['username'])
		{
			// opens user's profile
			$data['goods'] = $this->Goods_model->getGoodsByUsername($id);
			
		}
		else
		{
			// opens another user's profile
			$data['goods'] = $this->Goods_model->getGoodsByUsernameHome($id);
			// $this->load->view('profile_not_myself', $data);
		}
		$this->load->view('profile', $data);
	}

	public function goodsDetail($goods_id)
	{
		$data['goods'] = $this->Goods_model->getDetail($goods_id);
		$data['seller'] = $this->Member_model->getDetail($data['goods']['username_fk']);
		$data['comments'] = $this->Comment_model->getComments($goods_id);
		$this->load->view('goods_detail', $data);
	}

	public function message()
	{
		if (isset($_SESSION['username']))
		{
			$users_fk = $this->Message_model->get_related_users($_SESSION['username']);
			$data['users'] = $this->Member_model->get_users($users_fk);
			$this->load->view('message_page', $data);
		}
	}

}
