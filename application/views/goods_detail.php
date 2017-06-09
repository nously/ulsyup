<?php 
(isset($_SESSION['username']))? 
include 'template/header.php': 
include 'template/header_not_logged-in.php'; 
?>

<?php # This page will be the main page of transaction process ?>
<div class="container">
	<div class="row">
		<div id="main-panel-goods-detail" class="col-md-9">
			<div id="goods-detail">
				<div id="goods-title">
					<?php if ($goods['stock'] === '0'): ?>
						<span style="color: #333; display: inline-block; background: #f9f9f9; padding: 10px; border: 1px solid red; width: 100px; text-align: center; margin-right: 10px; border-radius: 5px;">
						 	<?php echo "HABIS"; ?>
						</span> 
					<?php endif; ?>
					<div style="font-size: 2em; display: inline-block; font-weight: bolder;"><?php echo $goods['title']; ?></div>
				</div>
				
				<div class="row">
					<div class="col-md-6" id="goods-picture-container">
						<img src="<?php echo $goods['picture']; ?>" id="goods-picture">
					</div>

					<div class="col-md-6" style="padding: 15px 15px 15px 25px;">
						<p>
							<?php echo $goods['description']; ?>
						</p>
					</div>			
				</div>
			</div>

			<div id="comments">
				<h3>Comments</h3>
				<hr>
				<?php foreach($comments as $comment): ?>
					<div class="comment">
						<div class="comment-header">
							<div class="hapus-edit">
								<?php if (isset($_SESSION['username']) && $comment['username_fk'] === $_SESSION['username']): ?>
									<a class="hapus" href="<?php echo base_url(); ?>Comments/delete_comment/
										<?php echo $comment['comment_id'] . '/' . $goods['goods_id']; ?>">
										Hapus
									</a>

									<a href="<?php echo base_url(); ?>Comments/edit_comment/<?php echo $comment['comment_id'] . '/' . $goods['goods_id']; ?>">Edit</a> 
								<?php endif; ?>
							</div>

							<div class="commentator_identity">
								<a href="#"><?php echo $comment['username_fk']; ?></a> said
							</div>
						</div>

						<div class="coment-content">
							<p>
								<?php echo $comment['comment']; ?>
							</p>
						</div>

						<small><span style="color: #aaa; text-align: right; display: block;"><?php echo $comment['sending_time']; ?></span></small>
					</div>
				<?php endforeach; ?>
				<hr>
				<?php if (isset($_SESSION['username']) /* && $seller['username'] !== $_SESSION['username']*/): ?>
					<form id="comment-form" action="<?php echo base_url(); ?>Comments/add_comment" method="post">
						<div class="form-group">
							<label>
								Type Your Comment:<br>
								<textarea class="form-control" name="comment_content" <?php if ($goods['stock'] === '0') echo "disabled"; ?>></textarea>
							</label>
						</div>
						
						<input type="hidden" value="<?php echo $goods['goods_id']; ?>" name="goods_id">
						<input type="hidden" value="<?php echo $seller['username']; ?>" name="seller_username_fk">
						<input type="hidden" value="<?php echo $goods['title']; ?>" name="goods_title">
						

						<div class="form-group" id="comment-button">
							<button class="btn btn-default" type="submit" value="Send!" name="send_comment" <?php if ($goods['stock'] === '0') echo "disabled"; ?>>Send!</button>
						</div>

					</form>
				<?php endif; ?>
			</div>
		</div>

		<div id="right-panel" class="col-md-3">
			<div id="price-detail" class="panel panel-default">
				<div class="panel-heading">Price</div>
				<div id="price" class="panel-body">Rp <?php echo $goods['price']; ?>,-</div>
			</div>
			
			<!-- If this link clicked, seller will be anounced -->
			<?php if (isset($_SESSION['username']) && $_SESSION['username'] !== $seller['username']): ?>
				<a href="<?php echo base_url().'Transactions/buy/'.$goods['goods_id'].'/'.$_SESSION['username'].'/'.$seller['username']; ?>">
					<div id="buy-goods"><i style="color: yellow; font-size: .7em" class="glyphicon glyphicon-shopping-cart"></i>&nbsp;&nbsp;Buy</div>
				</a>
			<?php endif; ?>

			<div id="seller-detail" class="panel panel-default">
				<div class="panel-heading">Penjual</div>
				<div class="panel-body" style="text-align: center;">
					<a href="<?php echo base_url(); ?>Pages/profile/<?php echo $seller['username']; ?>">
					<img src="<?php echo $seller['photo']; ?>" style="width: 30%; margin-bottom: 20px; border-radius: 5px; border: 1px solid #ddd;">
					<br>
					</a>
					<a href="<?php echo base_url(); ?>Pages/profile/<?php echo $seller['username']; ?>"><?php echo $seller['fullname']; ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('template/footer.php'); ?>