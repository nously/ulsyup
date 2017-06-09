<?php if (isset($_SESSION['username'])) include "template/header.php";
 	else include "template/header_not_logged-in.php"; ?>

<div id="side-panel">
	<a href="<?php echo base_url() . 'Pages/profile/' . $member['username']; ?>"><?php echo $member['fullname']; ?></a>
</div> <!-- #side-panel -->

<div id="content">
	<div id="goods">
		<?php foreach ($goods as $thing): ?>
			<div class="thing">
				<a href="<?php echo base_url() . 'Pages/goodsDetail/' . $thing['goods_id']; ?>"><?php echo $thing['title']; ?></a>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<?php include "template/footer.php" ?>