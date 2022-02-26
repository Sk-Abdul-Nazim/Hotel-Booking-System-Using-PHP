<?php
include('../db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
if(isset($_POST['addcity']))
{
   $cityname = $_POST['cityname'];
   $sql = "INSERT INTO `city` (city_name,isActive) VALUES ('$cityname',1)";
   if(mysqli_query($conn, $sql)){
       echo "Records inserted successfully.";
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
   header('location:city.php');
}
?>

<html>
<head>
<title>Add city</title>
<link rel = "icon" type = "image/png" href = "ico/city.png">
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
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > <!--id="frm"-->

    <section class="rh rh-100 check-availability rh-check-availability select-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                    <h5 class="fw-x15">City Name</h5>
                  <input type="text" autocomplete="off" name="cityname" placeholder="Enter City Name" autofocus/>
                </div>
                <div class="rh-clear col-lg-3 col-md-3 co-sm-3 col-xs-6 rh-xs-12">
                    <input type="submit" name="addcity" class="rh-check-btn pull-right" Value="Add City">

                </div>
                  <a href="hotel.php" class="rh-check-btn pull-right">Back</a>
            </div>
        </div>
    </section>
</script>
</form>
</body>
</html>
