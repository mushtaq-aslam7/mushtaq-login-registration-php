<?php
session_start();

require_once '../sendEmails.php';



$username = "";
$email = "";
// $errors = [];
// print_r($_POST);


$conn = new mysqli('localhost', 'root', '', 'task');
$message_code = '';
$error = '';

// SIGN UP USER
if (isset($_POST['signup-btn'])) {

    if (empty($_POST['username'])) {
        $message_code = '1001';
        $status = 'error';
    }
    if (empty($_POST['email'])) {
        $message_code = '1000';
        $status = 'error';
    }
    if (empty($_POST['password'])) {
        $message_code = '1002';
        $status = 'error';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $message_code = '1003';
        $status = 'error';
    }
    if (empty($_POST['username']) && empty($_POST['password']) && empty($_POST['email']) && empty($_POST['passwordConf']) ) {
        $message_code = '1004';
        $status = 'error';
    }
    else{

    $username = $_POST['username'];
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
       
        $message_code = '1006';
        $status = 'error';
        
    }

    else {
        $query = "INSERT INTO users SET username=?, email=?, token=?, password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $username, $email, $token, $password);
        $result = $stmt->execute();
        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();
    
            // TO DO: send verification email to user
            sendVerificationEmail($email, $token);
    
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'You are logged in!';
            $_SESSION['type'] = 'alert-success';
            header('location: ../index.php');
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    }
}
    if ($message_code) {
        header('Location: ../signup.php?status='.$status.'&code='.$message_code);
    }

    }



// LOGIN
if (isset($_POST['login-btn'])) {

    if (empty($_POST['username'])) {
        $message_code = '1001';
        $status = 'error';
    }
    else if (empty($_POST['password'])) {
        $message_code = '1002';
        $status = 'error';
    }

else{
    $username = $_POST['username'];
    $password = $_POST['password'];

    
        $query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // if password matches
                $stmt->close();

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = 'You are logged in!';
                $_SESSION['type'] = 'alert-success';
                header('location: ../index.php');
                exit(0);
            } else { // if password does not match
                $message_code = '1005';
                $status = 'error';
            }

        }
    }
        if ($message_code) {
            header('Location: ../login.php?status='.$status.'&code='.$message_code);
        } 
        
        else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
    





  

?>