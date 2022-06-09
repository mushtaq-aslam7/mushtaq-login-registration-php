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
	<form class="login-form" action="login.php" method="post" style="text-align: center;">
		<p>
			We sent an email to  <b><?php echo $_GET['email'] ?></b> to help you recover your account. 
		</p>
	    <p>Please login into your email account and click on the link we sent to reset your password</p>
	</form>
</div>
</div>
</div>
		
</body>
</html>