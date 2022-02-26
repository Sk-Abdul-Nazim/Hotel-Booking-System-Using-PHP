<?php
include('../db_connection.php');
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
$roomid = $_REQUEST['id'];
$sql="update `room` set isActive=0, availability='NO' where room_id='$roomid'";
if(mysqli_query($conn, $sql)){
    echo "Records delete successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();
header('location:room.php');
 ?>
