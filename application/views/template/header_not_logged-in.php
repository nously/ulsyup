<html>
<head>
	<title>Ulsyup!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/stylesheet.css">
</head>

<body>

	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo base_url(); ?>">
						<img src="https://vignette2.wikia.nocookie.net/gtawiki/images/9/9a/PlayStation_1_Logo.png">
					</a>
				</div>

				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="<?php echo base_url(); ?>Members/login">Login</a>
					</li>
					<li>
						<a href="<?php echo base_url(); ?>Members/register">Register</a>
					</li>
				</ul>
				
				<form class="navbar-form navbar-right" id="search" method="get" action="<?php echo base_url(); ?>Pages">
					<div class="form-group">
						<input type="text" name="keyword" placeholder="Search">
					</div>

					<input type="submit" name="search" value="Search">
				</form>
			</div>
		</nav>
	</header>