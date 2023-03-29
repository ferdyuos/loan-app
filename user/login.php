<?php include('../functions.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Smartloan</title>
	<link rel="stylesheet" type="text/css" href="../loan.css">
</head>
<body>
	<div class="header">
		<h2>User Login</h2>
	</div>
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="user_login_btn">Login</button>
		</div>
	</form>
</body>
</html>