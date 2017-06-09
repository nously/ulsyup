<?php include "template/header_not_logged-in.php"; ?>

<div id="login-form">
	<form class="form-horizontal" action="<?php echo base_url(); ?>Admin/login_process" method="post">
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="inputEmail" placeholder="Username" name="username" autofocus>
			</div>
		</div>

		<div class="form-group">
			<label for="inputPassword" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default" value="Login" name="login">Sign in</button>
			</div>
		</div>
	</form>
</div>



<?php include "template/footer.php"; ?>