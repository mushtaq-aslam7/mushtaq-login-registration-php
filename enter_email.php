<?php
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
	<form class="login-form" action="resetLogic.php" method="post">
	<?php 
          if (isset($_GET['status'])) {
            if ($_GET['status'] == 'error') {
              echo "<div class='alert alert-danger'>".$messages[$_REQUEST['code']]."</div>";
            } else {
              echo "<div class='alert alert-success'>".$messages[$_REQUEST['code']]."</div>";
            }
          }

        ?>
		<h2 class="form-title">Reset password</h2>
		<!-- form validation messages -->
	
		<div class="form-group">
			<label>Your email address</label>
			<input type="email" name="email" class="form-control form-control-lg">
		</div>
		<div class="form-group">
			<button type="submit" name="reset-password" class="btn btn-lg btn-block">Submit</button>
		</div>
	</form>
</div>
</div>

</div>
</body>
</html>