<?php include('db_connection.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7"> <![endif]-->
    <!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7"> <![endif]-->
    <!--[if IE 8]>     <html class="ie ie8 lte9 lte8"> <![endif]-->
    <!--[if IE 9]>     <html class="ie ie9 lte9"> <![endif]-->
    <!--[if gt IE 9]>  <html> <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Online Hotel Booking By Group-G</title>
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
    <link rel="stylesheet" type="text/css" href="css/form-wizard.css">
    <link rel="stylesheet" type="text/css" href="css/color.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>

<body>
  <?php
  if(!isset($_SESSION['name']) && $_SESSION['name'] ==""){
  ?>
  <!-- Header Begin -->
  <header class="rh">
      <!-- ========== Top Menu ========== -->
      <div class="rh-header">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                      <ul class="top">
                          <li>

                          </li>
                      </ul>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                      <ul class="pull-right">
                        <li><a href="javascript:;"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                         <li></li>
                        <li>
                            <a href="Admin_login.php">Admin</a>
                        </li>
                        <li>
                            <a href="login.php" >Login</a>
                        </li>
                        <li>
                                <a href="signup.php" >Signup</a>
                            </li>


                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <!-- ========== Nav Menu ========== -->
      <nav class="rh navbar navbar-default">
          <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse rh-toggle" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right main-navbar">
                      <li>
                          <a href="index.php">Home</a>

                      </li>
                      <li>
                          <a href="available-rooms.php">Available Rooms</a>
                      </li>

                      <li>
                          <a class="active" href="booking.php">Booking</a>
                      </li>

                      <li><a href="about.php">About</a></li>
                      <li><a href="contact.php">Contact</a></li>
                  </ul>
              </div>
          </div>
      </nav>
  </header>
  <!-- Header Close -->

  <!-- Small Banner Begin -->
  <section class="rh-detail-bg list-view-column2 event">
      <div class="container">
          <div class="row">
              <div class="rh-detail-widgets ">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="rh text-center">
                          <h2>Booking</h2>
                          <p>Captions line here</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Small Banner Close -->

  <!-- Main Content Begin -->
  <div class="rh rh-100 section-booking">
      <!-- Booking Page Begin -->
      <div class="container">
          <div class="row">
                <form action="search.php" method="post">
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                        <h5>Arrival date</h5>
                        <div class="form-group">
                            <input type="date" name="arrive" value="" class="form-control" placeholder="" autocomplete="on" required>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                        <h5>Departure date</h5>
                        <div class="form-group">
                            <input type="date" name="depature" value="" class="form-control" placeholder="" autocomplete="on" required>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                        <h5>Location</h5>
                        <select class="selectpicker" name="city" onchange="getValue(this.value);">
                        <!--<select class="selectpicker" name="city">-->
                        <option>select</option>
                          <?php
                            $sqlc="select * from city where isActive=1";
                            $datac= mysqli_query($conn,$sqlc);

                            while ($rowc= mysqli_fetch_assoc($datac))
                            {
                          ?>
                            <option value="<?php echo $rowc['city_id'] ?>"><?php echo $rowc['city_name'] ?></option>

                          <?php }?>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-s-30" >
                        <h5>Hotel</h5>
                            <select class="browser-default filter-option custom-select" name="hotel" id="hotel_list" onchange="getValue1(this.value);">
                             <option >Select</option>

                           </select>

                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-s-30" >
                        <h5>Category</h5>
                            <select class="browser-default filter-option custom-select" name="category" id="cat_list">
                             <option >Select</option>

                           </select>


                    </div>


                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                          <input type="submit" value="Search"class="rh-check-btn pull-right">
                    </div>
                </form>
          </div>
      </div>
      <!-- Booking Page Close -->
  </div>
  <!-- Main Content Close -->

  <!-- Footer Begin -->
  <footer class="rh">
      <div class="rh-100 rh-footer">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 rh-f-30 rh-f-100">
                      <div class="rh-footer-box">
                          <img class="footer-logo" src="images/Logo-footer.png" alt="footer-logo" />
                          <p>You have questions regarding our services? Contact us, we will be happy to help you out!</p>
                          <ul class="footer-about">
                            <li><a href="mailto:indianhotel81@gmail.com">indianhotel81@gmail.com</a></li>
                            <li><a href="javascript:;">2/10 B, Baghajatin, Kol-700086</a></li>
                            <li><a href="tel:+974-947-1818">+91 974-947-1818</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 rh-f-30 rh-f-50">
                      <div class="rh-footer-box">
                          <h5>Hotel</h5>
                          <ul class="footer-menu list">
                              <li><a href="javascript:;">Accommodation</a></li>
                              <li><a href="about.php">About</a></li>
                              <li><a href="javascript:;">Services & Amenities</a></li>
                              <li><a href="javascript:;">Dining</a></li>
                              <li><a href="javascript:;">Spa</a></li>
                              <li><a href="javascript:;">Destination</a></li>
                              <li><a href="javascript:;">Offer</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 rh-fs-30 rh-f-50">
                      <div class="rh-footer-box">
                          <h5>Inquires</h5>
                          <ul class="footer-menu list">
                              <li><a href="javascript:;">About  Four Seasons</a></li>
                              <li><a href="javascript:;">Press Room</a></li>
                              <li><a href="javascript:;">Gift Cards</a></li>
                              <li><a href="javascript:;">Residences</a></li>
                              <li><a href="javascript:;">Careers</a></li>
                              <li><a href="contact.php">Contact us</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 rh-f-100">
                      <div class="rh-footer-box">
                          <h5>Photo Gallery</h5>
                          <ul class="footer-menu gallery">
                              <li>
                                  <a><img src="images/footer-gallery-1.jpg" alt="footer-gallery-1" /></a>
                              </li>
                              <li>
                                  <a><img src="images/footer-gallery-2.jpg" alt="footer-gallery-2" /></a>
                              </li>
                              <li>
                                  <a><img src="images/footer-gallery-3.jpg" alt="footer-gallery-3" /></a>
                              </li>
                              <li>
                                  <a><img src="images/footer-gallery-4.jpg" alt="footer-gallery-4" /></a>
                              </li>
                              <li>
                                  <a><img src="images/footer-gallery-5.jpg" alt="footer-gallery-5" /></a>
                              </li>
                              <li>
                                  <a><img src="images/footer-gallery-6.jpg" alt="footer-gallery-6" /></a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="rh footer-btm">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <h6 class="pull-left">Copyrights &copy; 2019 Group-G</h6>
                      <span class="pull-right">Powered by <a target="_blank" href="http://www.test.com/">All Students of Group-G in SVIMS</a></span>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- Footer Close -->

  <!-- Backe To Top Begin -->
  <div id="back_to_top" class="active">
      <i class="fa fa-angle-up" aria-hidden="true"></i>
  </div>

<?php }else{ ?>
    <!-- Header Begin -->
    <header class="rh">
        <!-- ========== Top Menu ========== -->
        <div class="rh-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                        <ul class="top">
                            <li>

                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                        <ul class="pull-right">
                          <li><a href="javascript:;"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                          <li><a href="javascript:;"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                          <li><a href="javascript:;"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                          <li><a href="javascript:;"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                          <li><a href="javascript:;"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                          <li></li>
                          <li>
                              <a href="Admin_login.php" >Admin</a>
                          </li>
                          <!-- <li>
                                  <a href="signup.php" >Signup</a>
                              </li> -->
                              <li>
                                <div class="dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php  echo "Hi,"." ".$_SESSION['name'];?> <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="user_booking_history.php"><i class="fa fa-briefcase"></i> My Booking</a>
                                  <a class="dropdown-item" href="user_profile.php"><i class="fa fa-user"></i>Profile</a>
                                  <!-- <a class="dropdown-item" href="#"><i class="fa fa-unlock-alt"></i> Change Password</a> -->
                                  <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                                </div>
                              </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== Nav Menu ========== -->
        <nav class="rh navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse rh-toggle" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right main-navbar">
                        <li>
                            <a href="index.php">Home</a>

                        </li>
                        <li>
                            <a href="available-rooms.php">Available Rooms</a>
                        </li>
                        <!-- <li>
                            <a href="#">Single Rooms</a>
                        </li> -->
                        <li>
                            <a class="active" href="booking.php">Booking</a>
                        </li>

                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Header Close -->

    <!-- Small Banner Begin -->
    <section class="rh-detail-bg list-view-column2 event">
        <div class="container">
            <div class="row">
                <div class="rh-detail-widgets ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="rh text-center">
                            <h2>Booking</h2>
                            <p>Captions line here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Small Banner Close -->

    <!-- Main Content Begin -->
    <div class="rh rh-100 section-booking">
        <!-- Booking Page Begin -->
        <div class="container">
            <div class="row">
              <form action="search.php" method="post">
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                      <h5>Arrival date</h5>
                      <div class="form-group">
                          <input type="date" name="arrive" value="" class="form-control" placeholder="" autocomplete="on" required>
                      </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                      <h5>Departure date</h5>
                      <div class="form-group">
                          <input type="date" name="depature" value="" class="form-control" placeholder="" autocomplete="on" required>
                      </div>
                  </div>

                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                      <h5>Location</h5>
                      <select class="selectpicker" name="city" onchange="getValue(this.value);">
                      <!--<select class="selectpicker" name="city">-->
                      <option>select</option>
                        <?php
                          $sqlc="select * from city where isActive=1";
                          $datac= mysqli_query($conn,$sqlc);

                          while ($rowc= mysqli_fetch_assoc($datac))
                          {
                        ?>
                          <option value="<?php echo $rowc['city_id'] ?>"><?php echo $rowc['city_name'] ?></option>

                        <?php }?>
                      </select>
                  </div>

                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-s-30" >
                      <h5>Hotel</h5>
                          <select class="browser-default filter-option custom-select" name="hotel" id="hotel_list" onchange="getValue1(this.value);">
                           <option >Select</option>

                         </select>
                         </div>

                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-s-30" >
                      <h5>Category</h5>
                          <select class="browser-default filter-option custom-select" name="category" id="cat_list">
                           <option >Select</option>

                         </select>
                  </div>

                  <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                        <input type="submit" value="Search"class="rh-check-btn pull-right">
                  </div>

                  <!-- <div class="col-md-8 col-sm-6 col-xs-8 rh-xs-9">
                      <input type="submit" value="Search"class="rh-check-btn pull-right">
                  </div> -->
              </form>
            </div>
        </div>
        <!-- Booking Page Close -->
    </div>
    <!-- Main Content Close -->

    <!-- Footer Begin -->
    <footer class="rh">
        <div class="rh-100 rh-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 rh-f-30 rh-f-100">
                        <div class="rh-footer-box">
                            <img class="footer-logo" src="images/Logo-footer.png" alt="footer-logo" />
                            <p>You have questions regarding our services? Contact us, we will be happy to help you out!</p>
                            <ul class="footer-about">
                              <li><a href="mailto:indianhotel81@gmail.com">indianhotel81@gmail.com</a></li>
                              <li><a href="javascript:;">2/10 B, Baghajatin, Kol-700086</a></li>
                              <li><a href="tel:+974-947-1818">+91 974-947-1818</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 rh-f-30 rh-f-50">
                        <div class="rh-footer-box">
                            <h5>Hotel</h5>
                            <ul class="footer-menu list">
                                <li><a href="javascript:;">Accommodation</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="javascript:;">Services & Amenities</a></li>
                                <li><a href="javascript:;">Dining</a></li>
                                <li><a href="javascript:;">Spa</a></li>
                                <li><a href="javascript:;">Destination</a></li>
                                <li><a href="javascript:;">Offer</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 rh-fs-30 rh-f-50">
                        <div class="rh-footer-box">
                            <h5>Inquires</h5>
                            <ul class="footer-menu list">
                                <li><a href="javascript:;">About  Four Seasons</a></li>
                                <li><a href="javascript:;">Press Room</a></li>
                                <li><a href="javascript:;">Gift Cards</a></li>
                                <li><a href="javascript:;">Residences</a></li>
                                <li><a href="javascript:;">Careers</a></li>
                                <li><a href="contact.php">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 rh-f-100">
                        <div class="rh-footer-box">
                            <h5>Photo Gallery</h5>
                            <ul class="footer-menu gallery">
                                <li>
                                    <a><img src="images/footer-gallery-1.jpg" alt="footer-gallery-1" /></a>
                                </li>
                                <li>
                                    <a><img src="images/footer-gallery-2.jpg" alt="footer-gallery-2" /></a>
                                </li>
                                <li>
                                    <a><img src="images/footer-gallery-3.jpg" alt="footer-gallery-3" /></a>
                                </li>
                                <li>
                                    <a><img src="images/footer-gallery-4.jpg" alt="footer-gallery-4" /></a>
                                </li>
                                <li>
                                    <a><img src="images/footer-gallery-5.jpg" alt="footer-gallery-5" /></a>
                                </li>
                                <li>
                                    <a><img src="images/footer-gallery-6.jpg" alt="footer-gallery-6" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rh footer-btm">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="pull-left">Copyrights &copy; 2019 Group-G</h6>
                        <span class="pull-right">Powered by <a target="_blank" href="http://www.test.com/">All Students of Group-G in SVIMS</a></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Close -->

    <!-- Backe To Top Begin -->
    <div id="back_to_top" class="active">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
<?php } ?>
<script type= "text/javascript">
function getValue(val) {
  //alert(val);
$.ajax({
    type: "POST",
    url: "getValue.php",
    data:'city_id='+val,
    success: function (data) {
            //alert("success");
            $("#hotel_list").html(data);
          },
          error: function () {
            Walert("Something is Wrong, Please Try Again...");
          }
        });  // end Ajax
  }
  </script>

  <script type= "text/javascript">
  function getValue1(val) {
  $.ajax({
      type: "POST",
      url: "getValue1.php",
      data:'hotel_id='+val,
      success: function (data) {
              //alert("success");
              $("#cat_list").html(data);
            },
            error: function () {
              Walert("Something is Wrong, Please Try Again...");
            }

          });  // end Ajax
    }
    </script>

</body>
</html>
