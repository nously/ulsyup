<?php 
(isset($_SESSION['username']))? 
include 'template/header.php': 
include 'template/header_not_logged-in.php'; 
?>


<div class="container">
	<div class="row">
		<div id="side-panel" class="col-md-2">
			<div id="brief-profile">
				<div id="photo-and-name">
					<?php if (isset($_SESSION['username']) && $_SESSION['username'] === $member['username']): ?>
						<a href="<?php echo base_url(); ?>Members/updateProfile">
							<img src="<?php echo $member['photo']; ?>">
							<?php echo $member['fullname']; ?>
						</a>
					<?php elseif(isset($_SESSION['username'])): ?>
						<a href="<?php echo base_url() . "Messages/message_from/" . $member['username'] ; ?>">
							<img src="<?php echo $member['photo']; ?>">
							<?php echo $member['fullname']; ?>
						</a>
					<?php else: ?>
						<a href="#">
							<img src="<?php echo $member['photo']; ?>">
							<?php echo $member['fullname']; ?>
						</a>
					<?php endif; ?>
				</div>
				<i class="glyphicon glyphicon-credit-card"></i> Rp <?php echo $member['topup']; ?>
			</div>
			<?php if (isset($_SESSION['username']) && $_SESSION['username'] === $member['username']): ?>
				<div style="margin-top: 20px;">
					<a class="btn btn-primary" href="<?php echo base_url() . 'Goods/add_goods'; ?>">Add Product</a>
				</div>
			<?php endif; ?>
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
					<?php if (isset($_SESSION['username']) && $_SESSION['username'] === $member['username']): ?>
						<a href="<?php echo base_url() . 'Goods/updateGoods/' . $thing['goods_id']?>">
							<div class="thing">
								<img src="<?php echo $thing['picture']; ?>" style="margin-bottom: 0px; padding-bottom: 0px;">
								<?php if ($thing['verified'] === '0') echo "<span style='padding:3px; display: block;border-radius:2px; background: #ddd; '>Unverified</span>"; ?>
								<div style="box-sizing: border-box; padding: 10px; margin-top: 2px;">
									<p><?php echo $thing['title']; ?></p>
									<i class="glyphicon glyphicon-tag"></i>&nbsp;
									<span class="price"><strong>Rp <?php echo $thing['price']; ?></strong></span>
								</div>
							</div>
						</a>
					<?php elseif($thing['verified']): ?>
					<a href="<?php echo base_url() . 'Pages/goodsDetail/' . $thing['goods_id']; ?>">
							<div class="thing">
								<img src="<?php echo $thing['picture']; ?>" style="margin-bottom: 0px; padding-bottom: 0px;">
								<?php if ($thing['verified'] === '0') echo "<span style='padding:3px; display: block;border-radius:2px; background: #ddd; '>Unverified</span>"; ?>
								<div style="box-sizing: border-box; padding: 10px; margin-top: 2px;">
									<p><?php echo $thing['title']; ?></p>
									<i class="glyphicon glyphicon-tag"></i>&nbsp;
									<span class="price"><strong>Rp <?php echo $thing['price']; ?></strong></span>
								</div>
							</div>
						</a>
					<?php endif; ?>

				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>





<?php include "template/footer.php" ?>