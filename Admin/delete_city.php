<?php
include('../db_connection.php');
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
$did = $_REQUEST['id'];
$sql="update `city` set isActive=0 where city_id='$did'";
if(mysqli_query($conn, $sql)){
    echo "Records delete successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

$conn->close();
header('location:city.php');
 ?>
