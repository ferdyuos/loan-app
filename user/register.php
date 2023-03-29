<?php include('../functions.php') ;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Smart loan</title>
	<link rel="stylesheet" type="text/css" href="../loan.css">
</head>
<body>
	<div class="header">
		<h2>User Register</h2>
	</div>
	<form method="post" action="register.php">

		<?php echo display_error(); ?>

        <div class="input-group">
			<label>First Name</label>
			<input type="text" name="first_name" >
		</div>

        <div class="input-group">
			<label>Last Name</label>
			<input type="text" name="last_name" >
		</div>

		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" >
		</div>
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>

		<div class="input-group">
			<label>Matric Number</label>
			<input type="text" name="matric" >
		</div>

		<div class="input-group">
			<label>Department</label>
			<input type="text" name="department" >
		</div>

		<div class="input-group">
			<label>Hostel</label>
			<input type="text" name="hostel" >
		</div>

		<div class="input-group">
			<label>NIN</label>
			<input type="text" name="nin" >
		</div>
		<div class="input-group">
			<label>BVN</label>
			<input type="text" name="bvn" >
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
			<button type="submit" class="btn" name="user_register_btn">Register</button>
		</div>
	</form>
</body>
</html>