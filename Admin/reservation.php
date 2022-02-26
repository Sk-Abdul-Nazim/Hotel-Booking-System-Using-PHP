<?php
include('../db_connection.php');
//echo "here";
 //echo $_POST['catname'];
 //exit;
 if(!isset($_SESSION["loggedin1"])){
      header("location:../Admin_login.php");
      exit;
  }
error_reporting(0);
    $query = "select * from reservation where isActive=1";
    $data= mysqli_query($conn,$query);
    $total= mysqli_num_rows($data);
    if($total!=0)
    {
      ?>
      <html>
      <head>
        <title>Reservation</title>
          <link rel = "icon" type = "image/png" href = "ico/room1.png">
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
        <style>
           table, th, td {
              border: 1px solid black;
              margin-right:auto;
              margin-left:auto;
            }
            th, td {
                  padding: 10px;
             }

        </style>
      </head>
      <body style="padding-top: 50px; text-align:center">
      <table id="tblCustomers" cellspacing="0" cellpadding="0">
        <tr>
          <th> # </th>
            <th>  User Name </th>
              <!-- <th>  User Last Name </th> -->
              <th>  User Email ID </th>
              <th>  User Phone No. </th>
              <th>  User Address </th>
          <th> City Name </th>
          <th> Hotel Name </th>
          <th> Room Number </th>

          <th> Check In Date </th>
          <th> Check Out Date </th>
          <th>  Person </th>
          <th>  Price </th>
          <th>  Book Date </th>
          <th>  Book Time </th>
          <th>  Action </th>

        </tr>
    <?php
       $x=1;
        while ($row= mysqli_fetch_assoc($data))
        {

          $check_out= $row['check_out_date'];
          $dateTimestamp2 = strtotime($check_out);
          $check_out_date1 = date('Y-m-d',$dateTimestamp2);

          $get_date=date("d-m-Y");
          $time = strtotime($get_date);
          $current_date = date('Y-m-d',$time);
               if($check_out_date1<$current_date){


               $sqlout="update reservation set isActive=0 where resr_id='".$row['resr_id']."'";

               if(mysqli_query($conn,$sqlout))
               {
                 $sqlrr="update room set availability='YES' where room_id= '".$row['room_id']."'";
                 $datarr= mysqli_query($conn,$sqlrr);
                 echo '<script type="text/javascript">';
                 echo 'alert("all back date from now is deleted");';
                 echo 'window.location.href = "reservation.php";';
                 echo '</script>';

               }
             }

             else{




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


      ?>

      <tr><td><?php echo $x; ?></td>

        <td><?php echo $rowu['first_name'] ?>  <?php echo $rowu['last_name'] ?></td>

        <td><?php echo $rowu['email'] ?></td>
        <td><?php echo $rowu['phone'] ?></td>
        <td><?php echo $rowu['address'] ?></td>

          <td><?php echo $rowc['city_name'] ?></td>
          <td><?php echo $rowh['hotel_name'] ?></td>
          <td><?php echo $rowr['room_number'] ?></td>

          <td><?php echo $row['check_in_date'] ?></td>
          <td><?php echo $row['check_out_date'] ?></td>
          <td><?php echo $row['number_of_person'] ?></td>
              <td><?php echo $row['price'] ?></td>
              <td><?php echo $row['booked_date'] ?></td>
              <td><?php echo $row['booked_time'] ?></td>


          <!-- <td><a style="text-decoration:none" href="edit_room.php?id=<?php //echo $row['resr_id'] ?>">Edit </a> |
            <!--<a style="text-decoration:none" href="delete_category.php?id=<?php //echo $row['cat_id'] ?>">Delete</a>-->
            <!--<a style="text-decoration:none" href="delete_category.php?id=<?php //echo $row['cat_id'] ?>" onclick='return confirm("R u want to delete.");'>Delete</a>-->
            <!--<a style="text-decoration:none" href="delete_category.php?id=<?php //echo $row['cat_id'] ?>">Delete</a>-->

          <!--  <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php //echo $row['resr_id'] ?>')">Delete</a> -->
          <td><a style="text-decoration:none" href="delete_reservation.php?id=<?php echo $row['resr_id'] ?>">Clean</a></td>

      </tr>
      <?php
      $x++;
    }//end else of my
    }
    }
    else{
      echo "no records";
      }
     ?>

    </table>

    <?php
     $conn->close();

?>
<br>

<a href="admin_index.php" class="ghf">Back</a>
<button id="btnExport" class="ghf">Export to Excel</button>

<!-- <a href="javascript:void(0)" onclick="printDiv('printableArea')" class="ghf">Print<a> -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

  <!-- <script>
  function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;

       window.print();

       document.body.innerHTML = originalContents;
  }
  </script> -->

  <script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#tblCustomers").table2excel({
                filename: "Reservation Table.xls"
            });
        });
    });
</script>
</body>
</html>
