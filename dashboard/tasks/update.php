<?php
include('../../include/db.php');
$fn = trim($_POST['updatefname']);
$ln = trim($_POST['updatelname']);
$name = $fn . ' ' . $ln;
$email = trim($_POST['updatemail']);
$mobile = trim($_POST['updatemobile']);
$street = trim($_POST['updatestreet']);
$city = trim($_POST['updatecity']);

if (strlen($fn) > 0 && strlen($ln) > 0 && strlen($mobile) > 0 && strlen($email) > 0 && strlen($street) > 0 && strlen($city) > 0) {
  /* Prepared statement, stage 1: prepare */
  $stmt = $con->prepare("UPDATE persons SET Name=?, Mobile=?, Street=?, City=? WHERE Email=?");

  /* Prepared statement, stage 2: bind and execute */
  $stmt->bind_param("sisss", $name, $mobile, $street, $city, $email);

  if ($stmt->execute()) {
    echo '<p style="color: #4F8A10;font-weight: bold;">Person Updated Successfully!</p>';
  } else {
    echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
  }
} else {
  echo '<p style="color: #D8000C;font-weight: bold;">Please Fill All The Details.</p>';
}
