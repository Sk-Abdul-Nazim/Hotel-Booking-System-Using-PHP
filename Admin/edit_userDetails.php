<?php
include('../db_connection.php');
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
$id = $_REQUEST['id'];
$query="select * from registration where r_id=$id";
$data= mysqli_query($conn,$query);
while ($row= mysqli_fetch_assoc($data))
{
 ?>
 <html>
 <head>
<title>Edit UserDetails</title>
  <link rel = "icon" type = "image/png" href = "ico/user.png">
 </head>
 <body>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
       <tr>
         <input type="hidden" name="eid" value="<?php echo $row['r_id']?>">
          <td>First Name</td><td>:</td>
          <td><input type="text" name="first_name" placeholder="Enter First Name" value="<?php echo $row['first_name']?>"></td>
       </tr>
       <tr>
          <td>Last Name</td><td>:</td>
          <td><input type="text" name="last_name" placeholder="Enter last Name" value="<?php echo $row['last_name']?>"></td>
       </tr>
       <tr>

          <td>Email ID</td><td>:</td>
          <td><input type="text" name="email" placeholder="example@example.com" value="<?php echo $row['email']?>" onfocus="this.select()" autofocus></td>
       </tr>
       <tr>

          <td>Phone No.</td><td>:</td>
          <td><input type="text" name="phone" placeholder="Enter Phone Number" value="<?php echo $row['phone']?>"></td>
       </tr>
       <tr>

          <td>Address</td><td>:</td>
          <td><input type="text" name="address" placeholder="Enter Address" value="<?php echo $row['address']?>"></td>
       </tr>
       <tr>

          <td>Password</td><td>:</td>
          <td><input type="text" name="password" placeholder="Enter Password" value="<?php echo $row['password']?>"></td>
       </tr>
       <tr>
          <td><input type="submit" name="editUser" value="Submit"></td>
       </tr>
    </table>
 </form>
 </body>
 </html>
<?php }
if(isset($_POST['editUser']))
{
  $eid = $_POST['eid'];
   $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
     $email = $_POST['email'];
      $phone = $_POST['phone'];
       $address = $_POST['address'];
        $password = $_POST['password'];
   $sql = "update `registration` set first_name='$fname',last_name='$lname',email='$email',phone='$phone',address='$address',password='$password' where r_id='$eid'";
   if(mysqli_query($conn, $sql)){
       echo "Records update successfully.";
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
  header('location:userDetails.php');
}

 ?>
