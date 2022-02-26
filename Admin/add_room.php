<?php
include('../db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
if(isset($_POST['add_room']))
{
  $cid = $_POST['city'];  // Storing Selected Value In Variable
  if(empty($cid))
  {
      echo "You didn't select any City";
      echo "<br>";
  }

    $hid = $_POST['hotel'];  // Storing Selected Value In Variable
      if(empty($hid))
      {
          echo "You didn't select any Hotel";
          echo "<br>";
      }
      $cat_name = $_POST['category'];  // Storing Selected Value In Variable

     $room_number = $_POST['room_number'];
     $person = $_POST['person'];
     $price = $_POST['price'];
     $availability = $_POST['avl'];


  if(isset($_FILES["image"]))
{
	$tname=$_FILES["image"]["tmp_name"];
	$name=$_FILES["image"]["name"];
	$fft=explode(".",$_FILES["image"]["name"]);
	$ft=strtolower(end($fft));
	$extension=array("jpeg","jpg","png");
	if(in_array($ft,$extension)===false)
	{
		echo"<h1>"."Please Image Save in jpeg or jpg or png Format"."</h1>";
		exit;
	}
	move_uploaded_file($tname,"images/room/".$name);
}
else{
$name = "images/room/noimg.png";
}
   $sql = "INSERT INTO `room` (category_name,room_number,number_of_person,price,availability,city_id,hotel_id,room_image,isActive) VALUES ('$cat_name','$room_number','$person','$price','$availability','$cid',$hid,'$name',1)";
   if(mysqli_query($conn, $sql)){
       echo "Records inserted successfully.";
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
   header('location:room.php');
}
?>

<html>
<head>
<title>Add Room</title>
<link rel = "icon" type = "image/png" href = "ico/room1.png">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>

<!-- CSS Files ================================================== -->
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-date.css">
<link rel="stylesheet" type="text/css" href="../css/form-wizard.css">
<link rel="stylesheet" type="text/css" href="../css/color.css" />
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<!-- Javascript Files ================================================== -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-select.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../js/jquery-ui-date.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/slick.min.js"></script>
<!-- Date Javascript Files -->
<script type="text/javascript" src='../js/moment.min.js'></script>
<script type="text/javascript" src='../js/fullcalendar.js'></script>
<!-- Theme Functions -->
<script type="text/javascript" src="../js/form-wizard.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="../js/themefunction.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"> <!--id="frm"-->
  <section class="rh rh-100 check-availability rh-check-availability select-list">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5>City</h5>
                  <select class="selectpicker" name="city" onchange="getValue(this.value);">
                    <option>select</option>
                    <?php
                      $sqlc="select * from city where isActive=1";
                      $datac= mysqli_query($conn,$sqlc);

                      while ($row1= mysqli_fetch_assoc($datac))
                      {
                    ?>
                      <option value="<?php echo $row1['city_id'] ?>"><?php echo $row1['city_name'] ?></option>

                    <?php  }?>

                  </select>
              </div>
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-x15">Hotel</h5>
                  <select class="browser-default filter-option custom-select" name="hotel" id="hotel_list">
                    <option>select</option>
                  </select>
              </div>
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Category</h5>
                  <input type="text" autocomplete="off" name="category" placeholder="Enter Category Name">
              </div>

              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Room Number</h5>
                <input type="number" autocomplete="off" name="room_number" placeholder="Enter Room Number" >
              </div>

              <div class="col-lg-6 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Person</h5>
                    <input type="number" autocomplete="off" name="person" placeholder="Enter Number Of Person">
              </div>
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Price</h5>
                  <input type="number" autocomplete="off" name="price" placeholder="Enter Price">
              </div>

              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Availability</h5>
                    <select class="selectpicker" name="avl">
                      <option>YES</option>
                      <option>NO</option>
                    </select>
              </div>

              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Room Image</h5>
                    <input type="file" name="image">
              </div>
              <input type="submit" name="add_room" class="rh-check-btn pull-right" Value="Add Room">
                <a href="room.php" class="rh-check-btn pull-right">Back</a>
          </div>
      </div>
  </section>

</form>
<script type= "text/javascript">
function getValue(val) {
$.ajax({
    type: "POST",
    url: "../getValue.php",
    data:'city_id='+val,
    success: function (data) {
            $("#hotel_list").html(data);
          },
          error: function () {
            Walert("Something is Wrong, Please Try Again...");
          }

        });  // end Ajax
  }
  </script>
</body>
</html>
