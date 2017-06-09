<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$this->login();
	}

	public function login()
	{
		if (!isset($_SESSION['username']))
			$this->load->view('login_admin');
		else
			header('location: ' . base_url());
	}

	public function login_process()
	{
		$user_data = $this->Member_model->getMember($_POST['username'], $_POST['password'])[0];
		if ($user_data && $user_data['role'] !== '2')
		{

			$_SESSION['username'] = $user_data['username'];
			$_SESSION['password'] = $user_data['password'];
			$_SESSION['role'] = $user_data['role'];
									
		}
		else
		{
			echo "<script>alert('Username or password are incorrect');</script>";
		}
		echo "<script>window.location = '". base_url() ."'</script>";
	}

	public function register()
	{
		$this->load->view('register');
	}

	public function register_process()
	{
		$user_data = array();
		$user_data['username'] = $_POST['username'];
		$user_data['password'] = $_POST['password'];
		$user_data['fullname'] = $_POST['fullname'];
		$user_data['birth_place'] = $_POST['bp'];
		$user_data['birth_date'] = $_POST['bd'];
		$user_data['handphone'] = $_POST['telephone'];
		$user_data['email'] = $_POST['email'];
		$user_data['role'] = 1;
		$user_data['topup'] = 0;

		$result = $this->Member_model->insertMember($user_data);
		if ($result !== 0)
		{
			$this->login();
		}
		else if ($result === 0)
		{
			echo '<script>
				alert("username is already used");
			</script>';
			$this->register();
		}
	}
	
	// Adminstrator
	public function manage_member()
	{
		$data['members'] = $this->Member_model->getMember();
		$this->load->view('manage_member', $data);
	}

	public function delete($id)
	{
		$this->Member_model->deleteMember($id);
		$this->manage_member();
	}

	public function manage_goods()
	{
		$data['goods'] = $this->Goods_model->getGoods();
		$this->load->view('manage_goods', $data);
	}
	// Adminstrator
}
