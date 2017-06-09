<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

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

	public function add_comment()
	{
		// echo "barang: " . $_POST['goods_id'];
		// echo "Orang yang komen: " . $_SESSION['username'];
		// echo "Isi komen: " . $_POST['comment_content'];
		$commenter_fullname = $this->Member_model->getDetail($_SESSION['username'])['fullname'];

		$string = '<a href="'. base_url() . 'Pages/profile/' . $_SESSION['username'] .'">' . $commenter_fullname . 
					'</a> commented on <a href="' . base_url() . 'Pages/goodsDetail/' . $_POST['goods_id'] . '">'. $_POST['goods_title'] .'</a>';

		$this->Comment_model->insert_comment($_SESSION['username'], $_POST['goods_id'], $_POST['comment_content']);
		if ($_POST['seller_username_fk'] !== $_SESSION['username']) 
			$this->Notification_model->insert_notification($_POST['seller_username_fk'],
																$string, 2);

		header('location: ' . base_url() . 'Pages/goodsDetail/' . $_POST['goods_id']);
	}

	public function delete_comment($comment_id, $goods_id)
	{
		$this->Comment_model->delete_comment($comment_id);
		header('location: ' . base_url() . 'Pages/goodsDetail/' . $goods_id);
	}

	public function edit_comment($comment_id, $goods_id)
	{
		$data['comment_id'] = $comment_id;
		$data['goods_id'] = $goods_id;
		$this->load->view('edit_comment', $data);
	}

	public function edit_comment_process()
	{
		$this->Comment_model->edit_comment($_POST['comment_id'], $_POST['comment_content']);
		header('location: ' . base_url() . 'Pages/goodsDetail/' . $_POST['goods_id']);
	}

}