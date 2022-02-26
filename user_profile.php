<?php
include('db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin2"])){
     header("location:login.php");
     exit;
 }
 $r_id=$_SESSION['id'];
 $query="SELECT * FROM registration where r_id='$r_id'";
 $data=mysqli_query($conn,$query);
 $total=mysqli_num_rows($data);
 if($total!=0)
 {
   ?>
   <html>
   <head>
     <title>Profile</title>
       <link rel = "icon" type = "image/png" href = "Admin/ico/user_profile.png">
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

.aa{
  padding-top: 50px;
  text-align:center;
  font-weight: bold;
  background-image: url("images/profile_back.gif");
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

   <body class="aa">
<h2><img src="images/only_logo.png" width="100" height="70" alt="profile"></h2>
   <table>
 <?php
    $row= mysqli_fetch_assoc($data);
   ?>
       <tr style="  font-weight: bold; font-size: 25px;text-lign:center;"><td>First Name</td><td>:</td>
       <td><?php echo $row['first_name'] ?></td></tr>
       <tr style="  font-weight: bold;font-size: 25px;"><td>Last Name</td><td>:</td>
       <td><?php echo $row['last_name'] ?></td></tr>
       <tr style="  font-weight: bold;font-size: 25px;"><td>Email ID</td><td>:</td>
       <td><?php echo $row['email'] ?></td></tr>
       <tr style="  font-weight: bold;font-size: 25px;"><td>Phone No.</td><td>:</td>
       <td><?php echo $row['phone'] ?></td></tr>
       <tr style="  font-weight: bold;font-size: 25px;"><td>Address</td><td>:</td>
       <td><?php echo $row['address'] ?></td></tr>
       <tr style="  font-weight: bold;font-size: 25px;"><td>Password</td><td>:</td>
       <td><?php echo $row['password'] ?></td></tr>

   <?php
 }
 else{
   echo "no records";
   }
  ?>

 </table>

 <?php
  $conn->close();

?>
<br>
<a href="index.php" class="link">Back</a>
<a href="user_edit_profile.php" class="link">Edit Profile</a>

</body>
</html>
