<?php
include('db_connection.php');
if(!isset($_SESSION["loggedin2"])){
     header("location:login.php");
     exit;
 }
$resr_id = $_REQUEST['id'];

$sqlf="select room_id from reservation where resr_id='$resr_id'";
$dataf=mysqli_query($conn,$sqlf);
$rowf = mysqli_fetch_assoc($dataf);

$room_id=$rowf['room_id'];

$sql="update `reservation` set isActive=0 where resr_id='$resr_id'";

if(mysqli_query($conn, $sql)){

	$sql1="update room set availability='YES' where room_id= $room_id";
	$data1= mysqli_query($conn,$sql1);

  echo '<script type="text/javascript">';
  echo 'alert("Room Cancel, Thank You");';
  echo 'window.location.href = "user_booking_history.php";';
  echo '</script>';

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();

 ?>
