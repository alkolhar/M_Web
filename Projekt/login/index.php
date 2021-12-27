<?php
session_start();
include('../include/db.php');
// Get credentials from form
$username = trim($_POST['username']);
$password = $_POST['password'];

// Prepare statement
$stmnt = $con->prepare("SELECT Username, Password, ID FROM users WHERE Username=?");
$stmnt->bind_param("s", $username);

// Execute statement
$stmnt->execute();
$stmnt->store_result();

// Bind results to variables
$stmnt->bind_result($uname, $pw, $uid);

if ($stmnt->num_rows == 1) {
    $stmnt->fetch();
    if (password_verify($password, $pw)) {
        // success
        $_SESSION['UID'] = $uid;
        header("refresh:1;url=..\dashboard\index.php");
        echo '<p>Login Successful. Redirecting...</p>';
        exit();
    } else {
        // wrong password
        header("refresh:5;url=../index.php");
        echo 'Username and password do not match, please try again!<br>';
        echo 'You\'ll be redirected in about 5 secs. If not, click <a href="../index.php">here</a>.';
        exit();
    }
} else {
    // no username found
    header("refresh:5;url=../index.php");
    echo 'Username not found, please try again!<br>';
    echo 'You\'ll be redirected in about 5 secs. If not, click <a href="../index.php">here</a>.';
    exit();
}
