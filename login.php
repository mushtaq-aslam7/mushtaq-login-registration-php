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
  <title>User verification system PHP - Login</title>
  <!-- error message -->
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth login">
      <?php 
          if (isset($_GET['status'])) {
            if ($_GET['status'] == 'error') {
              echo "<div class='alert alert-danger'>".$messages[$_REQUEST['code']]."</div>";
            } else {
              echo "<div class='alert alert-success'>".$messages[$_REQUEST['code']]."</div>";
            }
          }

        ?>
        <h3 class="text-center form-title">Login</h3>
        <form action="controllers/authController.php" method="post">
          <div class="form-group">
            <label>Username<strong class="text-danger">*</strong> </label>
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo ($username) ?? ''; ?>">
          </div>
          <div class="form-group">
            <label>Password<strong class="text-danger">*</strong></label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <button type="submit" name="login-btn" class="btn btn-lg btn-block">Login</button>
          </div>
        </form>
        <p><a href="enter_email.php">Forgot your password?</a></p>
        <p>Don't yet have an account? <a href="signup.php">Sign up</a></p>
      </div>
    </div>
  </div>
</body>
</html>