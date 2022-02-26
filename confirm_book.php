<?php
include('db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin2"])){
		 header("location:login.php");
		 exit;
 }

?>
<html>
<head>
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
<?php
date_default_timezone_set('Asia/Kolkata');
$room_id=$_REQUEST['room_id'];

$get_check_in_date=$_REQUEST['check_in'];
$time_check_in = strtotime($get_check_in_date);
$check_in = date('Y-m-d',$time_check_in);

$get_check_out_date=$_REQUEST['check_out'];
$time_check_out = strtotime($get_check_out_date);
$check_out = date('Y-m-d',$time_check_out);

$person=$_REQUEST['person'];
$price=$_REQUEST['price'];
$cid=$_REQUEST['cid'];
$hid=$_REQUEST['hid'];

$r_id=$_SESSION['id'];

// $get_date=date("d-m-Y")." ".date("h:i:s");
$get_date=date("d-m-Y");
$time = strtotime($get_date);
$booked_date = date('Y-m-d',$time);

$booked_time=date("g:i:s A"); // for 12 hours with AM/PM
$user_time_test=date("h:i:s");



if($check_out>$booked_date && $check_in>=$booked_date){

$sql = "INSERT INTO `reservation` (city_id,number_of_person,check_in_date,check_out_date,price,r_id,room_id,hotel_id,booked_date,booked_time,isActive) VALUES ('$cid','$person','$check_in','$check_out','$price','$r_id','$room_id','$hid','$booked_date','$booked_time',1)";

if(mysqli_query($conn, $sql)){
	$sql1="update room set availability='NO' where room_id= $room_id";
	$data1= mysqli_query($conn,$sql1);
	//$rowr= mysqli_fetch_assoc($datar);
	echo '<script type="text/javascript">';
	echo 'alert("Reservation Successfull");';
	echo '</script>';

	?>

	<a href="index.php" class="link">Back</a>
 <a href="confirm_book_show.php?id=<?php echo $room_id;?>" class="link">You Want to see Room Details</a>

<?php
} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		//header('location:index.php');
}
} // end of outer is
else{
	echo '<script type="text/javascript">';
	echo 'alert(" Date is invalid!");';
	echo 'window.location.href = "index.php";';
	echo '</script>';
}

$conn->close();
 ?>
 </html>
</body>
