<?php include('db_connection.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
  <style>
  .center {
    margin: auto;
    width: 40%;
    padding: 10px;
    background-image: url("images/home/1.jpg");
  }
  </style>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>login</title>
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
</head>
<body class="center">
  <div class="modal-body">
    <?php
    if(isset($_SESSION['error']) && $_SESSION['error'] !=""){
     echo '<span style="color:#4B0082;text-align:center;">'.$_SESSION['error'].'</span>';
      unset($_SESSION['error']);
    }

     ?>
      <div class="row">
          <div class="col-xs-12">
              <div class="well">
                  <form id="adminForm" method="POST" action="admin_login_post.php">
                      <div class="form-group">
                          <label for="username" class="control-label">Username</label>
                          <input type="text" autocomplete="off" class="form-control" id="username" name="username" required title="Please enter you username" placeholder="admin">
                      </div>
                      <div class="form-group">
                          <label class="control-label">Password</label>
                          <input type="password" autocomplete="off" class="form-control" required title="Please enter your password" placeholder="1234" name="password">
                      </div>

                        <button type="submit" name="submit" class="rh-check-btn btn-block">Login</button>
                        <a href="home.php" class="rh-check-btn btn-block">Back</a>
                      <!-- <a href="#" class="rh-check-btn btn-block">Login</a> -->

                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
</div>
</div>
</body>
</html>
