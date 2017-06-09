<?php include "template/header_not_logged-in.php"; ?>

<div id="register-form">
<fieldset>
	<legend>Register Now And Become Success!</legend>
		<form action="<?php echo base_url(); ?>Members/register_process" method="post">
			<div class="form-group">
				<label>
					Choose a Username
					<input type="text" placeholder="Username" class="form-control" name="username" required>
				</label>
			</div>

			<div class="form-group">
				<label>
					Password
					<input type="password" placeholder="Password" class="form-control" name="password" required>
				</label>
			</div>

			<div class="form-group">
				<label>
					Fullname
					<input type="text" placeholder="Fullname" class="form-control" name="fullname" required>
				</label>
			</div>

			<div class="form-group">
				<label>
					Birth Place
					<input type="text" placeholder="Birth place" class="form-control" name="bp" required>
				</label>
			</div>

			<div class="form-group">
				<label>
					Birth Date
					<input type="date" name="bd" class="form-control" required>
				</label>
			</div>

			<div class="form-group">
				<label>
					Telephone
					<input type="tel" name="telephone" class="form-control" placeholder="Telephone" required>
				</label>
			</div>

			<div class="form-group">
				<label>
					E-Mail
					<input type="email" name="email" class="form-control" placeholder="E-mail" required>
				</label>
			</div>
			<button type="submit" class="btn btn-default" value="Register" name="register">Register</button>
		</form>
	</fieldset>
</div>

<?php include "template/footer.php"; ?>