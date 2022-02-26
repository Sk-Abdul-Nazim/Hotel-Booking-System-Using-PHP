<?php
include('otp.php');
$otp = $_POST['otp'];
$generateNumericOTP = generateNumericOTP();
if($otp === $generateNumericOTP)
{
  header('location:index.php');
}
else{
  $_SESSION['error']="Account not activated";
  header('location:otp.php');
}

?>
