<?php
include('../../include/db.php');
$id = $_POST['id'];
$res = mysqli_query($con, "SELECT * FROM persons WHERE ID='$id'");
$array = mysqli_fetch_row($res);
echo json_encode($array);
