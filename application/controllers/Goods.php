<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods extends CI_Controller {

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

	public function delete($id)
	{
		$this->Goods_model->deleteGoods($id);
		header('location: ' . base_url() . 'Admin/manage_goods');
	}

	public function verify($id)
	{
		$this->Goods_model->verifyGoods($id);
		header('location: ' . base_url() . 'Admin/manage_goods');
	}

	public function updateGoods($id)
	{
		$data['goods_detail'] = $this->Goods_model->getDetail($id);
		$this->load->view('update_goods', $data);
	}

	// upload mechanism is not implemented yet
	public function updateGoodsProcess($id)
	{
		$goods_detail = $this->Goods_model->getGoods($id);

		if ($_FILES["picture"]['name']) $pic_url = $this->upload_photo();
		else 
		{
			$this->delete_photo($goods_detail[0]['picture']);
			$pic_url = $_SERVER['DOCUMENT_ROOT'] . '/ulsyup/img/goods/default.png';
		}

		$title = $_POST['title'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$stock = $_POST['stock'];
		$category = $_POST['category'];

		$this->Goods_model->update($id, $title, $category, $pic_url, $price, $description, $stock);
		header('location: ' . base_url() . 'Pages/profile/' . $_SESSION['username']);
	}

	public function add_goods()
	{
		if (isset($_SESSION['username']))
			$this->load->view('add_goods');
		else
			header('location: ' . base_url());
	}

	// upload mechanism is not implemented yet
	public function add_goods_process()
	{
		if ($_FILES["picture"]['name']) $pic_url = $this->upload_photo();
		else $pic_url = base_url() . 'img/goods/default.png';

		$this->Goods_model->insert($_POST['title'], $_POST['category'], $pic_url, $_POST['price'], $_POST['description'], $_POST['stock']);

		header('location: ' . base_url() . 'Pages/profile/' . $_SESSION['username']);
	}

	public function delete_photo($file)
	{
		if (unlink($file))
		{
			echo "berhasil";
		}
		else
		{
			echo "gagal";
		}
	}

	public function upload_photo()
	{
		print_r($_FILES);
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/ulsyup/img/goods/";
		$target_file = $target_dir . basename($_FILES["picture"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["addproduct"]) || isset($_POST["update"])) {
			$check = getimagesize($_FILES["picture"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file))
				{
					return base_url() . 'img/goods/' . $_FILES["picture"]["name"];
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
