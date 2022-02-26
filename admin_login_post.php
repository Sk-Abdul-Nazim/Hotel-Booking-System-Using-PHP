<?php
include('db_connection.php');
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = " SELECT * from admin_registration WHERE a_username = '$username' AND a_password = '$password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['loggedin1'] = false;
    $_SESSION['admin_id'] = $row['a_id'];
    $username_db = $row['a_username'];
    $password_db = $row['a_password'];
    if(($username==$username_db)&&($password == $password_db)){
     $_SESSION['a_username'] = $username_db;
     header('location:Admin/admin_index.php');
    } else {
            $_SESSION['error']="Account not activated";
            header('location:Admin_login.php');
    }
  }else{
    $_SESSION['loggedin1'] = true;
    $_SESSION['error']="invalid admin id or password !";
    header('location:Admin_login.php');
  }
}

 ?>
