<?php include('db_connection.php');
error_reporting(0);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>

  <style>
  .san {
    background-color: red;
    color: white;
    padding: 1em 1.5em;
    text-decoration: none;
    text-transform: uppercase;
  	onmouseover:backgroundColor=blue;
  	/* onmouseout:this.style.backgroundColor='transparent';this.style.color='inherit'" */
  }
  .spm {
    background-color: #eccb7e;
    color: black;
    padding: 1em 1.5em;
    text-decoration: none;
    text-transform: uppercase;
  	onmouseover:backgroundColor=blue;
  	/* onmouseout:this.style.backgroundColor='transparent';this.style.color='inherit'" */
  }
  </style>

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
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
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
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse rh-toggle" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right main-navbar">
                        <li>
                            <a href="index.php">Home</a>
                            <ul class="dropdown-nav rh-drop-menu">

                            </ul>
                        </li>
                        <li>
                            <a class="active" href="available-rooms.php">Available Rooms</a>
                        </li>

                        <li>
                            <a href="booking.php">Booking</a>
                        </li>

                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
  <!-- Header Close -->

  <!-- Detail-page back Begin -->
  <section class="rh-detail-bg list-view-column2">
      <div class="container">
          <div class="row">
              <div class="rh-detail-widgets ">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="rh text-center">
                          <h2>Rooms & Suits</h2>
                          <p>Captions line here</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Detail-page back Close -->

  <?php
  $query = "select * from room where availability='YES'";
  $data= mysqli_query($conn,$query);
  $total= mysqli_num_rows($data);
  if($total!=0)
  {
    	$_SESSION['loggedin_search'] = "You Have To Login Before Room Book";
   ?>
      <!-- Main Content Begin -->
      <div class="rh rh-100">

          <!-- Column2 Grid View Begin -->
          <section class="sort-view-list select-list">
              <div class="container">
                  <!-- Sort By -->
                  <div class="row">
                      <div class="col-lg-9 col-md-8 col-sm-12">
                          <div class="row">
                              <div id="sort-by" class="sort-by">
                                  <div class="col-md-6 col-sm-8 col-xs-7">

                                  </div>
                                  <div class="col-md-6 col-sm-4 col-xs-5">
                                      <div class="buttons pull-right">
                                          <button class="sort-by-grid"><i class="fa fa-th" aria-hidden="true"></i></button>
                                          <button class="sort-by-list current"><i class="fa fa-th-list" aria-hidden="true"></i></button>
                                      </div>
                                  </div>

                                  <?php
                                    // $x=1;
                                       while ($row= mysqli_fetch_assoc($data))
                                       {
                                         $date = date('Y-m-d');
                                         $next_date = date('Y-m-d', strtotime($date .' +1 day'));
                                  			 $room_number = $row['room_number'];
                                         $room_id=$row['room_id'];
                                  			 $city_id=$row['city_id'];
                                  			 $hotel_id=$row['hotel_id'];

                                  			  $price= $row['price'];
                                  				$person= $row['number_of_person'];
                                  		 $imgpath='Admin/images/room/'.$row['room_image'];
                                  		 $queryhh = "select * from hotel where hotel_id='$hotel_id'";
                                  		 $datahh= mysqli_query($conn,$queryhh);
                                  		$rowhh= mysqli_fetch_assoc($datahh);

                                  		$querycc = "select * from city where city_id='$city_id'";
                                  		$datacc= mysqli_query($conn,$querycc);
                                  	 $rowcc= mysqli_fetch_assoc($datacc);

                                  		 ?>

                                  <div id="grid_list" class="sort-by-list">
                                      <div class="rh-flex">
                                          <div class="col-md-6 col-sm-6 col-xs-6 xs-pr">
                                              <div class="rh rh-feature-box rh-margin-30">
                                                  <div class="rh-img">
                                                    <img src="<?php echo $imgpath;?>" alt="1" />
                                                      <a href="confirm_book.php?room_id=<?php echo $room_id;?>&check_in=<?php echo $date;?>&check_out=<?php echo $next_date;?>&person=<?php echo $person;?>&price=<?php echo $price;?>&cid=<?php echo $city_id;?>&hid=<?php echo $hotel_id;?>"></a>
                                                  </div>
                                                 <div class="feature-detail">
                                                      <h4><a href="confirm_book.php"><p>Room no: <?php echo $room_number;?></p><p><?php echo $rowhh['hotel_name']; ?></p></a></h4>
                                                      <div class="rating-star">

                                                     </div>
                                                     <div class="rh">
                                                          <p class="rh-top">Dolor adipisicing sunt laborum ut anim fugiat proident in culpa sint et eu. Dolore consectetur labore in magna ut laborum occaecat consequat dolor magna minim eiusmod dolor. Ut elit labore sed velit ex fugiat esse sit.</p>
                                                          <ul>
                                                            <li>

                                  															<p style="font-weight: bold;">Rs. <?php echo $price; ?></p>
                                  													</li>
                                                              <li>
                                                                  <i class="fa fa-phone" aria-hidden="true"></i>
                                                                  <p>+91 9749471818</p>
                                                              </li>
                                                              <li>
                                                                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                  <p><?php echo $rowcc['city_name']; ?></p>
                                                              </li>
                                                              <li>
                                                                <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
                                                                <p><a href="#" class="spm">View Details</a>
                                                                <a href="confirm_book.php?room_id=<?php echo $room_id;?>&check_in=<?php echo $date;?>&check_out=<?php echo $next_date;?>&person=<?php echo $person;?>&price=<?php echo $price;?>&cid=<?php echo $city_id;?>&hid=<?php echo $hotel_id;?>" class="san">BOOK</a></p>
                                                              </li>
                                                          </ul>
                                                     </div>
                                                 </div>
                                             </div>
                                          </div>
                                          <?php } ?>

                                                 </div>
                                             </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  <!-- Sidebar Detail -->
                  <div class="col-lg-3 col-md-4 col-sm-12">
                      <div class="rh-detail-right">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- About Royal Hotel Close -->

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
  <?php
  }
  else{
  //$_SESSION['loggedin_search'] = "true";
    echo "no Rooms";
    }
   ?>

