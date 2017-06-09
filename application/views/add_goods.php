<?php include "template/header.php"; ?>

<div class="container">
	<fieldset>
		<legend>Add A Product</legend>
		<form method="post" action="<?php echo base_url() . 'Goods/add_goods_process'; ?>" enctype="multipart/form-data" id="add-goods-form">
			<div class="form-group">
				<label>
					Product Title
					<input type="text" name="title" placeholder="Title" class="form-control">
				</label>
			</div>

			<div class="form-group">
				<label>
					Category <br>
					<input type="radio" name="category" placeholder="Category" value="Toys"> Toys <br>
					<input type="radio" name="category" placeholder="Category" value="Electronics"> Electronics <br>
					<input type="radio" name="category" placeholder="Category" value="Fashion"> Fashion <br>
					<input type="radio" name="category" placeholder="Category" value="Furniture"> Furniture <br>
					<input type="radio" name="category" placeholder="Category" value="Book"> Book
				</label>
			</div>

			<div class="form-group">
				<label>
					Price
					<input type="number" name="price" placeholder="Price" class="form-control">
				</label>
			</div>

			<div class="form-group">
				<label>
					Description
					<textarea name="description" placeholder="Description" class="form-control" cols="75" rows="20"></textarea>
				</label>
			</div>

			<div class="form-group">
				<label>
					Stock
					<input type="number" name="stock" placeholder="Stock" class="form-control">
				</label>
			</div>

			<div class="form-group">
				<label>
					Upload product picture
					<input type="file" name="picture" placeholder="Picture">
				</label>
			</div>

			<button type="submit" name="addproduct" value="Add Product" class="btn btn-default">Add Product</button>
		</form>
	</fieldset>
</div>

<?php include "template/footer.php"; ?>