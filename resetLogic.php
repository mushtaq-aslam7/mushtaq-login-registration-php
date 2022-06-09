<?php 

session_start();
require_once './vendor/autoload.php';
$errors = [];
$user_id = "";

$conn = new mysqli('localhost', 'root', '', 'task');

//reset

  // ENTER A NEW PASSWORD
  if (isset($_POST['new_password'])) {
  
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
    $new_pass_c = mysqli_real_escape_string($conn, $_POST['new_pass_c']);
  
    
  
    // Grab to token that came from the email link
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    //grab email that came from the link
    $email = mysqli_real_escape_string($conn, $_POST['email']);
  
    //echo $token;
  
    if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
    if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
    if (count($errors) == 0) {
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
  }
  // send reset email

if (isset($_POST['reset-password'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // ensure that the user exists on our system
    $query = "SELECT email FROM users WHERE email='$email'";
    $results = mysqli_query($conn, $query);
  
    if (empty($email)) {
      array_push($errors, "Your email is required");
    }else if(mysqli_num_rows($results) <= 0) {
      array_push($errors, "Sorry, no user exists on our system with that email");
    }
    // generate a unique random token of length 100
    $token = bin2hex(random_bytes(50));
  
    if (count($errors) == 0) {
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
  ?>