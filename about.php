<?php include('db_connection.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
  <style>
    p{
      text-align: justify;
    }
  </style>
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
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
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
  if(!isset($_SESSION["loggedin2"])){

  ?>
  <header class="rh">
      <!-- ========== Top Menu ========== -->
      <div class="rh-header">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                      <ul class="top">

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
                      <!-- <li>
                          <a href="#">Single Rooms</a>
                      </li> -->
                      <li>
                          <a href="booking.php">Booking</a>
                      </li>

                      <li><a class="active" href="about.php">About</a></li>
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
                          <h2>About</h2>
                          <p style="text-align:center">About Of Indian Hotel</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- Small Banner Close -->

  <!-- Main Content Begin -->
  <div class="rh section-booking">
      <!-- About Page Begin -->
      <section class="rh rh-100 rh-about">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="rh-section-title">
                          <h2>About Indian Hotel</h2>
                          <p>Since 2019 our hotel was established, We provied best
                            hotel in our locality, We provide deluxe and luxury  room with clean and best mattress, we have
                            a clean our hotel and providing 24hrs service. In our Hotel we guarantee check-in time from
                            3.00 p.m and Check-out from the room is at 12.00 p.m. but if the room is ready upon your arrival,
                            you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive,
                            you can store your luggage with us at no charge until the room is available.
                          </p>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                      <div class="rh-about-img">
                          <div class="rh-img">
                              <img src="images/about/2.jpg" alt="2">
                              <a href="#"></a>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                      <div class="rh-about-title">
                          <h4>Indian Hotel | Guest Reviews | Corpus Christi</h4>
                          <p> At Imperial Hotel we guarantee check-in from 3.00 p.m., but if the room is ready upon your arrival, you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive, you can store your luggage with us at no charge until the room is available.
                          </p>
                          <p> Check-out from the room is at 12.00 p.m. at the latest, but if you need a late check-out, then contact our reception upon arrival, or during your stay, and we will do our best to accommodate your request. Similar to check-in, you have the option to store your luggage when checking out.  
                          </p>
                          <!-- <a href="#" class="rh-check-btn">View More</a> -->
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- About Page Close -->

      <!-- About Service Begin -->
      <section class="rh rh-100 rh-about-services">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="rh-section-title">
                          <h2>Services</h2>
                          <p> At Imperial Hotel we guarantee check-in from 3.00 p.m., but if the room is ready upon your arrival, you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive, you can store your luggage with us at no charge until the room is available.
                         </p>
                         <p> Check-out from the room is at 12.00 p.m. at the latest, but if you need a late check-out, then contact our reception upon arrival, or during your stay, and we will do our best to accommodate your request. Similar to check-in, you have the option to store your luggage when checking out.  
                         </p>
                         <p>If you're busy and can pay with a credit card, or your accommodation is already pre-paid, you can make use of our popular Express Check-out and avoid the waiting time. Our Express Check-out stands can be found in the lobby right next to the main entrance. The receipt for your stay will then be sent via e-mail on the same day. </p>
                      </div>
                  </div>
                  <div class="rh multiple-items">
                      <div>
                          <div class="col-md-12">
                              <div class="rh rh-feature-box">
                                  <div class="rh-img">
                                      <img src="images/services/1.jpg" alt="1">
                                      <a href=""></a>
                                  </div>
                                  <div class="feature-detail">
                                      <h4><a href="">24h Rooms Services</a></h4>
                                      <p style="text-align: justify;">Since 2019 our hotel was established, We provied best
                                        hotel in our locality, We provide deluxe and luxury  room with clean and best mattress, we have
                                        a clean our hotel and providing 24hrs service. In our Hotel we guarantee check-in time from
                                        3.00 p.m and Check-out from the room is at 12.00 p.m. but if the room is ready upon your arrival,
                                        you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive,
                                        you can store your luggage with us at no charge until the room is available.
                                      </p>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div>
                          <div class="col-md-12">
                              <div class="rh rh-feature-box">
                                  <div class="rh-img">
                                      <img src="images/services/4.jpg" alt="4">
                                      <a href=""></a>
                                  </div>
                                  <div class="feature-detail">
                                      <h4><a href="">Bars</a></h4>
                                    <p>We also have a bar beside the restaurant. Enjoy a drink in our spacious lounge bar, is a truly enjoyable experience – the views of the natural harbour, no ships just a variety of birds and may be even spot a stray seal or penguin and then across the water with the opposite side comprising of natural terrain, with the names of ships picked out by natural stones will help to ensure that you will have a “relaxing drink” There is a full range of bar drinks including a wide selection of spirits, Whisky, Brandy and Liqueurs, soft drinks and  beer </p>
                                    <!-- including.  The wine list includes a variety and styles of wine including the famous Montes premium wine produced in Chile, with wines by the bottle and glass. A selection of teas and coffees are available throughout the day in the Lounge Bar. -->
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div>
                          <div class="col-md-12">
                              <div class="rh rh-feature-box">
                                  <div class="rh-img">
                                      <img src="images/services/5.jpg" alt="5">
                                      <a href=""></a>
                                  </div>
                                  <div class="feature-detail">
                                      <h4><a href="">Massage & Spa</a></h4>
                                      <p>We give a full-service day spa in the calm and comfort of your hotel room. Our licensed spa teams are highly skilled and trained to bring that spa experience to your hotel room. They will banish your stress and tension allowing you to get the rest you need, all in the comfort and convenience of your room.

  Gentle touch of health is offering spa services in our hotel main area and we will give a full spa whatever your time is, we can help, get a massage treatment suitable to travellers needs  teams are highly .</p>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div>
                          <div class="col-md-12">
                              <div class="rh rh-feature-box">
                                  <div class="rh-img">
                                      <img src="images/services/6.jpg" alt="6">
                                      <a href=""></a>
                                  </div>
                                  <div class="feature-detail">
                                      <h4><a href="">Swimming Pool</a></h4>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- About Service Close -->

      <!-- Our History Begin-->
      <section class="rh rh-100 rh-our-history">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 col-md-6">
                      <div class="rh-about-title">
                          <h2>Our History</h2>
                          <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                          <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                          <!-- <a href="" class="rh-check-btn">View More</a> -->
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                      <div class="rh-history-list">
                          <!-- begin panel group -->
                          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                              <!-- panel 1 -->
                              <div class="panel panel-default">
                                  <!--wrap panel heading in span to trigger image change as well as collapse -->
                                  <div class="side-tab" data-target="#tab1" data-toggle="tab" role="tab" aria-expanded="false">
                                      <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          <h4 class="panel-title">2017 Third Economic Conference</h4>
                                      </div>
                                  </div>

                                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                      <div class="panel-body">
                                      <!-- Tab content goes here -->
                                      That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                      </div>
                                  </div>
                              </div>
                              <!-- / panel 1 -->

                              <!-- panel 2 -->
                              <div class="panel panel-default">
                                  <!--wrap panel heading in span to trigger image change as well as collapse -->
                                  <div class="side-tab" data-target="#tab2" data-toggle="tab" role="tab" aria-expanded="false">
                                      <div class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          <h4 class="panel-title collapsed">2016 Opening of Blue Star Building</h4>
                                      </div>
                                  </div>

                                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                      <div class="panel-body">
                                      <!-- Tab content goes here -->
                                      That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                      </div>
                                  </div>
                              </div>
                              <!-- / panel 2 -->

                              <!--  panel 3 -->
                              <div class="panel panel-default">
                                  <!--wrap panel heading in span to trigger image change as well as collapse -->
                                  <div class="side-tab" data-target="#tab3" data-toggle="tab" role="tab" aria-expanded="false">
                                      <div class="panel-heading" role="tab" id="headingThree"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                          <h4 class="panel-title">2015 Fifth Star Achievement</h4>
                                      </div>
                                  </div>

                                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                    <!-- tab content goes here -->
                                     That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                    </div>
                                  </div>
                              </div>

                              <!--  panel 4 -->
                              <div class="panel panel-default">
                                  <!--wrap panel heading in span to trigger image change as well as collapse -->
                                  <div class="side-tab" data-target="#tab4" data-toggle="tab" role="tab" aria-expanded="false">
                                      <div class="panel-heading" role="tab" id="headingfour"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                          <h4 class="panel-title">2014 Opening of YooNa Luxury Casino</h4>
                                      </div>
                                  </div>

                                  <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                                    <div class="panel-body">
                                    <!-- tab content goes here -->
                                     That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                    </div>
                                  </div>
                              </div>

                              <!--  panel 5 -->
                              <div class="panel panel-default">
                                  <!--wrap panel heading in span to trigger image change as well as collapse -->
                                  <div class="side-tab" data-target="#tab5" data-toggle="tab" role="tab" aria-expanded="false">
                                      <div class="panel-heading" role="tab" id="headingfive"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                          <h4 class="panel-title">2013 Fourth Star Achievement</h4>
                                      </div>
                                  </div>

                                  <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                                    <div class="panel-body">
                                    <!-- tab content goes here -->
                                     That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                    </div>
                                  </div>
                              </div>

                              <!--  panel 6 -->
                              <div class="panel panel-default">
                                  <!--wrap panel heading in span to trigger image change as well as collapse -->
                                  <div class="side-tab" data-target="#tab6" data-toggle="tab" role="tab" aria-expanded="false">
                                      <div class="panel-heading" role="tab" id="headingsix"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                          <h4 class="panel-title">2012 Founded by Bsquaressoft</h4>
                                      </div>
                                  </div>

                                  <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
                                    <div class="panel-body">
                                    <!-- tab content goes here -->
                                     That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Our History Close-->


              <section class="rh rh-100 rh-testimonial">
                <div class="container">
                    <div class="row">

                        <!-- Our Services Title -->
                        <div class="col-lg-12 col-md-12">
                            <div class="rh-section-title">
                                <h2>Excerpt</h2>
                                <p style="text-align:justify;">You can't work here, do what's best for you, but you can work like labor and magazines. You can practice on us reliably </p>
                            </div>
                        </div>

                        <!-- Testimonial Slider -->
                        <div class="rh-testimonial-slider">
                             <div class="lazy slider" data-sizes="50vw">
                                 <div>
                                     <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                         <img src="images/author/avishak.jpg" alt="Author" />
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                         <p>Hi myself Avishak Pattanayok I m the founder of this company and I also developed this website fetching with database. Basically I developed the admin panel of this website.</p>
                                         <span><a href="javascript:;">Avishak Pattanayok</a></span>
                                     </div>
                                 </div>
                                 <div>
                                     <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                         <img src="images/author/nazim.jpg" alt="Author" />
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                         <p>Hi myself Sk Abdul Nazim I m the co-founder of this company and I developed both the back end and the Font end of the website.</p>
                                         <span><a href="javascript:;">Sk Abdul Nazim</a></span>
                                     </div>
                                 </div>
                                 <div>
                                     <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                         <img src="images/author/suman.jpg" alt="Author" />
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                         <p>Hi i am Suman Patra , I am the co-founder of this company and I also work on this website as a designer. Basically i work on the design part of this website.</p>
                                         <span><a href="javascript:;">Suman Patra</a></span>
                                     </div>
                                 </div>
                                 <div>
                                     <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                         <img src="images/author/biswajit.jpg" alt="Author" />
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                         <p>Hi i am Biswajit Roy, I am the  co-founder of this company and I also work on this website as a designer. Basically i work on the design part of this website.</p>
                                         <span><a href="javascript:;">Biswajit Roy</a></span>
                                     </div>
                                 </div>
                                 <div>
                                     <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                         <img src="images/author/sandipan.jpg" alt="Author" />
                                     </div>
                                     <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                         <p>Hi i am Sandipan Paramanik, I am also the co-founder of this company and I also work on this website as developer. Basically i work on the back end part of this website.</p>
                                         <span><a href="javascript:;">Sandipan Pramanik</a></span>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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
                            <a href="booking.php">Booking</a>
                        </li>

                        <li><a class="active" href="about.php">About</a></li>
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
                            <h2>About</h2>
                            <p style="text-align:center">About Of Indian Hotel</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Small Banner Close -->

    <!-- Main Content Begin -->
    <div class="rh section-booking">
        <!-- About Page Begin -->
        <section class="rh rh-100 rh-about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="rh-section-title">
                            <h2>About Indian Hotel</h2>
                            <p>Since 2019 our hotel was established, We provied best
                              hotel in our locality, We provide deluxe and luxury  room with clean and best mattress, we have
                              a clean our hotel and providing 24hrs service. In our Hotel we guarantee check-in time from
                              3.00 p.m and Check-out from the room is at 12.00 p.m. but if the room is ready upon your arrival,
                              you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive,
                              you can store your luggage with us at no charge until the room is available.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="rh-about-img">
                            <div class="rh-img">
                                <img src="images/about/2.jpg" alt="2">
                                <a href="#"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="rh-about-title">
                            <h4>Indian Hotel | Guest Reviews | Corpus Christi</h4>
                            <p> At Imperial Hotel we guarantee check-in from 3.00 p.m., but if the room is ready upon your arrival, you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive, you can store your luggage with us at no charge until the room is available.
                            </p>
                            <p> Check-out from the room is at 12.00 p.m. at the latest, but if you need a late check-out, then contact our reception upon arrival, or during your stay, and we will do our best to accommodate your request. Similar to check-in, you have the option to store your luggage when checking out.  
                            </p>
                            <!-- <a href="#" class="rh-check-btn">View More</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Page Close -->

        <!-- About Service Begin -->
        <section class="rh rh-100 rh-about-services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="rh-section-title">
                            <h2>Services</h2>
                            <p> At Imperial Hotel we guarantee check-in from 3.00 p.m., but if the room is ready upon your arrival, you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive, you can store your luggage with us at no charge until the room is available.
                           </p>
                           <p> Check-out from the room is at 12.00 p.m. at the latest, but if you need a late check-out, then contact our reception upon arrival, or during your stay, and we will do our best to accommodate your request. Similar to check-in, you have the option to store your luggage when checking out.  
                           </p>
                           <p>If you're busy and can pay with a credit card, or your accommodation is already pre-paid, you can make use of our popular Express Check-out and avoid the waiting time. Our Express Check-out stands can be found in the lobby right next to the main entrance. The receipt for your stay will then be sent via e-mail on the same day. </p>
                        </div>
                    </div>
                    <div class="rh multiple-items">
                        <div>
                            <div class="col-md-12">
                                <div class="rh rh-feature-box">
                                    <div class="rh-img">
                                        <img src="images/services/1.jpg" alt="1">
                                        <a href=""></a>
                                    </div>
                                    <div class="feature-detail">
                                        <h4><a href="">24h Rooms Services</a></h4>
                                        <p style="text-align: justify;">Since 2019 our hotel was established, We provied best
                                          hotel in our locality, We provide deluxe and luxury  room with clean and best mattress, we have
                                          a clean our hotel and providing 24hrs service. In our Hotel we guarantee check-in time from
                                          3.00 p.m and Check-out from the room is at 12.00 p.m. but if the room is ready upon your arrival,
                                          you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive,
                                          you can store your luggage with us at no charge until the room is available.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="col-md-12">
                                <div class="rh rh-feature-box">
                                    <div class="rh-img">
                                        <img src="images/services/4.jpg" alt="4">
                                        <a href=""></a>
                                    </div>
                                    <div class="feature-detail">
                                        <h4><a href="">Bars</a></h4>
                                      <p>We also have a bar beside the restaurant. Enjoy a drink in our spacious lounge bar, is a truly enjoyable experience – the views of the natural harbour, no ships just a variety of birds and may be even spot a stray seal or penguin and then across the water with the opposite side comprising of natural terrain, with the names of ships picked out by natural stones will help to ensure that you will have a “relaxing drink” There is a full range of bar drinks including a wide selection of spirits, Whisky, Brandy and Liqueurs, soft drinks and  beer </p>
                                      <!-- including.  The wine list includes a variety and styles of wine including the famous Montes premium wine produced in Chile, with wines by the bottle and glass. A selection of teas and coffees are available throughout the day in the Lounge Bar. -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="col-md-12">
                                <div class="rh rh-feature-box">
                                    <div class="rh-img">
                                        <img src="images/services/5.jpg" alt="5">
                                        <a href=""></a>
                                    </div>
                                    <div class="feature-detail">
                                        <h4><a href="">Massage & Spa</a></h4>
                                        <p>We give a full-service day spa in the calm and comfort of your hotel room. Our licensed spa teams are highly skilled and trained to bring that spa experience to your hotel room. They will banish your stress and tension allowing you to get the rest you need, all in the comfort and convenience of your room.

    Gentle touch of health is offering spa services in our hotel main area and we will give a full spa whatever your time is, we can help, get a massage treatment suitable to travellers needs  teams are highly .</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="col-md-12">
                                <div class="rh rh-feature-box">
                                    <div class="rh-img">
                                        <img src="images/services/6.jpg" alt="6">
                                        <a href=""></a>
                                    </div>
                                    <div class="feature-detail">
                                        <h4><a href="">Swimming Pool</a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Service Close -->

        <!-- Our History Begin-->
        <section class="rh rh-100 rh-our-history">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="rh-about-title">
                            <h2>Our History</h2>
                            <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                            <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            <!-- <a href="" class="rh-check-btn">View More</a> -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="rh-history-list">
                            <!-- begin panel group -->
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                <!-- panel 1 -->
                                <div class="panel panel-default">
                                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                                    <div class="side-tab" data-target="#tab1" data-toggle="tab" role="tab" aria-expanded="false">
                                        <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="panel-title">2017 Third Economic Conference</h4>
                                        </div>
                                    </div>

                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">
                                        <!-- Tab content goes here -->
                                        That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                        </div>
                                    </div>
                                </div>
                                <!-- / panel 1 -->

                                <!-- panel 2 -->
                                <div class="panel panel-default">
                                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                                    <div class="side-tab" data-target="#tab2" data-toggle="tab" role="tab" aria-expanded="false">
                                        <div class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h4 class="panel-title collapsed">2016 Opening of Blue Star Building</h4>
                                        </div>
                                    </div>

                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">
                                        <!-- Tab content goes here -->
                                        That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                        </div>
                                    </div>
                                </div>
                                <!-- / panel 2 -->

                                <!--  panel 3 -->
                                <div class="panel panel-default">
                                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                                    <div class="side-tab" data-target="#tab3" data-toggle="tab" role="tab" aria-expanded="false">
                                        <div class="panel-heading" role="tab" id="headingThree"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <h4 class="panel-title">2015 Fifth Star Achievement</h4>
                                        </div>
                                    </div>

                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                      <div class="panel-body">
                                      <!-- tab content goes here -->
                                       That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                      </div>
                                    </div>
                                </div>

                                <!--  panel 4 -->
                                <div class="panel panel-default">
                                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                                    <div class="side-tab" data-target="#tab4" data-toggle="tab" role="tab" aria-expanded="false">
                                        <div class="panel-heading" role="tab" id="headingfour"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                            <h4 class="panel-title">2014 Opening of YooNa Luxury Casino</h4>
                                        </div>
                                    </div>

                                    <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                                      <div class="panel-body">
                                      <!-- tab content goes here -->
                                       That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                      </div>
                                    </div>
                                </div>

                                <!--  panel 5 -->
                                <div class="panel panel-default">
                                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                                    <div class="side-tab" data-target="#tab5" data-toggle="tab" role="tab" aria-expanded="false">
                                        <div class="panel-heading" role="tab" id="headingfive"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                            <h4 class="panel-title">2013 Fourth Star Achievement</h4>
                                        </div>
                                    </div>

                                    <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                                      <div class="panel-body">
                                      <!-- tab content goes here -->
                                       That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                      </div>
                                    </div>
                                </div>

                                <!--  panel 6 -->
                                <div class="panel panel-default">
                                    <!--wrap panel heading in span to trigger image change as well as collapse -->
                                    <div class="side-tab" data-target="#tab6" data-toggle="tab" role="tab" aria-expanded="false">
                                        <div class="panel-heading" role="tab" id="headingsix"  class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                            <h4 class="panel-title">2012 Founded by Bsquaressoft</h4>
                                        </div>
                                    </div>

                                    <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
                                      <div class="panel-body">
                                      <!-- tab content goes here -->
                                       That fall, as Nadia and Masha got shipped off to prison camps in Siberia, South Brooklyn tried to recover from the storm. My dad and I spent a lot of time in the same apartment engrossed in separate laptops, separate internet missives. He followed Russian news bloggers closely and would update me on troubling developments. A rise in protofascist nationalism
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Our History Close-->





        <section class="rh rh-100 rh-testimonial">
          <div class="container">
              <div class="row">

                  <!-- Our Services Title -->
                  <div class="col-lg-12 col-md-12">
                      <div class="rh-section-title">
                          <h2>Excerpt</h2>
                          <p style="text-align:justify;">You can't work here, do what's best for you, but you can work like labor and magazines. You can practice on us reliably </p>
                      </div>
                  </div>

                  <!-- Testimonial Slider -->
                  <div class="rh-testimonial-slider">
                       <div class="lazy slider" data-sizes="50vw">
                           <div>
                               <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                   <img src="images/author/avishak.jpg" alt="Author" />
                               </div>
                               <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                   <p>Hi myself Avishak Pattanayok I m the founder of this company and I also developed this website fetching with database. Basically I developed the admin panel of this website.</p>
                                   <span><a href="javascript:;">Avishak Pattanayok</a></span>
                               </div>
                           </div>
                           <div>
                               <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                   <img src="images/author/nazim.jpg" alt="Author" />
                               </div>
                               <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                   <p>Hi myself Sk Abdul Nazim I m the co-founder of this company and I developed both the back end and the Font end of the website.</p>
                                   <span><a href="javascript:;">Sk Abdul Nazim</a></span>
                               </div>
                           </div>
                           <div>
                               <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                   <img src="images/author/suman.jpg" alt="Author" />
                               </div>
                               <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                   <p>Hi i am Suman Patra , I am the co-founder of this company and I also work on this website as a designer. Basically i work on the design part of this website.</p>
                                   <span><a href="javascript:;">Suman Patra</a></span>
                               </div>
                           </div>
                           <div>
                               <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                   <img src="images/author/biswajit.jpg" alt="Author" />
                               </div>
                               <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                   <p>Hi i am Biswajit Roy, I am the  co-founder of this company and I also work on this website as a designer. Basically i work on the design part of this website.</p>
                                   <span><a href="javascript:;">Biswajit Roy</a></span>
                               </div>
                           </div>
                           <div>
                               <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 rh-t-50">
                                   <img src="images/author/sandipan.jpg" alt="Author" />
                               </div>
                               <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 rh-t-100">
                                   <p>Hi i am Sandipan Paramanik, I am also the co-founder of this company and I also work on this website as developer. Basically i work on the back end part of this website.</p>
                                   <span><a href="javascript:;">Sandipan Pramanik</a></span>
                               </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>


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
                                <li><a href="tel:+91 974-947-1818">+91 974-947-1818</a></li>
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
