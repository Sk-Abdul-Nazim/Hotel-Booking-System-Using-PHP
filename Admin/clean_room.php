<?php
include('../db_connection.php');

 if(!isset($_SESSION["loggedin1"])){
      header("location:../Admin_login.php");
      exit;
  }
error_reporting(0);

    $room_id=$_REQUEST['id'];
    $query = "update room set availability='YES' where room_id='$room_id'";
    if(mysqli_query($conn,$query))
    {
       header("location:room.php");
    }
    else {

          echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
$conn->close();

    ?>
