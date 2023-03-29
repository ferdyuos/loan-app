<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Smart loan</title>
	<link rel="stylesheet" type="text/css" href="../loan.css">
</head>
<body>
	<div class="header">
		<h2>Entity Register</h2>
	</div>
	<form method="post" action="register.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" >
		</div>
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" >
		</div>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>CAC Number</label>
			<input type="number" name="cac" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
        <div class="input-group">
			<label>Confirm Password</label>
			<input type="password" name="confirm_password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="entity_register_btn">Register</button>
		</div>
	</form>
</body>
</html>