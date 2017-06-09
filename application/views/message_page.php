<?php include "template/header.php"; ?>

<h2>Chat Box</h2>

<div class="row">
	<div id="sender_list" class="col-md-3">
		<?php if (isset($users[0])): ?>
			<?php foreach ($users as $user) : ?>
				<a href="<?php echo base_url() . 'Messages/message_from/' . $user['username']; ?>">
					<div class="sender">
						<img width="50px" class="message_photo" src="<?php echo $user['photo']; ?>">
						<?php echo $user['fullname']; ?>
					</div>
				</a>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (isset($user_klicked)): ?>
			<a href="<?php echo base_url(); ?>Pages/message">New Chat</a>
		<?php endif; ?>
	</div>

	<div id="messages_box" class="col-md-7">
		<div id="messages">
			<?php if (isset($user_klicked)): ?>
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
		</div>
		<br>
		<div id="type_message">
			<form action="<?php echo base_url() . 'Messages/send'; ?>" method="post" class="form-inline">
				<div class="form-group">
						<input class="form-control" type="text" name="username_receiver_fk" autofocus placeholder="Your Friend ID"
						<?php if (isset($user_klicked)) echo "disabled value='" . $user_klicked . "'"; ?>>
				</div>
				<div class="form-group" id="type-message-field">
					<input class="form-control" type="text" name="message" autofocus placeholder="Type Your Message">
				</div>

				<?php if (isset($user_klicked)): ?>
					<input type="hidden" name="username_receiver_fk" value="<?php echo $user_klicked; ?>">
				<?php endif; ?>
				<input type="hidden" name="username_sender_fk" value="<?php echo $_SESSION['username']; ?>">
				
				<button type="submit" value="Send!" name="send_message" class="btn btn-default">Send!</button>
			</form>
		</div>
	</div>
</div>

<script>
	var messages = document.querySelector('#messages');

	function loadMessage()
	{
		var xhr = new XMLHttpRequest();
		var url = "http://localhost/ulsyup/Messages/loadMessage/<?php echo $user_klicked; ?>";
		
		xhr.open('GET', url, true);
		
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState === 4 && xhr.status === 200)
			{
				messages.innerHTML = xhr.responseText;
			}
		};
		
		xhr.send(null);
		
		setTimeout(loadMessage, 500);
	}

	window.onload = loadMessage();
</script>

<?php include "template/footer.php"; ?>