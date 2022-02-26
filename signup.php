<?php
include('db_connection.php');
error_reporting(0);

if(isset($_POST['rgn']))
{
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $cpassword = $_POST['confirmpassword'];

  $sql1 = " SELECT * from registration WHERE email = '$email'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
            $_SESSION['error1']="email already taken!";

            header('location:signup.php');

		}
    elseif($password != $cpassword){
            $_SESSION['error1']="password doesn't match!";
           header('location:signup.php');
      }
  else{
    $sql = " INSERT INTO registration(first_name,last_name,email,phone,address,password) values('$firstname','$lastname','$email','$phone','$address','$password')";
    $result = $conn->query($sql);
        if($result){
          // mail send
          $_SESSION['email'] = $email;
          $_SESSION['pass1'] = $password;
          unset($_SESSION['error1']);
          echo '<script type="text/javascript">';
          echo 'alert("Registration Successfull");';
          echo 'window.location.href = "login.php";';
          echo '</script>';
          $conn.close();
        }
        else{
          echo "Failed";
        }
  }

}
 ?>

<html lang="en">
<head>
  <title>Registration</title>
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
     if(isset($_SESSION['error1']) && $_SESSION['error1'] !=""){
        echo '<span style="color:#4B0082;text-align:center;">'.$_SESSION['error1'].'</span>';

     }
     ?>
      <div class="row">
          <div class="col-md-12">
              <div class="well">
                  <form id="signup" name="signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      <div class="row">
                          <div class="form-group col-md-6 col-sm-6 col-xs-6">
                              <label for="firstname" class="control-label">First Name</label>
                              <input type="text" autocomplete="off" class="form-control"   id="firstname" name="firstname" required title="Please enter your firstname" placeholder="First Name"  onkeyup="javascript:capitalize(this.id, this.value);" />
                              <span id="msg"></span>
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-6">
                              <label for="lastname" class="control-label">Last Name</label>
                              <input type="text" autocomplete="off" class="form-control" id="lastname" name="lastname" required title="Please enter your lastname" placeholder="Last Name"   onkeyup="javascript:capitalize(this.id, this.value);"/>
                              <span id="msg1"></span>
                          </div>
                          <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                              <label for="email" class="control-label">Email</label>
                              <input type="email" autocomplete="off" class="form-control" id="txtEmail" onkeyup="ValidateEmail();" name="email" required title="Please enter your email" placeholder="example@example.com"/>
                              <span id="lblError"></span>
                          </div>
                          <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                              <label for="email" class="control-label">Phone</label>
                              <input type="text" autocomplete="off" minlength="10" maxlength="10" class="form-control" id="phone" name="phone" required title="10 digit mobile number" placeholder="10 digit mobile number" onkeypress="PhoneCheck();" /><span id="print"></span>

                          </div>
                          <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                              <label for="address" class="control-label">Address 1</label>
                              <input type="text" autocomplete="off" class="form-control" id="address" name="address" required title="Please enter your address" placeholder="Address" />
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-6">
                              <label class="control-label">Password</label>
                              <input type="password" autocomplete="off" id="password"class="form-control" required title="Please enter your password" placeholder="Password" name="password" />
                          </div>
                          <div class="form-group col-md-6 col-sm-6 col-xs-6">
                              <label class="control-label">Conform Password</label>
                              <input type="password" autocomplete="off" id = "confirm_password"class="form-control" required title="conform password" placeholder="Conform Password" name="confirmpassword"/>
                                <span id='message'></span>
                          </div>
                          <div class="alert alert-error hide">Wrong username or password</div>
                          <div class="form-group signup col-md-12">
                              <label>
                                  <input type="checkbox" onclick="myFunctionPassword()">Show Password
                              </label>
                              <button type="submit" name="rgn" class="rh-check-btn btn-block">Create Account</button>
                              <h6 style="text-align:center">Or</h6>
                              <a href="login.php" class="btn btn-default btn-block">Login</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <script>
function myFunctionPassword() {
  var x = document.getElementById("password");
    var y = document.getElementById("confirm_password");
  if (x.type === "password") {
    x.type = "text";
    y.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
  }
}
</script>
  <script type="text/javascript" src="js/validate.js"></script>
</script>
<script type="text/javascript">
// capitalize first name and last name
  function capitalize(textboxid, str) {
      // string with alteast one character
      if (str && str.length >= 1)
      {
          var firstChar = str.charAt(0);
          var remainingStr = str.slice(1);
          str = firstChar.toUpperCase() + remainingStr;
      }
      document.getElementById(textboxid).value = str;
  }
  </script>

</body>
</html>
