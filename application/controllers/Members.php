<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

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
			$this->load->view('login');
		else
			header('location: ' . base_url());
	}

	public function login_process()
	{
		$user_data = $this->Member_model->getMember($_POST['username'], md5($_POST['password']))[0];
		if ($user_data && $user_data['role'] !== '1')
		{

			$_SESSION['username'] = $user_data['username'];
			$_SESSION['password'] = $user_data['password'];
			$_SESSION['role'] = $user_data['role'];
									
		}
		else
		{
			echo "<script>alert('Username or password are incorrect');</script>";
		}
		echo "<script>window.location = '". base_url() ."';</script>";
	}

	/* METHOD REGISTER!!!!!! */
	public function register()
	{
		$this->load->view('register');
	}

	/* SETELAH PENCET REGISTER!!!!!!!! */
	public function register_process()
	{
		// ngambil data dari form
		$user_data = array();
		$user_data['username'] = $_POST['username'];
		$user_data['password'] = md5($_POST['password']);
		$user_data['fullname'] = $_POST['fullname'];
		$user_data['birth_place'] = $_POST['bp'];
		$user_data['birth_date'] = $_POST['bd'];
		$user_data['handphone'] = $_POST['telephone'];
		$user_data['email'] = $_POST['email'];
		$user_data['role'] = 2;
		$user_data['topup'] = 0;

		// masukkan data ke database
		$result = $this->Member_model->insertMember($user_data);

		// jika registrasi berhasil, halaman login ditampilkan
		if ($result !== 0)
		{
			$this->login();
		}

		// jika gagal, halaman register ditampilkan lagi
		else if ($result === 0)
		{
			echo '<script>
				alert("username is already used");
			</script>';
			$this->register();
		}
	}

	public function logout()
	{
		session_destroy();
		header('location: ' . base_url());
	}

	public function updateProfile()
	{
		$data['user'] = $this->Member_model->getDetail($_SESSION['username']);
		$this->load->view('update_profile', $data);
	}

	public function updateProfileProcess()
	{
		$dataUser['username'] = $_SESSION['username'];
		$dataUser['picture'] = $this->upload_photo();
		$dataUser['fullname'] = $_POST['fullname'];
		$dataUser['handphone'] = $_POST['handphone'];
		$dataUser['email'] = $_POST['email'];
		$this->Member_model->update($dataUser);
		header('location: ' . base_url() . 'Pages/profile/' . $_SESSION['username']);
	}

	public function upload_photo()
	{
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/ulsyup/img/member/";
		$target_file = $target_dir . basename($_FILES["picture"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["update"])) {
			$check = getimagesize($_FILES["picture"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file))
				{
					return base_url() . 'img/member/' . $_FILES["picture"]["name"];
				}
				else
				{
					echo "gagal upload";
					return null;
				}
			} else {
				echo "File is not an image.";
				return null;
			}
		}
	}
}
