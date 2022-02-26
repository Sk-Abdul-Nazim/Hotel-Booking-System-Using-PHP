<?php
include('db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin2"])){
     header("location:login.php");
     exit;
 }
 $r_id=$_SESSION['id'];
if(isset($_POST['rgn']))
{

  $email = trim($_POST['email']);
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $password = $_POST['new_password'];
  $cpassword = $_POST['confirmpassword'];

  $sql1 = " SELECT * from registration WHERE email = '$email'";
  $result1= mysqli_query($conn,$sql1);
  $total=mysqli_num_rows($result1);

    if($password != $cpassword){
            $_SESSION['error2']="password doesn't match!";
           header('location:user_edit_profile.php');
      }
  else{

        $sql = "UPDATE registration set email='$email',phone='$phone',address='$address',password='$password' WHERE r_id='$r_id'";
        $result= mysqli_query($conn,$sql);

        if($result){

          unset($_SESSION['error2']);
          echo '<script type="text/javascript">';
          echo 'alert("Profile Updated");';
          echo 'window.location.href = "user_profile.php";';
          echo '</script>';
          $conn.close();
        }
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
  }

}
$query="SELECT * FROM registration where r_id='$r_id'";
$data=mysqli_query($conn,$query);
$rowu=mysqli_fetch_assoc($data);
 ?>

<html lang="en">
<head>
  <title>Edit Profile</title>
       <link rel = "icon" type = "image/png" href = "Admin/ico/user_profile.png">
  <style>
  .center {
    margin: auto;
    width: 50%;
    padding: 10px;
    background-image: url("images/home/1.jpg");
  }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Signup</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Online Hotel Booking By Group-G">
<meta name="keywords" content="accommodation,apartment,B&B,bed and breakfast,booking,hostel,inn,motel,reservation,reservation form,resort,responsive,spa,travel,bootstrap,cruise,flights,holiday,hotel,html5 template,online booking,real estate,rentals,tour,tourism,uber">

<link rel="apple-touch-icon" sizes="180x180" href="images/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/favicons/favicon-16x16.png">
<link rel="manifest" href="images/favicons/manifest.json">
<link rel="mask-icon" href="images/favicons/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">

<!-- CSS Files ================================================== -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-date.css">
<link rel="stylesheet" type="text/css" href="css/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/slick.css">
<link rel="stylesheet" type="text/css" href="css/color.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />

<!-- Javascript Files ================================================== -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/jquery-ui-date.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<!-- Date Javascript Files -->
<script type="text/javascript" src='js/moment.min.js'></script>
<script type="text/javascript" src='js/fullcalendar.js'></script>
<!-- Theme Functions -->
<script type="text/javascript" src="js/form-wizard.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="js/themefunction.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body class="center" onload='document.signup.firstname.focus()' >
  <div class="modal-body">
    <?php
     if(isset($_SESSION['error2']) && $_SESSION['error2'] !=""){
        echo '<span style="color:#4B0082;text-align:center;">'.$_SESSION['error2'].'</span>';
     }
     ?>
      <div class="row">
          <div class="col-md-12">
              <div class="well">
                  <form id="signup" name="signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      <div class="row">

                          <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                              <label for="email" class="control-label">Email</label>
                              <input type="email" autocomplete="off" class="form-control" id="txtEmail" onkeyup="ValidateEmail();" name="email"  title="Please enter your email" value="<?php echo $rowu['email'];?>" onfocus="this.select()" autofocus required/>
                              <span id="lblError"></span>
                          </div>
                          <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                              <label for="email" class="control-label">Phone</label>
                              <input type="text" autocomplete="off" minlength="10" maxlength="10" class="form-control" id="phone" name="phone" required title="10 digit mobile number" value="<?php echo $rowu['phone'];?>" onkeypress="PhoneCheck();" /><span id="print"></span>

                          </div>
                          <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                              <label for="address" class="control-label">Address 1</label>
                              <input type="text" autocomplete="off" class="form-control" id="address" name="address" required title="Please enter your address" value="<?php echo $rowu['address'];?>"/>
                          </div>
                          <div class="form-group col-md-12 col-sm-12 col-xs-12">
                              <label class="control-label">Old Password</label>
                              <input type="text" autocomplete="off" class="form-control" required title="Please enter your password"  value="<?php echo $rowu['password'];?>" name="password" />
                          </div>

                          <div class="form-group col-md-6 col-sm-6 col-xs-6">
                              <label class="control-label">New Password</label>
                              <input type="password" autocomplete="off" id="new_password" class="form-control" required title="Please enter your password"  placeholder="Enter Your New Password" name="new_password" />
                          </div>

                          <div class="form-group col-md-6 col-sm-6 col-xs-6">
                              <label class="control-label">Conform Password</label>
                              <input type="password" autocomplete="off" id = "new_confirm_password" class="form-control" required title="conform password" placeholder="Conform Password" name="confirmpassword"/>
                                <span id='message'></span>
                          </div>
                          <div class="alert alert-error hide">Wrong username or password</div>
                          <div class="form-group signup col-md-12">
                            <label>
                                <input type="checkbox" onclick="myFunctionPassword()">Show Password
                            </label>
                              <button type="submit" name="rgn" class="rh-check-btn btn-block">Submit</button>
                              <h6 style="text-align:center">Or</h6>
                              <a href="index.php" class="btn btn-default btn-block">Back</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <script>
  function myFunctionPassword() {
  var x = document.getElementById("new_password");
    var y = document.getElementById("new_confirm_password");
  if (x.type === "password") {
    x.type = "text";
    y.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
  }
  }
  </script>
  <script type="text/javascript" src="js/validate_for_edit_profile.js"></script>

</body>
</html>