<?php }else { ?>
    <!-- Header Begin -->
    <header class="rh">
          <!-- ========== Top Menu ========== -->
          <div class="rh-header">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                          <ul class="top">
                              <li>
                                  <!-- <select class="selectpicker">
                                      <option>English</option>
                                      <option>Portugal</option>
                                      <option>French</option>
                                  </select> -->
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
                                      <a class="dropdown-item" href="user_profile.php"><i class="fa fa-user"></i> Profile</a>
                                      <!-- <a class="dropdown-item" href="#"><i class="fa fa-unlock-alt"></i> Change Password</a> -->
                                      <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                    </div>
                                  </li>
                                    <!------------------------------------------->

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
                      <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse rh-toggle" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav navbar-right main-navbar">
                          <li>
                              <a href="index.php">Home</a>
                              <ul class="dropdown-nav rh-drop-menu">

                              </ul>
                          </li>
                          <li>
                              <a class="active" href="available-rooms.php">Available Rooms</a>
                          </li>
                          <!-- <li>
                              <a  href="#">Single Rooms</a>
                          </li> -->
                          <li>
                              <a href="booking.php">Booking</a>
                          </li>

                          <li><a href="about.php">About</a></li>
                          <li><a href="contact.php">Contact</a></li>
                      </ul>
                  </div>
              </div>
          </nav>
      </header>
    <!-- Header Close -->

    <!-- Detail-page back Begin -->
    <section class="rh-detail-bg list-view-column2">
        <div class="container">
            <div class="row">
                <div class="rh-detail-widgets ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="rh text-center">
                            <h2>Rooms & Suits</h2>
                            <p>Captions line here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Detail-page back Close -->
<?php
$query = "select * from room where availability='YES'";
$data= mysqli_query($conn,$query);
$total= mysqli_num_rows($data);
if($total!=0)
{

 ?>
    <!-- Main Content Begin -->
    <div class="rh rh-100">

        <!-- Column2 Grid View Begin -->
        <section class="sort-view-list select-list">
            <div class="container">
                <!-- Sort By -->
                <div class="row">
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="row">
                            <div id="sort-by" class="sort-by">
                                <div class="col-md-6 col-sm-8 col-xs-7">

                                </div>
                                <div class="col-md-6 col-sm-4 col-xs-5">
                                    <div class="buttons pull-right">
                                        <button class="sort-by-grid"><i class="fa fa-th" aria-hidden="true"></i></button>
                                        <button class="sort-by-list current"><i class="fa fa-th-list" aria-hidden="true"></i></button>
                                    </div>
                                </div>

                                <?php
                                  // $x=1;
                                     while ($row= mysqli_fetch_assoc($data))
                                     {
                                       $date = date('Y-m-d');
                                       $next_date = date('Y-m-d', strtotime($date .' +1 day'));
                                			 $room_number = $row['room_number'];
                                       $room_id=$row['room_id'];
                                			 $city_id=$row['city_id'];
                                			 $hotel_id=$row['hotel_id'];

                                			  $price= $row['price'];
                                				$person= $row['number_of_person'];
                                		 $imgpath='Admin/images/room/'.$row['room_image'];
                                		 $queryhh = "select * from hotel where hotel_id=$hotel_id";
                                		 $datahh= mysqli_query($conn,$queryhh);
                                		$rowhh= mysqli_fetch_assoc($datahh);

                                		$querycc = "select * from city where city_id=$city_id";
                                		$datacc= mysqli_query($conn,$querycc);
                                	 $rowcc= mysqli_fetch_assoc($datacc);

                                		 ?>

                                <div id="grid_list" class="sort-by-list">
                                    <div class="rh-flex">
                                        <div class="col-md-6 col-sm-6 col-xs-6 xs-pr">
                                            <div class="rh rh-feature-box rh-margin-30">
                                                <div class="rh-img">
                                                  <img src="<?php echo $imgpath;?>" alt="1" />
                                                    <a href="confirm_book.php?room_id=<?php echo $room_id;?>&check_in=<?php echo $date;?>&check_out=<?php echo $next_date;?>&person=<?php echo $person;?>&price=<?php echo $price;?>&cid=<?php echo $city_id;?>&hid=<?php echo $hotel_id;?>"></a>
                                                </div>
                                               <div class="feature-detail">
                                                    <h4><a href="confirm_book.php"><p>Room no: <?php echo $room_number;?></p><p><?php echo $rowhh['hotel_name']; ?></p></a></h4>
                                                    <div class="rating-star">

                                                   </div>
                                                   <div class="rh">
                                                        <p class="rh-top">Dolor adipisicing sunt laborum ut anim fugiat proident in culpa sint et eu. Dolore consectetur labore in magna ut laborum occaecat consequat dolor magna minim eiusmod dolor. Ut elit labore sed velit ex fugiat esse sit.</p>
                                                        <ul>
                                                          <li>

                                															<p style="font-weight: bold;">Rs. <?php echo $price; ?></p>
                                													</li>
                                                            <li>
                                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                                <p>+91 9749471818</p>
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                <p><?php echo $rowcc['city_name']; ?></p>
                                                            </li>
                                                            <li>
                                                              <!-- <i class="fa fa-map-marker" aria-hidden="true"></i> -->
                                                              <p><a href="#" class="spm">View Details</a>
                                                              <a href="confirm_book.php?room_id=<?php echo $room_id;?>&check_in=<?php echo $date;?>&check_out=<?php echo $next_date;?>&person=<?php echo $person;?>&price=<?php echo $price;?>&cid=<?php echo $city_id;?>&hid=<?php echo $hotel_id;?>" class="san">BOOK</a></p>
                                                            </li>
                                                        </ul>
                                                   </div>
                                               </div>
                                           </div>
                                        </div>
                                        <?php } ?>

                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Detail -->
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="rh-detail-right">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Royal Hotel Close -->

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
    <!-- Backe To Top Close -->

    <!-- Login Form Begin -->
    <div class="modal fade rh-login" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="well">
                                <form id="loginForm" method="POST" action="#">
                                    <div class="form-group">
                                        <label for="username" class="control-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required title="Please enter you username" placeholder="example@gmail.com">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control" required title="Please enter your password" placeholder="Password">
                                    </div>
                                    <div class="alert alert-error hide">Wrong username og password</div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember login
                                        </label>
                                        <p class="help-block">(if this is a private computer)</p>
                                    </div>
                                    <a href="javascript:;" class="rh-check-btn btn-block">Login</a>
                                    <a href="javascript:;" class="btn btn-default btn-block">Create Account</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Form Close -->

    <!-- Sign up Form Begin -->
    <div class="modal fade rh-signup" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal-title">Sign Up</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="well">
                                <form id="signup" method="POST" action="#">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label for="firstname" class="control-label">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" required title="Please enter your firstname" placeholder="First Name" />
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label for="lastname" class="control-label">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" required title="Please enter your lastname" placeholder="Last Name" />
                                        </div>
                                        <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" required title="Please enter your email" placeholder="Email" />
                                        </div>
                                        <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                                            <label for="email" class="control-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" required title="Please enter your phone" placeholder="Phone" />
                                        </div>
                                        <div class="form-group  col-md-12 col-sm-12 col-xs-12">
                                            <label for="address" class="control-label">Address 1</label>
                                            <input type="text" class="form-control" id="address" name="address" required title="Please enter your address" placeholder="Address" />
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label class="control-label">Password</label>
                                            <input type="password" class="form-control" required title="Please enter your password" placeholder="Password" />
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label class="control-label">Conform Password</label>
                                            <input type="password" class="form-control" required title="conform password" placeholder="Conform Password" />
                                        </div>
                                        <div class="alert alert-error hide">Wrong username og password</div>
                                        <div class="form-group signup col-md-12">
                                            <label>
                                                <input type="checkbox" name="remember" /> Remember login
                                            </label>
                                            <a href="javascript:;" class="rh-check-btn btn-block">Create Account</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign up Form Close -->
    <?php
    }
    else{
      echo "no rooms";
      }
     ?>
<?php } ?>

</body>

</html>
