<?php $messages = $this->Message_model->get_messages($sender_username, $_SESSION['username']); ?>
<?php if (isset($sender_username)): ?>
	<?php foreach ($messages as $message): ?>
		<div class="message">
			<?php
				if ($message['username_sender_fk'] === $_SESSION['username'])
				{
					echo '<div class="message-from-me">' . $message['message'] . '<span class="date"> - '. $message['sending_time'] .'</span>' . '</div>';
				}
				else
				{
					echo "<div class='message-from-them'>" .'<span class="date">'. $message['sending_time'] .' - </span>'. $message['message'] . "</div>";
				}
			?>
		</div>
	<?php endforeach; ?>
<?php endif; ?>