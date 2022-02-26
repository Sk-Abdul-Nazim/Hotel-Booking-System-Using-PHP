<?php
include('../db_connection.php');

 if(!isset($_SESSION["loggedin1"])){
      header("location:../Admin_login.php");
      exit;
  }
error_reporting(0);
    $query = "select * from room where availability='NO' and isActive=1 ORDER BY room_number";
    $data= mysqli_query($conn,$query);
    $total= mysqli_num_rows($data);
    if($total!=0)
    {
      ?>
      <html>
      <head>
        <title>Reserved Room</title>
          <link rel = "icon" type = "image/png" href = "ico/room1.png">
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
        <style>
                .link {
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
                }

        </style>
      </head>
      <body style="padding-top: 50px; text-align:center">
      <table>
        <tr>
          <th> # </th>
          <th> City Name </th>
          <th> Hotel Name </th>
          <th> Category Name </th>
          <th> Room Number </th>
          <th> Number Of Person </th>
          <th> Price </th>
          <th> Availability </th>
          <th> Image </th>
          <th> Clean </th>

        </tr>
    <?php
       $x=1;
        while ($row= mysqli_fetch_assoc($data))
        {
          $sql2="select * from city where city_id='".$row['city_id']."'";
            $data2= mysqli_query($conn,$sql2);
            $row2= mysqli_fetch_assoc($data2);
            $sql3="select * from hotel where hotel_id='".$row['hotel_id']."'";
              $data3= mysqli_query($conn,$sql3);
              $row3= mysqli_fetch_assoc($data3);
      ?>

      <tr><td><?php echo $x; ?></td>
        <td><?php echo $row2['city_name'] ?></td>
        <td><?php echo $row3['hotel_name'] ?></td>
        <td><?php echo $row['category_name'] ?></td>
          <td><?php echo $row['room_number'] ?></td>
          <td><?php echo $row['number_of_person'] ?></td>
          <td><?php echo $row['price'] ?></td>

          <td><?php echo $row['availability'] ?></td>
          <?php $imgpath='images/room/'.$row['room_image'];?>
         <td><img src="<?php echo $imgpath;?>" alt="HTML5 Icon" style="width:128px;height:128px"></td>

         <td><a style="text-decoration:none" href="clean_room.php?id=<?php echo $row['room_id'] ?>">Clean </a></td>
      </tr>
      <?php
      $x++;
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
<a href="if_availibility_room.php" class="link">Back</a>

</script>
</body>
</html>
