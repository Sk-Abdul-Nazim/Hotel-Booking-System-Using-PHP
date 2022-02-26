<?php
include('db_connection.php');
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
  </style>
  <style>
    .moon {
      font-size: 17px!important;
      font-weight: bold!important;
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
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


</head>
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
                            <a href="login.php">Login</a>
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
                <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo" /></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse rh-toggle" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-navbar">
                    <li>
                        <a class="active" href="index.php">Home</a>

                    </li>
                    <li>
                        <a href="available-rooms.php">Available Rooms</a>
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

<!-- Slider Begin -->
<section class="rh-banner">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="images/home/1.jpg" alt="1">
                <div class="rh rh-banner-widgets">
                    <div class="container">
                        <div class="row">
                            <div class="rh-banner flex">
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                    <h1>Live The Wonderous <span>Life</span></h1>
                                    <!-- <span class="rh-price">From Rs.2000 / day</span> -->
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <a class="book-now" href="booking.php">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="images/home/2.jpg" alt="2">
                <div class="rh rh-banner-widgets">
                    <div class="container">
                        <div class="row flex">
                            <div class="col-lg-9 col-md-9">
                                <h1>Live The Wonderous <span>Life</span></h1>
                                <!-- <span class="rh-price">From Rs.1500 / day</span> -->
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <a class="book-now" href="booking.php">BOOK NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="images/home/3.jpg" alt="3">
                <div class="rh rh-banner-widgets">
                    <div class="container">
                        <div class="row flex">
                            <div class="col-lg-9 col-md-9">
                                <h1>Live The Wonderous <span>Life</span></h1>
                                <!-- <span class="rh-price">From Rs.1000 / day</span> -->
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <a class="book-now" href="booking.php">BOOK NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider Close -->

<!-- Main Content Begin -->
<div class="rh">

    <!-- Check Availability Begin -->
    <section class="rh rh-100 check-availability select-list">
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
    </section>
    <!-- Check Availability Close -->

    <!-- Featured Rooms Begin -->
    <section class="rh rh-100 rh-featured-rooms">
        <div class="container">
            <div class="row">

                <!-- Featured Rooms Title -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="rh-section-title">
                        <h2>Featured Rooms</h2>
                        <p style="text-align: justify;">We provide a Deluxe and luxury rooms in your budgets and we also give the
                          facilities of free Wifi , Writing desk, Personal safe, Refrigerator, Air conditioning with individual
                          controls, and Ironing board with iron.For Entertainment purposes we provide the DVD player, 32-inch LCD TV,
                          and Cable and international satellite channels and we give a full hygienic washroom , we give 24hrs room service
                           whenever you need you have to just call in hotel reception. </p>
                    </div>
                </div>
<?php
$query = "select * from room where availability='YES' LIMIT 3";
$data= mysqli_query($conn,$query);
$total=mysqli_num_rows($data);

while($row= mysqli_fetch_assoc($data))
{
  $imgpath='Admin/images/room/'.$row['room_image'];
  $hotel_id=$row['hotel_id'];
  $city_id=$row['city_id'];

  $date = date('Y-m-d');
  $next_date = date('Y-m-d', strtotime($date .' +1 day'));
 ?>
                <!-- Featured Rooms Grid Box -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 rh-mf-30">
                    <div class="rh rh-feature-box">
                        <div class="rh-img">
                            <img src="<?php echo $imgpath;?>" alt="feature_1" />
                            <a href="confirm_book.php?room_id=<?php echo $row['room_id'];?>&check_in=<?php echo $date;?>&check_out=<?php echo $next_date;?>&person=<?php echo $row['number_of_person'];?>&price=<?php echo $row['price'];?>&cid=<?php echo $city_id;?>&hid=<?php echo $hotel_id;?>"></a>
                        </div>
                        <?php
                        $sqlhn = "select * from hotel where hotel_id='$hotel_id'";
                        $datahn= mysqli_query($conn,$sqlhn);
                        $rowhn=mysqli_fetch_assoc($datahn);
                          ?>
                        <div class="feature-detail">
                            <h4><a href="#">Room No: <?php echo $row['room_number']; ?></a></h4>
                            <h4><a href="#"><?php echo $rowhn['hotel_name']; ?></a></h4>
                            <h4 class="moon"><a href="#" style="color:red">Rs. <?php echo $row['price']; ?></a></h4>
                            <h4 class="moon"><a href="#">Person : <?php echo $row['number_of_person']; ?></a></h4>

                            <?php
                            $sqlcn = "select * from city where city_id='$city_id'";
                            $datacn= mysqli_query($conn,$sqlcn);
                            $rowcn=mysqli_fetch_assoc($datacn);
                              ?>
                            <div class="rh">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <p><?php echo $rowcn['city_name'];?></p>
                            </div>
                            <div align="right">
                              <p>  <a href="confirm_book.php?room_id=<?php echo $row['room_id'];?>&check_in=<?php echo $date;?>&check_out=<?php echo $next_date;?>&person=<?php echo $row['number_of_person'];?>&price=<?php echo $row['price'];?>&cid=<?php echo $city_id;?>&hid=<?php echo $hotel_id;?>"
                                 class="san">BOOK</a></p>
                            </div>
                        </div>
                    </div>
                </div>
              <?php }?>

            </div>
        </div>
    </section>
    <!-- Featured Rooms Close -->

    <!-- Your stay Begin -->
    <section class="rh rh-100 rh-your-stay">
        <div class="container-fluid">
            <div class="row rh-margin-o">
                <div class="col-lg-4 col-md-12 half-left">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rh-left">
                                    <h2>Your Stay</h2>
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
                </div>
                <div class="col-lg-8 col-md-12 half-right">
                    <div class="row">
                        <div class="rh rh-right">
                            <div class="col-md-6 col-sm-6 col-xs-12 rh-mf-30">
                                <div class="stay-box">
                                    <img src="images/your-stay1.jpg" alt="your-stay1" />
                                    <a href="#"></a>
                                    <div class="overley">
                                        <div class="stay-detail">
                                            <h5>Deluxe Room</h5>
                                            <!-- <span>Rs.1500 / day</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="stay-box">
                                    <img src="images/your-stay2.jpg" alt="your-stay2" />
                                    <a href="#"></a>
                                    <div class="overley">
                                        <div class="stay-detail">
                                            <h5>Royal Room</h5>
                                            <!-- <span>Rs.2000 / day</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Your stay Close -->

    <!-- Ournews & Events Begin -->
    <section class="rh rh-100 rh-ournews">
        <div class="container">
            <div class="row">
                <!-- ournews & Events Title -->
                <div class="col-lg-12 col-md-12">
                    <div class="rh-section-title">
                        <h2>Our News & Events</h2>
                        <p style="text-align: justify;">Admin can be customized, providing optic monitoring,
                          but tempor and vitality, so that labor and grief, some important issues do not eiusmod.
                          Over the years, I will be able to aliquip out of the nostrud exercise facility out there,
                          so that stimulating effort can make the school district and longevity. cupidatat cillum The pain
                          has been criticized in the film and dolore magna produces no ending pleasure to escape. Excepteur
                           cupidatat Blacks are not excepteur, spirit, that is cool for, they are my toil that they should
                           serve the public blame publicly </p>
                    </div>
                </div>
            </div>
            <div class="row rh-flex">
                <!-- ournews & Events Box -->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rh-on-12">
                    <div class="rh rh-ournews-box rh-mar-30">
                        <div class="ournews-img">
                            <img src="images/ournews/ournews-1.jpg" alt="ournews-1" />
                            <a href="#"></a>
                        </div>
                        <div class="ournews-detail">
                            <h4><a href="#">Service </a></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rh-on-12">
                    <div class="rh rh-ournews-box rh-mar-30">
                        <div class="ournews-img">
                            <img src="images/ournews/ournews-2.jpg" alt="ournews-2" />
                            <a href="#"></a>
                        </div>
                        <div class="ournews-detail">
                            <h4><a href="#">Service</a></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rh-on-12">
                    <div class="rh rh-ournews-box rh-mar-30">
                        <div class="ournews-img">
                            <img src="images/ournews/ournews-3.jpg" alt="ournews-3" />
                            <a href="#"></a>
                        </div>
                        <div class="ournews-detail">
                            <h4><a href="#">Service</a></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rh-on-12">
                    <div class="rh rh-ournews-box rh-mar-30">
                        <div class="ournews-img">
                            <img src="images/ournews/ournews-4.jpg" alt="ournews-4" />
                            <a href="#"></a>
                        </div>
                        <div class="ournews-detail">
                            <h4><a href="#">Service</a></h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ournews & Events Close -->

    <!-- Our Services Begin -->
    <section class="rh rh-100 rh-our-services">
          <div class="container">
              <div class="row">

                  <!-- Our Services Title -->
                  <div class="col-lg-12 col-md-12">
                      <div class="rh-section-title">
                          <h2>Our Services</h2>
                          <p style="text-align: justify;">Since 2019 our hotel was established, We provied best
                            hotel in our locality, We provide deluxe and luxury  room with clean and best mattress, we have
                            a clean our hotel and providing 24hrs service. In our Hotel we guarantee check-in time from
                            3.00 p.m and Check-out from the room is at 12.00 p.m. but if the room is ready upon your arrival,
                            you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive,
                            you can store your luggage with us at no charge until the room is available.
                          </p>
                  </div>

                  <!-- Our Services Title -->
                  <div class="col-lg-12 col-md-12">
                      <div id="tabs-container" class="rh rh-tab-section">
                          <ul class="tabs-menu">
                              <li class="current"><a href="#tab-1"><i class="fa fa-cutlery" aria-hidden="true"></i><h5>Restaurant</h5></a></li>
                              <!-- <li><a href="#tab-2"><i class="fa fa-life-ring" aria-hidden="true"></i><h5>Sport-club</h5></a></li> -->
                              <li><a href="#tab-3"><i class="fa fa-car" aria-hidden="true"></i><h5>Pic-up</h5></a></li>
                              <li><a href="#tab-4"><i class="fa fa-glass" aria-hidden="true"></i><h5>Bar</h5></a></li>
                              <li><a href="#tab-5"><i class="fa fa-child" aria-hidden="true"></i><h5>Gym</h5></a></li>

                          </ul>
                          <div class="tab">
                              <div id="tab-1" class="tab-content">
                                  <div class="tab-content-img">
                                      <img src="images/our-serivesc-restorant.jpg" alt="our-serivesc-restorant" />
                                  </div>
                                  <div class="tab-content-detail">
                                      <span>The World Class</span>
                                      <h2>Restaurant & Banquets</h2>
                                      <p style="text-align:justify;">We have our own restaurant in ground floor, in our restaurant
                                        we provide all types of Indian dishes and continental dishes we are providing 24hrs food
                                        services for our guest . Make the best of your stay and enjoy relishing treats from our all-day
                                        diner. You’ll find its casual ambience and flavours spot-on. However we provide 24hrs food
                                        services but we have also a timing for breakfast , lunch and dinner.

                       Buffet Breakfast:  6.30 am to 10.30 am
                       Lunch: 12.30 pm to 3.30 pm
                       Dinner: 7 pm to 12.45 am.

                      For table reservations, please call +91 98098765809</p>
                                      <div class="tab-content-btm">
                                          <h6 class="pull-left">Services Hours : 19.00 - 22.00</h6>
                                          <h6 class="pull-right">Services Charge : Rs.100</h6>
                                      </div>
                                  </div>
                              </div>
                              <div id="tab-3" class="tab-content">
                                  <div class="tab-content-img">
                                      <img src="images/our-serivesc-picup.jpg" alt="our-serivesc-picup" />
                                  </div>
                                  <div class="tab-content-detail">
                                      <span>The World Class</span>

                                      <h2>All Time SPA Guest</h2>
                                        <p style="text-align:justify;">We give a full-service day spa in the calm and comfort of your hotel room. Our licensed spa teams are highly skilled and trained to bring that spa experience to your hotel room. They will banish your stress and tension allowing you to get the rest you need, all in the comfort and convenience of your room.</p>
                                        <p style="text-align:justify;">Gentle touch of health is offering spa services in our hotel main area and we will give a full spa
    whatever your time is, we can help, get a massage treatment suitable to travellers needs.</p>
                                      <div class="tab-content-btm">
                                          <h6 class="pull-left">Services Hours : 19.00 - 22.00</h6>
                                          <h6 class="pull-right">Services Charge : Rs.100</h6>
                                      </div>
                                  </div>
                              </div>
                              <div id="tab-4" class="tab-content">
                                  <div class="tab-content-img">
                                      <img src="images/our-serivesc-bar.jpg" alt="our-serivesc-bar" />
                                  </div>
                                  <div class="tab-content-detail">
                                      <span>The World Class</span>
                                      <h2>Guest Bar & Music</h2>
                                      <p style="text-align:justify;">We also have a bar beside the restaurant. Enjoy a drink in our spacious lounge bar, is a truly enjoyable experience – the views of the natural harbour, no ships just a variety of birds and may be even spot a stray seal or penguin and then across the water with the opposite side comprising of natural terrain, with the names of ships picked out by natural stones will help to ensure that you will have a “relaxing drink”

  There is a full range of bar drinks including a wide selection of spirits, Whisky, Brandy and Liqueurs, soft drinks and  beer including.  The wine list includes a variety and styles of wine including the famous Montes premium wine produced in Chile, with wines by the bottle and glass.

  A selection of teas and coffees are available throughout the day in the Lounge Bar.</p>
                                      <div class="tab-content-btm">
                                          <h6 class="pull-left">Services Hours : 19.00 - 22.00</h6>
                                          <h6 class="pull-right">Services Charge : Rs.100</h6>
                                      </div>
                                  </div>
                              </div>
                              <div id="tab-5" class="tab-content">
                                  <div class="tab-content-img">
                                      <img src="images/our-serivesc-gym.jpg" alt="our-serivesc-gym" />
                                  </div>
                                  <div class="tab-content-detail">
                                      <span>The World Class</span>
                                      <h2>Gym & Fitness Club</h2>
                                      <p style="text-align:justify;">The Gym open 24 hours daily, only adults are allowed to use the gym and persons under 16 years of age must be accompanied by an adult to use the gym. The maximum number of people who lcan be in the gym is 20. Presence in the Fitness area is those limited using to the equipment. People who are not making use of the gym are not allowed in the area. Smoking and drinking  is not allowed in gym except water, we providing towel in gym and user are responsible for there own property and the hotel management are not responsible for any injury or death.</p>
                                      <div class="tab-content-btm">
                                          <h6 class="pull-left">Services Hours : 19.00 - 22.00</h6>
                                          <h6 class="pull-right">Services Charge : Rs.100</h6>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Our Services Close -->

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
                            <li><a href="javascript:;">2/10B Baghajatin Kol-700086</a></li>
                            <li><a href="tel:+91000-000-0000">+91 974-947-1818</a></li>
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
                    <h6 class="pull-left">Copyrights &copy; <?php echo date("Y");?> Group-G</h6>
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

<!-- Sign up Form Close -->
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
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="logo" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse rh-toggle" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right main-navbar">
                        <li>
                            <a class="active" href="index.php">Home</a>

                        </li>
                        <li>
                            <a href="available-rooms.php">Available Rooms</a>
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

    <!-- Slider Begin -->
    <section class="rh-banner">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="images/home/1.jpg" alt="1">
                    <div class="rh rh-banner-widgets">
                        <div class="container">
                            <div class="row">
                                <div class="rh-banner flex">
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                        <h1>Live The Wonderous <span>Life</span></h1>

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <a class="book-now" href="booking.php">BOOK NOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/home/2.jpg" alt="2">
                    <div class="rh rh-banner-widgets">
                        <div class="container">
                            <div class="row flex">
                                <div class="col-lg-9 col-md-9">
                                    <h1>Live The Wonderous <span>Life</span></h1>

                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <a class="book-now" href="booking.php">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/home/3.jpg" alt="3">
                    <div class="rh rh-banner-widgets">
                        <div class="container">
                            <div class="row flex">
                                <div class="col-lg-9 col-md-9">
                                    <h1>Live The Wonderous <span>Life</span></h1>

                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <a class="book-now" href="booking.php">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider Close -->

    <!-- Main Content Begin -->
    <div class="rh">

        <!-- Check Availability Begin -->
        <section class="rh rh-100 check-availability select-list">
            <div class="container">
                <div class="row">
                  <form action="search.php" method="post">
                      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                          <h5>Arrival date</h5>
                          <div class="form-group">
                              <input type="date" name="arrive" value="" class="form-control" placeholder=""  autocomplete="on" required>
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


                      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 rh-m-30">
                          <h5>Category</h5>
                          <select class="browser-default filter-option custom-select" name="category" id="cat_list">
                          <option>select</option>

                          </select>
                      </div>

                      <div class="col-md-8 col-sm-6 col-xs-8 rh-xs-9">
                          <input type="submit" value="Search"class="rh-check-btn pull-right">
                      </div>
                  </form>
                </div>
            </div>
        </section>
        <!-- Check Availability Close -->

        <!-- Featured Rooms Begin -->
        <section class="rh rh-100 rh-featured-rooms">
            <div class="container">
                <div class="row">

                    <!-- Featured Rooms Title -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="rh-section-title">
                            <h2>Featured Rooms</h2>
                            <p style="text-align: justify;">We provide a Deluxe and luxury rooms in your budgets and we also give the
                              facilities of free Wifi , Writing desk, Personal safe, Refrigerator, Air conditioning with individual
                              controls, and Ironing board with iron.For Entertainment purposes we provide the DVD player, 32-inch LCD TV,
                              and Cable and international satellite channels and we give a full hygienic washroom , we give 24hrs room service
                               whenever you need you have to just call in hotel reception. </p>
                        </div>
                    </div>

                    <!-- Featured Rooms Grid Box -->
                    <?php
                    $query = "select * from room where availability='YES' LIMIT 3";
                    $data= mysqli_query($conn,$query);
                    $total=mysqli_num_rows($data);

                    while($row= mysqli_fetch_assoc($data))
                    {
                      $imgpath='Admin/images/room/'.$row['room_image'];
                      $hotel_id=$row['hotel_id'];
                      $city_id=$row['city_id'];

                      $date = date('Y-m-d');
                      $next_date = date('Y-m-d', strtotime($date .' +1 day'));
                     ?>
                                    <!-- Featured Rooms Grid Box -->
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 rh-mf-30">
                                        <div class="rh rh-feature-box">
                                            <div class="rh-img">
                                                <img src="<?php echo $imgpath;?>" alt="feature_1" />
                                                <a href="confirm_book.php?room_id=<?php echo $row['room_id'];?>&check_in=<?php echo $date;?>&check_out=<?php echo $next_date;?>&person=<?php echo $row['number_of_person'];?>&price=<?php echo $row['price'];?>&cid=<?php echo $city_id;?>&hid=<?php echo $hotel_id;?>"></a>
                                            </div>
                                            <?php
                                            $sqlhn = "select * from hotel where hotel_id='$hotel_id'";
                                            $datahn= mysqli_query($conn,$sqlhn);
                                            $rowhn=mysqli_fetch_assoc($datahn);
                                              ?>
                                            <div class="feature-detail">
                                                <h4><a href="#">Room No: <?php echo $row['room_number']; ?></a></h4>
                                                <h4><a href="#"><?php echo $rowhn['hotel_name']; ?></a></h4>
                                                <h4 class="moon"><a href="#" style="color:red">Rs. <?php echo $row['price']; ?></a></h4>
                                                <h4 class="moon"><a href="#">Person : <?php echo $row['number_of_person']; ?></a></h4>

                                                <?php
                                                $sqlcn = "select * from city where city_id='$city_id'";
                                                $datacn= mysqli_query($conn,$sqlcn);
                                                $rowcn=mysqli_fetch_assoc($datacn);
                                                  ?>
                                                <div class="rh">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <p><?php echo $rowcn['city_name'];?></p>
                                                </div>
                                                <div align="right">
                                                  <p>  <a href="confirm_book.php?room_id=<?php echo $row['room_id'];?>&check_in=<?php echo $date;?>&check_out=<?php echo $next_date;?>&person=<?php echo $row['number_of_person'];?>&price=<?php echo $row['price'];?>&cid=<?php echo $city_id;?>&hid=<?php echo $hotel_id;?>"
                                                        class="san">BOOK</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  <?php }?>
                </div>
            </div>
        </section>
        <!-- Featured Rooms Close -->

        <!-- Your stay Begin -->
        <section class="rh rh-100 rh-your-stay">
            <div class="container-fluid">
                <div class="row rh-margin-o">
                    <div class="col-lg-4 col-md-12 half-left">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="rh-left">
                                        <h2>Your Stay</h2>
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
                    </div>
                    <div class="col-lg-8 col-md-12 half-right">
                        <div class="row">
                            <div class="rh rh-right">
                                <div class="col-md-6 col-sm-6 col-xs-12 rh-mf-30">
                                    <div class="stay-box">
                                        <img src="images/your-stay1.jpg" alt="your-stay1" />
                                        <a href="#"></a>
                                        <div class="overley">
                                            <div class="stay-detail">
                                                <h5>Luxury Room</h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="stay-box">
                                        <img src="images/your-stay2.jpg" alt="your-stay2" />
                                        <a href="#"></a>
                                        <div class="overley">
                                            <div class="stay-detail">
                                                <h5>Royal Room</h5>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Your stay Close -->

        <!-- Ournews & Events Begin -->
        <section class="rh rh-100 rh-ournews">
            <div class="container">
                <div class="row">
                    <!-- ournews & Events Title -->
                    <div class="col-lg-12 col-md-12">
                        <div class="rh-section-title">
                            <h2>Our News & Events</h2>
                            <p style="text-align: justify;">Admin can be customized, providing optic monitoring,
                              but tempor and vitality, so that labor and grief, some important issues do not eiusmod.
                              Over the years, I will be able to aliquip out of the nostrud exercise facility out there,
                              so that stimulating effort can make the school district and longevity. cupidatat cillum The pain
                              has been criticized in the film and dolore magna produces no ending pleasure to escape. Excepteur
                               cupidatat Blacks are not excepteur, spirit, that is cool for, they are my toil that they should
                               serve the public blame publicly </p>
                        </div>
                    </div>
                </div>
                <div class="row rh-flex">
                    <!-- ournews & Events Box -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rh-on-12">
                        <div class="rh rh-ournews-box rh-mar-30">
                            <div class="ournews-img">
                                <img src="images/ournews/ournews-1.jpg" alt="ournews-1" />
                                <a href="#"></a>
                            </div>
                            <div class="ournews-detail">
                                <h4><a href="#">luxury hotel in New create palaceluxury hotel in New creat</a></h4>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rh-on-12">
                        <div class="rh rh-ournews-box rh-mar-30">
                            <div class="ournews-img">
                                <img src="images/ournews/ournews-2.jpg" alt="ournews-2" />
                                <a href="#"></a>
                            </div>
                            <div class="ournews-detail">
                                <h4><a href="#">French fury over doing up the Ritz</a></h4>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rh-on-12">
                        <div class="rh rh-ournews-box rh-mar-30">
                            <div class="ournews-img">
                                <img src="images/ournews/ournews-3.jpg" alt="ournews-3" />
                                <a href="#"></a>
                            </div>
                            <div class="ournews-detail">
                                <h4><a href="#">French fury over doing up the Ritz</a></h4>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rh-on-12">
                        <div class="rh rh-ournews-box rh-mar-30">
                            <div class="ournews-img">
                                <img src="images/ournews/ournews-4.jpg" alt="ournews-4" />
                                <a href="#"></a>
                            </div>
                            <div class="ournews-detail">
                                <h4><a href="#">China Luxury Star Hotel President Bedroom</a></h4>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Ournews & Events Close -->

        <!-- Our Services Begin -->
        <!-- Our Services Begin -->
    <section class="rh rh-100 rh-our-services">
        <div class="container">
            <div class="row">

                <!-- Our Services Title -->
                <div class="col-lg-12 col-md-12">
                    <div class="rh-section-title">
                        <h2>Our Services</h2>
                        <p style="text-align: justify;">Since 2019 our hotel was established, We provied best
                          hotel in our locality, We provide deluxe and luxury  room with clean and best mattress, we have
                          a clean our hotel and providing 24hrs service. In our Hotel we guarantee check-in time from
                          3.00 p.m and Check-out from the room is at 12.00 p.m. but if the room is ready upon your arrival,
                          you are welcome to check-in before. If, on the other hand, the room is not ready when you arrive,
                          you can store your luggage with us at no charge until the room is available.
                        </p>
                </div>

                <!-- Our Services Title -->
                <div class="col-lg-12 col-md-12">
                    <div id="tabs-container" class="rh rh-tab-section">
                        <ul class="tabs-menu">
                            <li class="current"><a href="#tab-1"><i class="fa fa-cutlery" aria-hidden="true"></i><h5>Restaurant</h5></a></li>
                            <li><a href="#tab-3"><i class="fa fa-car" aria-hidden="true"></i><h5>Pic-up</h5></a></li>
                            <li><a href="#tab-4"><i class="fa fa-glass" aria-hidden="true"></i><h5>Bar</h5></a></li>
                            <li><a href="#tab-5"><i class="fa fa-child" aria-hidden="true"></i><h5>Gym</h5></a></li>

                        </ul>
                        <div class="tab">
                            <div id="tab-1" class="tab-content">
                                <div class="tab-content-img">
                                    <img src="images/our-serivesc-restorant.jpg" alt="our-serivesc-restorant" />
                                </div>
                                <div class="tab-content-detail">
                                    <span>The World Class</span>
                                    <h2>Restaurant & Banquets</h2>
                                    <p style="text-align:justify;">We have our own restaurant in ground floor, in our restaurant
                                      we provide all types of Indian dishes and continental dishes we are providing 24hrs food
                                      services for our guest . Make the best of your stay and enjoy relishing treats from our all-day
                                      diner. You’ll find its casual ambience and flavours spot-on. However we provide 24hrs food
                                      services but we have also a timing for breakfast , lunch and dinner.

                     Buffet Breakfast:  6.30 am to 10.30 am
                     Lunch: 12.30 pm to 3.30 pm
                     Dinner: 7 pm to 12.45 am.

                    For table reservations, please call +91 98098765809</p>
                                    <div class="tab-content-btm">
                                        <h6 class="pull-left">Services Hours : 19.00 - 22.00</h6>
                                        <h6 class="pull-right">Services Charge : Rs.100</h6>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-3" class="tab-content">
                                <div class="tab-content-img">
                                    <img src="images/our-serivesc-picup.jpg" alt="our-serivesc-picup" />
                                </div>
                                <div class="tab-content-detail">
                                    <span>The World Class</span>

                                    <h2>All Time SPA Guest</h2>
                                      <p style="text-align:justify;">We give a full-service day spa in the calm and comfort of your hotel room. Our licensed spa teams are highly skilled and trained to bring that spa experience to your hotel room. They will banish your stress and tension allowing you to get the rest you need, all in the comfort and convenience of your room.</p>
                                      <p style="text-align:justify;">Gentle touch of health is offering spa services in our hotel main area and we will give a full spa
  whatever your time is, we can help, get a massage treatment suitable to travellers needs.</p>
                                    <div class="tab-content-btm">
                                        <h6 class="pull-left">Services Hours : 19.00 - 22.00</h6>
                                        <h6 class="pull-right">Services Charge : Rs.100</h6>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-4" class="tab-content">
                                <div class="tab-content-img">
                                    <img src="images/our-serivesc-bar.jpg" alt="our-serivesc-bar" />
                                </div>
                                <div class="tab-content-detail">
                                    <span>The World Class</span>
                                    <h2>Guest Bar & Music</h2>
                                    <p style="text-align:justify;">We also have a bar beside the restaurant. Enjoy a drink in our spacious lounge bar, is a truly enjoyable experience – the views of the natural harbour, no ships just a variety of birds and may be even spot a stray seal or penguin and then across the water with the opposite side comprising of natural terrain, with the names of ships picked out by natural stones will help to ensure that you will have a “relaxing drink”

There is a full range of bar drinks including a wide selection of spirits, Whisky, Brandy and Liqueurs, soft drinks and  beer including.  The wine list includes a variety and styles of wine including the famous Montes premium wine produced in Chile, with wines by the bottle and glass.

A selection of teas and coffees are available throughout the day in the Lounge Bar.</p>
                                    <div class="tab-content-btm">
                                        <h6 class="pull-left">Services Hours : 19.00 - 22.00</h6>
                                        <h6 class="pull-right">Services Charge : Rs.100</h6>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-5" class="tab-content">
                                <div class="tab-content-img">
                                    <img src="images/our-serivesc-gym.jpg" alt="our-serivesc-gym" />
                                </div>
                                <div class="tab-content-detail">
                                    <span>The World Class</span>
                                    <h2>Gym & Fitness Club</h2>
                                    <p style="text-align:justify;">The Gym open 24 hours daily, only adults are allowed to use the gym and persons under 16 years of age must be accompanied by an adult to use the gym. The maximum number of people who lcan be in the gym is 20. Presence in the Fitness area is those limited using to the equipment. People who are not making use of the gym are not allowed in the area. Smoking and drinking  is not allowed in gym except water, we providing towel in gym and user are responsible for there own property and the hotel management are not responsible for any injury or death.</p>
                                    <div class="tab-content-btm">
                                        <h6 class="pull-left">Services Hours : 19.00 - 22.00</h6>
                                        <h6 class="pull-right">Services Charge : Rs.100</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Services Close -->

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
                                <li><a href="javascript:;">2/10B Baghajatin Kol-700086</a></li>
                                <li><a href="tel:+91000-000-0000">+91 974-947-1818</a></li>
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
                        <h6 class="pull-left">Copyrights &copy;<?php echo date("Y");?> Group-G</h6>
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
  <?php } ?>

    <script type= "text/javascript">
    function getValue(val) {
      //alert(val);
    $.ajax({
        type: "POST",
  		  url: "getValue.php",
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

      <script type= "text/javascript">
      function getValue1(val) {

      $.ajax({
          type: "POST",
    		  url: "getValue1.php",
          data:'hotel_id='+val,
    			success: function (data) {

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
