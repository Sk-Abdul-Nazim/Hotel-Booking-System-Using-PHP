<?php
include('db_connection.php');
error_reporting(0);

$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_form (contact_name,contact_email,contact_phone,contact_subject,contact_message) VALUES('$name','$email','$mobile','$subject','$message')";

if(mysqli_query($conn,$sql))
{
  echo '<script type="text/javascript">';
  echo 'alert("Thank You For Submitted Your Details and Stay Our Site");';
  echo 'window.location.href = "index.php";';
  echo '</script>';
  $conn.close();
}
else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
  $conn.close();
 ?>
