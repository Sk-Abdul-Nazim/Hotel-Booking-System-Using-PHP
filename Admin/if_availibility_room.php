<?php
include('../db_connection.php');

 if(!isset($_SESSION["loggedin1"])){
      header("location:../Admin_login.php");
      exit;
  }
error_reporting(0);
?>
<html>
<head>
<title>Available Room</title>
  <link rel = "icon" type = "image/png" href = "ico/room1.png">
<style>
        .link {
            background-color: white;
            border: 1px solid black;
            color: black;
            padding: 2px 10px;
            text-align: center;
            display: inline-block;
            font-size: 15px;
            margin: 5px 20px;
            cursor: pointer;
            text-decoration:none;
        }

</style>
</head>

<body>
  <h2>Which You Want To see</h2>
<a href="room.php" class="link">Show Available Room</a>
<a href="reserved_room.php" class="link">Show Reserved Room</a>
<br>
<a href="admin_index.php" class="link">Back</a>
</body>
</html>
