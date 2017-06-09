<?php $notifications = $this->Notification_model->get_notification(); ?>

<html>
<head>
	<script src="https://use.fontawesome.com/c9621634e6.js"></script>
	<title>Ulsyup!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-notifications-master/dist/stylesheets/bootstrap-notifications.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/stylesheet.css">
</head>

<body>
	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo base_url(); ?>">
						<img src="https://vignette2.wikia.nocookie.net/gtawiki/images/9/9a/PlayStation_1_Logo.png">
					</a>
				</div>

				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="<?php echo base_url() . 'Pages/message'; ?>">
							<i class="fa fa-envelope-square fa-2x" aria-hidden="true"></i>
						</a>
					</li>
					<li class="dropdown">

						<!-- Trigger!!!!!!!!!!!!!!!!!! -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notification-trigger">
							<?php if (isset($notifications[0]) && $notifications[0]['unread']): ?>
								<i data-count="!" class="glyphicon glyphicon-bell notification-icon" style="font-size:30px;"></i>
							<?php else: ?>
								<i class="fa fa-bell-o fa-2x"></i>
							<?php endif; ?>
						</a>

						<ul class="dropdown-menu" id="notification-dropdown">
							<!-- Notifications!!!!!!!!!!!!!!!!!!!!! -->
							<?php foreach($notifications as $notification): ?>
								<li class="notification">
									<div class="media">
										<div class="media-left">
											<!-- Image -->
											<div class="media-object">
												<?php if ($notification['notification_type'] === '1'): ?>
													<i class="fa fa-envelope fa-3x" aria-hidden="true"></i>
												<?php elseif ($notification['notification_type'] === '3'): ?>
													<i class="fa fa-money fa-3x" aria-hidden="true"></i>
												<?php elseif ($notification['notification_type'] === '2'): ?>
													<i class="fa fa-exclamation-circle fa-3x" aria-hidden="true"></i>
												<?php endif; ?>
											</div>
										</div>
										<div class="media-body">
											<strong class="notification-title"><?php echo $notification['activity']; ?></strong>
											<?php if ($notification['unread']): ?>
												<i class="glyphicon glyphicon-exclamation-sign" style="font-size:10px; color: red;"></i>
											<?php endif; ?>
											<div class="notification-meta">
												<small class="timestamp"><?php echo $notification['timestamp']; ?></small>
											</div>
										</div>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</li>

					<li>
						<a href="<?php echo base_url(); ?>Members/logout">Logout</a>
					</li>
				</ul>
				
				<form class="navbar-form navbar-right" id="search" method="get" action="<?php echo base_url(); ?>Pages">
					<div class="form-group">
						<input type="text" name="keyword" placeholder="Search">
					</div>

					<input type="submit" name="search" value="Search">
				</form>
				
			</div>
		</nav>
	</header>

<script>
var notif = document.querySelector('li.dropdown');

notif.onclick = function(){
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "http://localhost/ulsyup/Notifications/read_notification/<?php echo $_SESSION['username']; ?>", true);
	xhttp.send();
};

function loadnotification()
{
	var xhr = new XMLHttpRequest();
	var url = "http://localhost/ulsyup/Notifications/a/";
	
	xhr.open('GET', url, true);
	
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState === 4 && xhr.status === 200)
		{
			notif.innerHTML = xhr.responseText;
		}
	};
	
	xhr.send(null);
	
	setTimeout(loadnotification, 500);
}

window.onload = loadnotification();

</script>