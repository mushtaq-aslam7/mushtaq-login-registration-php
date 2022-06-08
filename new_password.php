<?php

	$email=$_GET['email'];
	echo $email;
	$token= $_GET['token'];
	echo $token;

?>
<?php include 'controllers/authController.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<form class="login-form" action="new_password.php" method="post">
		<h2 class="form-title">New password</h2>
		
		<!-- form validation messages -->
		<?php include('messages.php'); ?>
		<div class="form-group">
			<label>New password</label>
			<input type="password" name="new_pass">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c">
		</div>
		<input type="hidden" name="token" value="<?php $_GET['token']; ?>">
		<input type="hidden" name="email" value="<?php $_GET['email']; ?>">
		<div class="form-group">
			<button type="submit" name="new_password" class="login-btn">Submit</button>
		</div>
		
		
	</form>
</body>
</html>