<?php 

session_start();
require_once './vendor/autoload.php';

$user_id = "";
$message_code = '';
$error = '';

$conn = new mysqli('localhost', 'root', '', 'task');

//reset

  // ENTER A NEW PASSWORD
  if (isset($_POST['new_password'])) {
    // Grab to token that came from the email link
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    //grab email that came from the link
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if (empty($_POST['new_pass']) && empty($_POST['new_pass_c'])) {
      $message_code = '1004';
      $status = 'error';
  }
  else if (isset($_POST['new_pass']) && $_POST['new_pass'] !== $_POST['new_pass_c']) {
    
    $message_code = '1003';
    $status = 'error';
}

else{
  
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
    $new_pass_c = mysqli_real_escape_string($conn, $_POST['new_pass_c']);
  
    
  
  
  
    //echo $token;
  
    
    
      // select email address of user from the password_reset table 
      $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
      
      $results = mysqli_query($conn, $sql);
      
      $email = mysqli_fetch_assoc($results)['email'];
      // echo $new_pass;
      // echo $email;
      if ($email) {
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$new_pass' WHERE email='$email'";
        $results = mysqli_query($conn, $sql);
        header('location: changed.php');
      }
    }
    if ($message_code) {
      header('Location: new_password.php?status='.$status.'&code='.$message_code.'&token='.$token.'&email='.$email.'');
  }
  }
  // send reset email

if (isset($_POST['reset-password'])) {
  
  if (empty($_POST['email'])) {
    $message_code = '1000';
    $status = 'error';
}
else
{
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // ensure that the user exists on our system
    $query = "SELECT email FROM users WHERE email='$email'";
    $results = mysqli_query($conn, $query);
  
    if(mysqli_num_rows($results) <= 0) {
      $message_code = '1007';
      $status = 'error';
    }

    else{
    // generate a unique random token of length 100
    $token = bin2hex(random_bytes(50));
  
      // store token in the password-reset database table against the user's email
      $sql = "INSERT INTO password_resets(email, token) VALUES ('$email', '$token')";
      $results = mysqli_query($conn, $sql);
  
      $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 465, 'tls'))
  ->setUsername('378fac2c584972')
  ->setPassword('5c164ea85ce71f');
  
  // Create the Mailer using your created Transport
  $mailer = new Swift_Mailer($transport);
  
  $mailer;
      $body ="Hi there, click on this <a href=\"http://localhost:8000/task/new_password.php?token=" . $token . "&email=".$email."\">link</a> to reset your password on our site";
      ;
  
      // Create a message
      $message = (new Swift_Message('reset your password'))
          ->setFrom('admin@bee-it.com')
          ->setTo($email)
          ->setBody($body, 'text/html');
  
      // Send the message
      $result = $mailer->send($message);
      header('location: pending.php?email=' . $email);
  
    }
  }
  if ($message_code) {
    header('Location: enter_email.php?status='.$status.'&code='.$message_code);
}
}


  ?>