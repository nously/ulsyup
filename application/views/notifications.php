<?php $notifications = $this->Notification_model->get_notification(); ?>

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