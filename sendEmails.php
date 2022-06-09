<?php
require_once '../vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 465, 'tls'))
    ->setUsername('378fac2c584972')
    ->setPassword('5c164ea85ce71f');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $token)
{
    global $mailer;
    $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #080808;
          font-size: 1.3em;
        }
        a {
          background: #080808;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Please click on the link below to verify your account:.</p>
        <a href="http://localhost:8000/task/verify_email.php?token=' . $token . '">Verify Email!</a>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Verify your email'))
        ->setFrom('admin@bee-it.com')
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}