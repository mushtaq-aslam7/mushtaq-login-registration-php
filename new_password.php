<?php 
session_start();
 $_SESSION['email']=$_GET['email'];
 $_SESSION['token']=$_GET['token'];
 include "messages.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div class="container">
	<div class="row">
		<div class="col-md-4 offset-md-4 form-wrapper auth login">
		<h3 class="text-center form-title">New Password</h3>
		<?php 
          if (isset($_GET['status'])) {
            if ($_GET['status'] == 'error') {
              echo "<div class='alert alert-danger'>".$messages[$_REQUEST['code']]."</div>";
            } else {
              echo "<div class='alert alert-success'>".$messages[$_REQUEST['code']]."</div>";
            }
          }

        ?>
	<form class="login-form" action="resetLogic.php" method="post">
		
		
		<!-- form validation messages -->
		
		<div class="form-group">
			<label>New password</label>
			<input type="password" name="new_pass" class="form-control form-control-lg">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c" class="form-control form-control-lg">
		</div>
		<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
		<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
		<div class="form-group">
			<button type="submit" name="new_password" class="btn btn-lg btn-block">Submit</button>
		</div>
		
		
	</form>
</div>
</div>
</div>
</body>
</html>