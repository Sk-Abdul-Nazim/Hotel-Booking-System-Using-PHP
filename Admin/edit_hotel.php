<?php
include('../db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }

$id = $_REQUEST['id'];
$query="select * from hotel where hotel_id=$id";
$data= mysqli_query($conn,$query);
while ($row= mysqli_fetch_assoc($data))
{
?>

<html>
<head>
<title>Edit Hotel</title>
<link rel = "icon" type = "image/png" href = "ico/hotel.png">
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
</head>

<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"> <!--id="frm"-->
  <section class="rh rh-100 check-availability rh-check-availability select-list">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                <input type="hidden" name="eid" value="<?php echo $row['hotel_id']?>">
                  <h5>City</h5>
                  <select class="selectpicker" name="city">

                    <?php
                    $cid=$row['city_id'];
                      $sqlc="select * from city where isActive=1 and city_id=$cid";
                      $datac= mysqli_query($conn,$sqlc);

                      while ($rowc= mysqli_fetch_assoc($datac))
                      {
                    ?>
                      <option><?php echo $rowc['city_name'] ?></option>

                    <?php }?>
                  </select>
              </div>
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-x15">Hotel</h5>
                  <input type="text" name="hotel_name" value="<?php echo $row['hotel_name'] ?>" onfocus="this.select()" autofocus>
              </div>

              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Hotel Image</h5>
                    <input type="file" name="image">
              </div>



              <div class="rh-clear col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <input type="submit" name="edit_hotel" class="rh-check-btn pull-right" Value="Submit">

              </div>
                <a href="hotel.php" class="rh-check-btn pull-right">Back</a>
          </div>
      </div>
  </section>

</form>
</body>
</html>
<?php }
if(isset($_POST['edit_hotel']))
{
$hid = $_POST['eid'];

$selected_val = $_POST['city'];  // Storing Selected Value In Variable
  if(empty($selected_val))
  {
      echo("You didn't select any City");
  }
  $sql2="select * from city where city_name='".$selected_val."'";
    $data2= mysqli_query($conn,$sql2);
    $row2= mysqli_fetch_assoc($data2);
    $cid = $row2['city_id'];
    $hotelname=$_POST['hotel_name'];

  if(isset($_FILES["image"]))
{
	$tname=$_FILES["image"]["tmp_name"];
	$name=$_FILES["image"]["name"];
	$fft=explode(".",$_FILES["image"]["name"]);
	$ft=strtolower(end($fft));
	$extension=array("jpeg","jpg","png");
	if(in_array($ft,$extension)===false)
	{
		echo"<h1>"."Extension not matched"."</h1>";
		exit;
	}
	move_uploaded_file($tname,"images\hotel/".$name);
}
else{
$name = "image/noimg.png";
}

   $sql = "UPDATE `hotel` SET hotel_name='$hotelname',city_id='$cid',hotel_image='$name',isActive=1 WHERE hotel_id='$hid'";
   if(mysqli_query($conn, $sql)){
       echo "Records inserted successfully.";
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
   header('location:hotel.php');
}
