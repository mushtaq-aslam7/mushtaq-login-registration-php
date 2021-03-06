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
  <title>User verification system PHP</title>
  
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth">
      <?php 
          if (isset($_GET['status'])) {
            if ($_GET['status'] == 'error') {
              echo "<div class='alert alert-danger'>".$messages[$_REQUEST['code']]."</div>";
            } else {
              echo "<div class='alert alert-success'>".$messages[$_REQUEST['code']]."</div>";
            }
          }

        ?>
        <h3 class="text-center form-title">Sign Up</h3>
        <form action="controllers/authController.php" method="post">
          <div class="form-group">
            <label>Username <strong class="text-danger">*</strong></label>
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo ($username) ?? ''; ?>">
          </div>
          <div class="form-group">
            <label>Email<strong class="text-danger">*</strong></label>
            <input type="text" name="email" class="form-control form-control-lg" value="<?php echo ($email) ?? ''; ?>">
          </div>
          <div class="form-group">
            <label>Password<strong class="text-danger">*</strong></label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <label>Password Confirm<strong class="text-danger">*</strong></label>
            <input type="password" name="passwordConf" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <button type="submit" name="signup-btn" class="btn btn-lg btn-block">Sign Up</button>
          </div>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
</body>
</html>