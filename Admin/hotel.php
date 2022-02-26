<?php
include('../db_connection.php');

 if(!isset($_SESSION["loggedin1"])){
      header("location:../Admin_login.php");
      exit;
  }
error_reporting(0);
    $query = "select * from hotel where isActive=1  ORDER BY hotel_name";
    $data= mysqli_query($conn,$query);
    $total= mysqli_num_rows($data);

    if($total!=0)
    {
      ?>
      <html>
      <head>
        <title>Hotel</title>
            <link rel = "icon" type = "image/png" href = "ico/hotel.png">
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
         <input type="text" id="search" placeholder="Search by hotel name" />
         <br><br>
          <div id="display">
      <table>
        <tr>
          <th> # </th>
          <th> hotel Name </th>
          <th> City Name </th>
          <th> Image </th>
          <th> Action </th>

        </tr>
    <?php
       $x=1;
        while ($row= mysqli_fetch_assoc($data))
        {
          $sql2="select * from city where city_id='".$row['city_id']."'";
               $data2= mysqli_query($conn,$sql2);
               $row2= mysqli_fetch_assoc($data2);
      ?>

      <tr><td><?php echo $x; ?></td>
          <td><?php echo $row['hotel_name'] ?></td>
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
    }
    else{
      echo "no records";
      }
     ?>

    </table>
  </div>

    <?php
     $conn->close();

?>
<br>
 <a href="add_hotel.php" class="link">Add Hotel</a>
<a href="admin_index.php" class="link">Back</a>


<script>
function chk(val){
 var result =confirm("Are u want to delete ?");
 if(result){
   location.href="delete_hotel.php?id="+val;
 }

}
</script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script>
//Getting value from "ajax.php".
function fill(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#search').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display').hide();
}
$(document).ready(function() {
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
   $("#search").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#search').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display").html("");
       }
       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "ajax_search_hotel.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   search: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "search.php" file.
                   $("#display").html(html).show();
               }
           });
       }
   });
});
</script>


</body>
</html>
