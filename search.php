<?php
include('db_connection.php');
error_reporting(0);

$check_in = $_POST['arrive'];
$check_out = $_POST['depature'];
 $room_id = $_POST['category'];

$cid = $_POST['city'];  // Storing Selected Value In Variable
  if(empty($cid))
  {
      echo "You didn't select any City";
      echo "<br>";

  }

    $hid = $_POST['hotel'];  // Storing Selected Value In Variable
      if(empty($hid))
      {
          echo "You didn't select any Hotel";
          echo "<br>";

      }
//  Join query used in searching ha ha ha
$query = "select * from room where availability='YES' and (hotel_id='".$hid."' or room_id='".$room_id."') ";
$data= mysqli_query($conn,$query);
$total= mysqli_num_rows($data);
if($total!=0)
{
	$_SESSION['loggedin_search'] = "You Have To Login Before Room Book";
  ?>
  <html>
  <head>
    <title>Search</title>
        <link rel = "icon" type = "image/png" href = "Admin/ico/hotel.png">
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
  </head>
  <body style="text-align:center">

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
                                      <button><a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></button>
																				<button class="sort-by-grid"><i class="fa fa-th" aria-hidden="true"></i></button>
																				<button class="sort-by-list current"><i class="fa fa-th-list" aria-hidden="true"></i></button>
																		</div>
																</div>

<?php

     while ($row= mysqli_fetch_assoc($data))
     {
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
										<a href="confirm_book.php"></a>
								</div>

							 <div class="feature-detail">
										<h4><a href="confirm_book.php"><p>Room no: <?php echo $room_number;?></p><p><?php echo $rowhh['hotel_name']; ?></p></a></h4>
										<div class="rating-star">

									 </div>
									 <div class="rh">
												<p class="rh-top">Dolor adipisicing sunt laborum ut anim fugiat proident in culpa sint et eu. Dolore consectetur labore in magna ut laborum occaecat consequat dolor magna minim eiusmod dolor. Ut elit labore sed velit ex fugiat esse sit.</p>
												<ul>
                          <li>

															<p style="font-weight: bold;"><?php echo $row['category_name']; ?> Room</p>
													</li>
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
															<p><a href="#" class="spm">View Details</a>
															<a href="javascript:void(0)" class="san" onclick="chk('<?php echo $room_number;?>')">BOOK</a></p>
														</li>

												</ul>
									 </div>
							 </div>
					 </div>
				</div>
</div>
</div>
<form id="myForm_<?php echo $room_number;?>" method="post" action="confirm_book.php">
<input type="hidden" value="<?php echo $check_in;?>" name="check_in">
<input type="hidden" value="<?php echo $check_out;?>" name="check_out">
<input type="hidden" value="<?php echo $person;?>"name="person">
<input type="hidden" value="<?php echo $price;?>"name="price">
<input type="hidden" value="<?php echo $cid;?>"name="cid">
<input type="hidden" value="<?php echo $hid;?>"name="hid">
<input type="hidden" value="<?php echo $room_id;?>"name="room_id">
</form>
<?php
}
?>
<br>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- About Royal Hotel Close -->
</div>
<?php
}
else{
  echo "<h3>No Rooms Found, please try another Hotel...</h3>";
?>
<a href="index.php">Back</a>
<?php
  }
 ?>

</table>

<?php
 $conn->close();


 ?>
<script>
function chk(val){
  document.getElementById("myForm_"+val).submit();
}
</script>
