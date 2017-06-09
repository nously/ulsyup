<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

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

	public function loadMessage($sender_username)
	{
		$data['sender_username'] = $sender_username;
		$this->load->view('messages', $data);
	}

	public function message_from($sender_username)
	{
		$data['messages'] = $this->Message_model->get_messages($sender_username, $_SESSION['username']);
		$data['user_klicked'] = $sender_username;
		$users_fk = $this->Message_model->get_related_users($_SESSION['username']);
		$data['users'] = $this->Member_model->get_users($users_fk);
		$this->load->view('message_page', $data);
	}

	public function send()
	{
		if ($_SESSION['username'] !== $_POST['username_receiver_fk'])
		{
			$sender_fullname = $this->Member_model->getDetail($_SESSION['username'])['fullname'];

			$string = 'You\'ve got a <a href="'. base_url() . 'Messages/message_from/' . $_SESSION['username'] .'">messsage</a> from <a href="'. 
						base_url() . 'Pages/profile/' . $_SESSION['username'] .'">' . 
						$sender_fullname . '</a>';

			$new_message = array('username_sender_fk' => $_POST['username_sender_fk'], 
				'username_receiver_fk' => $_POST['username_receiver_fk'],
				'message' => $_POST['message']);
			$this->Message_model->create_message($new_message);
			$this->Notification_model->insert_notification($_POST['username_receiver_fk'], $string, 1);
		}

		header('location: ' . base_url() . 'Messages/message_from/' . $_POST['username_receiver_fk']);
	}

	public function buy($goods_id, $seller)
	{
		$sender_fullname = $this->Member_model->getDetail($_SESSION['username'])['fullname'];
		$goods_title = $this->Goods_model->getDetail($goods_id)['title'];

		$string = '<a href="' . base_url() . 'Pages/profile/' . $_SESSION['username'] . '">' . $sender_fullname . '</a> wants to buy <a href="'. 
				base_url() . 'Pages/goodsDetail/' . $goods_id .'">' . $goods_title . '</a> from you. Let\'s 
				<a href="'. base_url() . 'Messages/message_from/' . $_SESSION['username'] .'">Chat!</a>';

		$new_message = array('username_sender_fk' => $_SESSION['username'], 
			'username_receiver_fk' => $seller,
			'message' => 'Hey! I want to buy <a href="'. 
				base_url() . 'Pages/goodsDetail/' . $goods_id .'">' . $goods_title . '</a> from you!');
		$this->Message_model->create_message($new_message);
		$this->Notification_model->insert_notification($seller, $string, 3);

		header('location: ' . base_url() . 'Messages/message_from/' . $seller);
	}

}