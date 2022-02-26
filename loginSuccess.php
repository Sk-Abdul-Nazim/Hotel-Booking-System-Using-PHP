<?php
include('db_connection.php');

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = " SELECT * from registration WHERE email = '$email' AND password = '$password'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if($row['isActive'] == 1){

			$_SESSION['loggedin2'] = false;
			$_SESSION['id']=$row['r_id'];
		 $_SESSION['name']=$row['first_name'];
		 header('location:index.php');
		} else {
            $_SESSION['error']="Account not activated";

            header('location:signup.php');
		}
	}else{

		$_SESSION['loggedin2'] = true;
		$_SESSION['error']="invalid email id or password !";
		$_SESSION['loggedin_search_error'] = "You Have To Login Before Room Booked";
		header('location:login.php');
		// header("Location: http://indianhotel2019.000webhostapp.com/login.php");
	}
}
if(!isset($_SESSION["loggedin2"])){
		 header("location:login.php");
		 exit;
 }

?>
