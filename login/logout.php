<?php
session_start();
if (isset($_SESSION['UID'])) {
  session_destroy();
}
header("refresh:5;url=../index.php");
echo 'Logout successfull!<br>';
echo 'You\'ll be redirected in about 5 secs. If not, click <a href="../index.php">here</a>.';
exit();
