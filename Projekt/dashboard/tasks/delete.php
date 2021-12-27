<?php
include('../../include/db.php');
$id = trim($_POST['id']);
mysqli_query($con, "DELETE FROM persons WHERE ID='$id' ");
if (!(mysqli_error($con) == "")) {
  echo '<script> alert("An Error occured. Data could not be deleted!"); </script>';
}
