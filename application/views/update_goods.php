<?php include "template/header.php"; ?>

<form action="<?php echo base_url(); ?>Goods/updateGoodsProcess/<?php echo $goods_detail['goods_id']; ?>" method="post" enctype="multipart/form-data">
	<input type="file" name="picture">
	<input type="text" placeholder="Title" name="title" value="<?php echo $goods_detail['title']; ?>">
	<input type="number" placeholder="price" name="price" value="<?php echo $goods_detail['price']; ?>">
	<input type="text" placeholder="category" name="category" value="<?php echo $goods_detail['category']; ?>">
	<input type="text" placeholder="description" name="description" value="<?php echo $goods_detail['description']; ?>">
	<input type="number" placeholder="stock" name="stock" value="<?php echo $goods_detail['stock']; ?>">

	<input type="submit" placeholder="Update" name="update">	
</form>

<?php include "template/footer.php" ?>