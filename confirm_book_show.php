<?php
include('db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin2"])){
		 header("location:login.php");
		 exit;
 }
 $room_id=$_REQUEST['id'];
 $query = "select * from reservation where isActive=1 and room_id='$room_id'";
 $data= mysqli_query($conn,$query);
 $row= mysqli_fetch_assoc($data);

     $sqlu="select * from registration where r_id='".$row['r_id']."'";
     $datau= mysqli_query($conn,$sqlu);
     $rowu= mysqli_fetch_assoc($datau);

     $sqlc="select * from city where city_id='".$row['city_id']."'";
     $datac= mysqli_query($conn,$sqlc);
     $rowc= mysqli_fetch_assoc($datac);

     $sqlh="select * from hotel where hotel_id='".$row['hotel_id']."'";
     $datah= mysqli_query($conn,$sqlh);
     $rowh= mysqli_fetch_assoc($datah);


     $sqlr="select * from room where room_id='".$row['room_id']."'";
     $datar= mysqli_query($conn,$sqlr);
     $rowr= mysqli_fetch_assoc($datar);

     $imgpath='Admin/images/room/'.$rowr['room_image'];
 ?>


 <!DOCTYPE html>
 <html>

 <head>
     <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
		 <style>
		 .b{
		 padding: 2cm 2cm 2cm 2cm !important;
		 background-color: #FFDEAD;
	 }
	 </style>
     <style>
             .ghf {
                 background-color: white;
                 border: 1px solid black;
                 color: black;
                 padding: 2px 10px;
                 text-align: center;
                 display: inline-block;
                 font-size: 15px;
                 margin: 5px 20px;
                 cursor: pointer;
                 text-decoration:none;

                 padding-top: 10px;
                 padding-right: 10px;
                  padding-bottom:10px;
                 padding-left: 10px;
             }

     </style>
 </head>

 <body class="b">
	 	<div id="printableArea"> <!-- Start printableArea -->
     <div align="center">
         <table width="600" border="1" bordercolor="99CCFF">
             <tbody>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="center">
                             <p class="style3">Reservation confirmation Details</p>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF"><img src="<?php echo $imgpath;?>" alt="Room" width="600" height="188">
                            </td>
                             <!-- longdesc="https://qt7hhq.dm1.livefilestore.com/y2pDJs-GHos35inDJBFRa9oltST_jn-fVpZMBewP-Qp5StrXMkOZVuIxKMCfB_6rnHAD0rdd0dzIdjfbYOelVEdQYZWVkoudm0teMf24Cb7UE4/Navajo%20header%20new.jpg?psid=1" -->
                 </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><strong>Dear Mr. <?php echo $rowu['first_name'] ?> </strong><br>
                             <br> Thank you for choosing The Hotel. We are delighted to confirm the following reservation. Should you require further assistance, please contact our Reservations department via return e-mail or by calling the number listed
                             below.<br>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="#FFC977">
                         <div align="left"><strong>Reservation Details:</strong></div>
                     </td>

                 </tr>
                 <tr>
                     <td width="121" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Guest Name</span></div>
                     </td>
                     <td width="473" colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowu['first_name']; ?>  <?php echo $rowu['last_name']; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Confirmation No</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['resr_id']; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">City Name</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowc['city_name'];?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Hotel Name</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowh['hotel_name'] ;?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Room Number</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowr['room_number'] ;?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Room Type</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $rowr['category_name'] ;?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Arrival Date</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['check_in_date']; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Departure Date</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['check_out_date']; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Payment Method</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">Cash On Delivery&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Adult / Child</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['number_of_person']; ?>&nbsp;</td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Room Rate</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF"><?php echo $row['price']; ?>&nbsp;</td>
                 </tr>

                 <tr>
                     <td colspan="5" bordercolor="99CCFF" bgcolor="#FFC977">
                         <div align="left"><strong>Hotel Policy:</strong></div>
                     </td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left" class="style4">Hotel Check-in</div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5">14:00 </span></div>
                     </td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left" class="style4">Hotel Check-out</div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5">12:00 Noon</span></div>
                     </td>
                 </tr>
                 <tr>
                     <td bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style4">Cancellation Policy</span></div>
                     </td>
                     <td colspan="4" bordercolor="99CCFF" bgcolor="99CCFF">
                         <div align="left"><span class="style5">Guaranteed reservations cancelled within 48 hours of arrival will be subject to a one night charge </span></div>
                     </td>
                 </tr>
             </tbody>
         </table>
     </div>
	 </div><!-- printable area close-->
<div style="text-align:center">
  <a href="index.php"class="ghf">OK</a>
<a href="javascript:void(0)" onclick="printDiv('printableArea')" class="ghf">Print<a>
</div>

<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</body>

 </html>
