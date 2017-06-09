<?php 
	if(isset($_SESSION['username'])) include('template/header.php');
	else include('template/header_not_logged-in.php');
?>

<div class="container">
	<div>
		<form action="<?php echo base_url() . '/Comments/edit_comment_process' ?>" method="post">
			<textarea name="comment_content" cols="30" rows="10" class="form-control"></textarea>
			<input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
			<input type="hidden" name="goods_id" value="<?php echo $goods_id; ?>">
			<br>
			<button type="submit" value="Submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</div>

<?php include 'template/footer.php'; ?>