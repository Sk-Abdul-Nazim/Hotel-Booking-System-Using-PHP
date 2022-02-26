<?php
include('../db_connection.php');
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
$hotelid = $_REQUEST['id'];
$sql="update `hotel` set isActive=0 where hotel_id='$hotelid'";
if(mysqli_query($conn, $sql)){
    echo "Records delete successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();
header('location:hotel.php');
 ?>
