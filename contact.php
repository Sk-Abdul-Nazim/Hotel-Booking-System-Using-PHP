<?php include('db_connection.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>

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
    <link rel="stylesheet" type="text/css" href="css/slick.css" />
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
    <script type="text/javascript">
        //********** Contact Snazzy Map **********//
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);

            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(40.6700, -73.9400), // New York

                    // How you would like to style the map.
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#D5A677"},{"visibility":"on"}]}]
                };
                // Get the HTML DOM element that will contain your map
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(40.6700, -73.9400),
                    map: map,
                    title: 'Snazzy!'
                });
            }
    </script>
</head>

<body>
  <?php
  if(!isset($_SESSION['name']) && $_SESSION['name'] ==""){
  ?>

  <header class="rh">
      <!-- ========== Top Menu ========== -->
      <div class="rh-header">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                      <ul class="top">

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
                          <a href="booking.php">Booking</a>
                      </li>

                      <li><a href="about.php">About</a></li>
                      <li><a class="active" href="contact.php">Contact</a></li>
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
                          <h2>Contact Us</h2>
                          <p>Captions line here</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Small Banner Close -->

  <!-- Main Content Begin -->
  <div class="rh section-booking">
      <!-- Contact Us Page Begin -->
      <section class="rh rh-100 rh-contact">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="rh-section-title">
                          <h2>Contact Us</h2>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </p>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="rh-contact-add">
                          <div class="icon-box">
                              <i class="fa fa-home" aria-hidden="true"></i>
                          </div>
                          <p>2/10 Baghajatin, Kol-700086</p>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="rh-contact-add">
                          <div class="icon-box">
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                          </div>
                          <p><a href="mailto:indianhotel81@gmail.com">indianhotel81@gmail.com</a></p>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="rh-contact-add">
                          <div class="icon-box">
                              <i class="fa fa-phone" aria-hidden="true"></i>
                          </div>
                          <p><a href="tel:+91974947-1818">(+91) 974-947-1818</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Contact Us Page Close -->

      <!-- Conatct Us Form Begin -->
      <section class="rh rh-100 rh-contact-form">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="rh-c-form">
                          <div class="form-area">
                              <form action="contact_form.php" method="post">
                                  <h3>Contact Form</h3>
                                  <div class="row">
                                      <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 rh-xs-12">
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                      </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 rh-xs-12">
                                          <input type="email" class="form-control" id="formemail" name="email" placeholder="Email" required>
                                      </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 rh-xs-12">
                                          <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
                                      </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 rh-xs-12">
                                          <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                      </div>
                                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                          <textarea class="form-control" id="message" placeholder="Message" name="message" maxlength="140" rows="7"></textarea>
                                          <span class="help-block" id="characterLeft">You have reached the limit</span>
                                      </div>
                                      <div class="rh col-xs-12">
                                          <input type="submit" class="rh-check-btn" value="Submit Form">
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <!-- The element that will contain our Google Map. This is used in both the Javascript and CSS above. -->
                      <div id="map"></div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Conatct Us Form Close -->

      <!-- News Letter Begin -->
      <section class="rh rh-newsletter">
          <div class="container">
              <div class="row">
                  <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 rh-n-30">
                      <div class="rh-news-sign">
                          <h5>Sign up for Newsletter</h5>
                          <p>Receive News Of Caruso Hotel</p>
                      </div>
                      <div class="rh-news-email">
                          <form class="news-email-form" method="post" action="#">
                              <input type="text" placeholder="Enter your email address..." />
                              <a href="javascript:;"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                          </form>
                      </div>
                  </div>
                  <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                      <div class="rh-news-sign">
                          <h5>Connect with us </h5>
                          <p>Social Media Channel</p>
                      </div>
                      <ul class="news-social">
                          <li><a href="javascript:;"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                          <li><a href="javascript:;"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                          <li><a href="javascript:;"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                          <li><a href="javascript:;"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                          <li><a href="javascript:;"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </section>
      <!-- News Letter Close -->
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
                              <li>
                                <div class="dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php  echo "Hi,"." ".$_SESSION['name'];?> <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="user_booking_history.php"><i class="fa fa-briefcase"></i> My Booking</a>
                                  <a class="dropdown-item" href="user_profile.php"><i class="fa fa-user"></i> Profile</a>
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
                        <li>
                            <a href="booking.php">Booking</a>
                        </li>

                        <li><a href="about.php">About</a></li>
                        <li><a class="active" href="contact.php">Contact</a></li>
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
                            <h2>Contact Us</h2>
                            <p>Captions line here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Small Banner Close -->

    <!-- Main Content Begin -->
    <div class="rh section-booking">
        <!-- Contact Us Page Begin -->
        <section class="rh rh-100 rh-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="rh-section-title">
                            <h2>Contact Us</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="rh-contact-add">
                            <div class="icon-box">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </div>
                            <p>2/10 Baghajatin, Kol-700086</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="rh-contact-add">
                            <div class="icon-box">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            <p><a href="mailto:indianhotel81@gmail.com">indianhotel81@gmail.com</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="rh-contact-add">
                            <div class="icon-box">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <p><a href="tel:+91974947-1818">(+91) 974-947-1818</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us Page Close -->

        <!-- Conatct Us Form Begin -->
        <section class="rh rh-100 rh-contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="rh-c-form">
                            <div class="form-area">
                                <form action="#">
                                    <h3>Contact Form</h3>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 rh-xs-12">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 rh-xs-12">
                                            <input type="text" class="form-control" id="formemail" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 rh-xs-12">
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 rh-xs-12">
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <textarea class="form-control" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>
                                            <span class="help-block" id="characterLeft">You have reached the limit</span>
                                        </div>
                                        <div class="rh col-xs-12">
                                            <a href="javascript:;" class="rh-check-btn">Submit Form</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <!-- The element that will contain our Google Map. This is used in both the Javascript and CSS above. -->
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Conatct Us Form Close -->

        <!-- News Letter Begin -->
        <section class="rh rh-newsletter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 rh-n-30">
                        <div class="rh-news-sign">
                            <h5>Sign up for Newsletter</h5>
                            <p>Receive News Of Caruso Hotel</p>
                        </div>
                        <div class="rh-news-email">
                            <form class="news-email-form" method="post" action="#">
                                <input type="text" placeholder="Enter your email address..." />
                                <a href="javascript:;"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                        <div class="rh-news-sign">
                            <h5>Connect with us </h5>
                            <p>Social Media Channel</p>
                        </div>
                        <ul class="news-social">
                            <li><a href="javascript:;"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- News Letter Close -->
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
</body>
</html>
