<?php
//Including Database configuration file.
include ('../db_connection.php');
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
   $Name = $_POST['search'];

?>

<html>
<head>
  <title>Hotel</title>
      <link rel = "icon" type = "image/png" href = "ico/hotel.png">
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

<table>
  <tr>
    <th> # </th>
    <th> hotel Name </th>
    <th> City Name </th>
    <th> Image </th>
    <th> Action </th>

  </tr>

<?php
//Search query.
   $Query = "SELECT * FROM hotel WHERE isActive=1 and (hotel_name='$Name'or hotel_name='$Name% %$Name' or hotel_name LIKE '%$Name%' or hotel_name like '$Name%' or hotel_name like '%$Name') LIMIT 5";
//Query execution
   $data = mysqli_query($conn,$Query);
   if($data){
//Creating unordered list to display result.
   //Fetching result from database.
            $x=1;
             while ($row= mysqli_fetch_assoc($data))
             {
               $sql2="select * from city where city_id='".$row['city_id']."'";
                    $data2= mysqli_query($conn,$sql2);
                    $row2= mysqli_fetch_assoc($data2);
           ?>

           <tr><td><?php echo $x; ?></td>
             <td onclick='fill("<?php echo $row['hotel_name']; ?>")'>
               <?php echo $row['hotel_name'] ?></td>
             <td><?php echo $row2['city_name'] ?></td>

               <?php $imgpath='images/hotel/'.$row['hotel_image'];?>
                <td><img src="<?php echo $imgpath;?>" style="width:128px;height:128px"></td>
               <td><a style="text-decoration:none" href="edit_hotel.php?id=<?php echo $row['hotel_id'] ?>">Edit </a> |
                 <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['hotel_id'] ?>')">Delete</a>

               </td>
           </tr>
           <?php
           $x++;
         }

          ?>

         </table>


         <?php
          $conn->close();

       ?>


   <?php

}//inner if end
   else {
        echo "Hotel Not Found";
      header('location:hotel.php');
     }
}//outer if end of isset($_POST['search']) close
else {
        echo "404 server error";
}

?>
<script>
function chk(val){
 var result =confirm("Are u want to delete ?");
 if(result){
   location.href="delete_hotel.php?id="+val;
 }
}
</script>
</body></html>
