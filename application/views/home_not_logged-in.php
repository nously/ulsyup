<?php include "template/header_not_logged-in.php"; ?>

<?php

function fullnameOf($username, $members)
{
	$fullname;
	foreach ($members as $person)
	{
		if ($person['username'] === $username)
		{
			$fullname = $person['fullname'];
		}
	}
	return $fullname;
}

?>

<div class="row container">
	<div id="side-panel" class="col-md-2">		
		<div class="panel panel-default" id="categories">
			<div class="panel-heading">Categories</div>
				<ul class="list-group">
					<li class="list-group-item">
						<a href="<?php echo base_url() . 'Pages/index?category=Toys'; ?>">Toys</a>
					</li>
					<li class="list-group-item">
						<a href="<?php echo base_url() . 'Pages/index?category=Electronics'; ?>">Electronics</a>
					</li>
					<li class="list-group-item">
						<a href="<?php echo base_url() . 'Pages/index?category=Fashion'; ?>">Fashion</a>
					</li>
					<li class="list-group-item">
						<a href="<?php echo base_url() . 'Pages/index?category=Furniture'; ?>">Furniture</a>
					</li>
					<li class="list-group-item">
						<a href="<?php echo base_url() . 'Pages/index?category=Book'; ?>">Book</a>
					</li>
				</ul>
		</div>
	</div> <!-- #side-panel -->

	<div id="content" class="col-md-10">
		<div id="top">
			<?php if (isset($notif)): ?>
				<div class="alert alert-success" role="alert"><?php echo $notif; ?></div>
			<?php endif; ?>
		</div>

		<div id="goods">
			<?php if (!isset($goods[0])): ?>
				<span style="font-size: 2em; color: #999;">Oops... Seems Like There is No Product in Here.</span>
			<?php endif; ?>
			<?php foreach ($goods as $thing): ?>
				<a href="<?php echo base_url() . 'Pages/goodsDetail/' . $thing['goods_id']; ?>">
					<div class="thing">
						<img src="<?php echo $thing['picture']; ?>">
						<span class="thing-title"><?php echo $thing['title']; ?></span>
						<br>
						<i class="glyphicon glyphicon-tag"></i>
						<span class="price"><strong>Rp <?php echo $thing['price']; ?></strong></span>

						<div>
							<i class="glyphicon glyphicon-user"></i>
							<?php echo fullnameOf($thing['username_fk'], $members); ?>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php include "template/footer.php"; ?>