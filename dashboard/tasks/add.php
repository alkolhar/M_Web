<?php
include('../../include/db.php');
$fn = trim($_POST['fname']);
$ln = trim($_POST['lname']);
$name = $fn . ' ' . $ln;
$mobile = trim($_POST['mobile']);
$email = trim($_POST['email']);
$street = trim($_POST['street']);
$city = trim($_POST['city']);

if (strlen($fn) > 0 && strlen($ln) > 0 && strlen($mobile) > 0 && strlen($email) > 0 && strlen($street) > 0 && strlen($city) > 0) {
	// if person is already added
	$stmnt = $con->prepare("SELECT * FROM persons WHERE Email=?");
	$stmnt->bind_param("s", $email);
	$stmnt->execute();
	$stmnt->store_result();

	if ($stmnt->num_rows == 1) {
		echo '<p style="color: #9F6000;font-weight: bold;">This person is already added.</p>';
	} else {

		/* Prepared statement, stage 1: prepare */
		$stmt = $con->prepare("INSERT INTO persons(Name, Mobile, Email, Street, City) VALUES(?, ?, ?, ?, ?)");

		/* Prepared statement, stage 2: bind and execute */
		$stmt->bind_param("sisss", $name, $mobile, $email, $street, $city);;

		if ($stmt->execute()) {
			echo '<p style="color: #4F8A10;font-weight: bold;">Person Added Successfully!</p>';
			header('../../index.php');
		} else {
			echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
		}
	}
} else {
	echo '<p style="color: #D8000C;font-weight: bold;">Please Fill All The Details.</p>';
}
