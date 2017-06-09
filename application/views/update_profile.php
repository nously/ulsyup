<?php include "template/header.php"; ?>


<div class="container">
	<fieldset>
		<legend>Edit Profile</legend>
		<form method="post" action="<?php echo base_url() . 'Members/updateProfileProcess' ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label>
					Upload Your New Photo
					<input type="file" name="picture">
				</label>
			</div>

			<div class="form-group">
				<label>
					Update Your Fullname
					<input type="text" placeholder="Fullname" name="fullname" value="<?php echo $user['fullname']; ?>" class="form-control">
				</label>
			</div>
			<div class="form-group">
				<label>
					Update Your Handphone Number
					<input type="tel" placeholder="Handphone" name="handphone" value="<?php echo $user['handphone']; ?>" class="form-control">
				</label>
			</div>
			<div class="form-group">
				<label>
					<input type="email" placeholder="Email" name="email" value="<?php echo $user['email']; ?>" class="form-control">
				</label>
			</div>

			<button type="submit" value="Update" name="update" class="btn btn-default">Update</button>
		</form>
	</fieldset>
</div>

<?php include "template/footer.php"; ?>