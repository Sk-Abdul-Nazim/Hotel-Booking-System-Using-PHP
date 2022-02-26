<?php
include('../db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }

$id = $_REQUEST['id'];
$query="select * from room where room_id=$id";
$data= mysqli_query($conn,$query);
while($row= mysqli_fetch_assoc($data))
{
?>

<html>
<head>
<title>Edit Room</title>
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
  <?php
  $cid = $row['city_id'];
  $hid = $row['hotel_id'];
    $sqlc="select * from city where isActive=1 and city_id=$cid";
    $datac= mysqli_query($conn,$sqlc);
    ?>
  <section class="rh rh-100 check-availability rh-check-availability select-list">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                <input type="hidden" name="eid" value="<?php echo $row['room_id']?>">
                  <h5>City</h5>
                  <select class="selectpicker" name="city" onchange="getValue(this.value);">
                    <!-- <option>select</option> -->
                    <option>select</option>
                   <?php
                      while($rowc= mysqli_fetch_assoc($datac))
                      {
                    ?>
                      <option value="<?php echo $rowc['city_id'] ?>"><?php echo $rowc['city_name'] ?></option>

                    <?php }?>
                  </select>
              </div>
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-x15">Hotel</h5>
                  <select class="browser-default filter-option custom-select" name="hotel" id="hotel_list">
                      <option>select</option>
                  </select>
              </div>

              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Category Name</h5>

                <input type="text" name="category"  value="<?php echo $row['category_name'];?>" placeholder="         Category Name" onfocus="this.select()" autofocus>
              </div>
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Room Number</h5>

                <input type="number" name="room_number"  value="<?php echo $row['room_number'];?>" placeholder="         Room Number" >
              </div>

<br><br>
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Person</h5>
                    <input type="number" name="person"  value="<?php echo $row['number_of_person'];?>" placeholder="               Person">
              </div>
              <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                  <h5 class="fw-15">Price</h5>
                  <input type="number" name="price"  value="<?php echo $row['price'];?>" placeholder="              Price">
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
                    <input type="file" name="image" value="<?php echo $row['room_image'];?>">
              </div>

                <input type="submit" name="edit_room" class="rh-check-btn pull-right" Value="Edit Room">
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
<?php }

if(isset($_POST['edit_room']))
{

$roomid = $_POST['eid'];

$cid = $_POST['city'];  // Storing Selected Value In Variable
  if(empty($cid))
  {
      echo("You didn't select any City");
  }
  
  $hid = $_POST['hotel'];  // Storing Selected Value In Variable
    if(empty($hid))
    {
        echo("You didn't select any Hotel");
    }

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
  move_uploaded_file($tname,"images/room/".$name);
}
else{
$name = "images/room/noimg.png";
}

     $room_number = $_POST['room_number'];
     $person = $_POST['person'];
     $price = $_POST['price'];
     $availability = $_POST['avl'];
       $cat_name = $_POST['category'];


   $sql = "UPDATE `room` SET category_name='$cat_name',room_number='$room_number',number_of_person='$person',price='$price',availability='$availability',city_id='$cid',hotel_id='$hid',room_image='$name',isActive=1 WHERE  room_id='$roomid'";
   if(mysqli_query($conn, $sql)){
       echo "Records inserted successfully.";

   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
   header('location:room.php');

}
