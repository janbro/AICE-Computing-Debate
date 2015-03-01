<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        header('Location: ../index.php');
    } else {
        // Login failed 
        $_SESSION['error'] = 'Incorrect username or password';
        header('Location: ../loginError.php');
    }
} else {
    // The correct POST variables were not sent to this page. 
    $_SESSION['error'] = 'Invalid Request';
    header('Location: ../error.php');
}