<?php
include('../db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin1"])){
     header("location:Admin_login.php");
     exit;
 }
 $a_id=$_SESSION['admin_id'];
 $query="SELECT * FROM admin_registration where a_id='$a_id'";
 $data=mysqli_query($conn,$query);
 $total=mysqli_num_rows($data);
 if($total!=0)
 {
   ?>
   <html>
   <head>
     <title>Admin Profile</title>
       <link rel = "icon" type = "image/png" href = "ico/user_profile.png">
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

                   padding-top: 10px;
                   padding-right: 10px;
                    padding-bottom:10px;
                   padding-left: 10px;
               }

       </style>

     <style>
        table, th, td {

           margin-right:auto;
           margin-left:auto;
         }
         th, td {
               padding: 10px;
          }

     </style>
   </head>
   <body style="padding-top: 50px; text-align:center">
<h2><img src="ico/user_profile.png" width="90" height="90" alt="profile"></h2>
   <table>
 <?php

    $row= mysqli_fetch_assoc($data);

   ?>
       <tr><td>User Name</td><td>:</td>
       <td><?php echo $row['a_username'] ?></td></tr>
       <tr><td>Password</td><td>:</td>
       <td><?php echo $row['a_password'] ?></td></tr>

   <?php
 }
 else{
   echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
   }
  ?>

 </table>

 <?php
  $conn->close();

?>
<br>
<a href="admin_index.php" class="link">Back</a>
<a href="admin_edit_profile.php" class="link">Edit Profile</a>

</body>
</html>
