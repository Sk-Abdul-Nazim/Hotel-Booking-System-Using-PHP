<?php
include('../db_connection.php');
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
 $resr_id = $_REQUEST['id'];
$sql = "SELECT * FROM reservation WHERE resr_id='$resr_id'";
$data = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($data);

$room_id = $row['room_id'];


 $sql1 = "UPDATE reservation SET isActive=0 WHERE resr_id='$resr_id'";
 if(mysqli_query($conn,$sql1))
 {
   $sql1="update room set availability='YES' where room_id= $room_id";
   $data1= mysqli_query($conn,$sql1);
   header('location:reservation.php');
 }
 else {
        echo "ERROR: could not able to execute $sql1. " .mysqli_error($conn);
 }

 ?>
