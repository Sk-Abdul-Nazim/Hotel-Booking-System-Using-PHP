<?php
include('../db_connection.php');
 if(!isset($_SESSION["loggedin1"])){
      header("location:../Admin_login.php");
      exit;
  }
error_reporting(0);
    $query = "select * from city where isActive=1 ORDER BY city_name";
    $data= mysqli_query($conn,$query);
    $total= mysqli_num_rows($data);
    if($total!=0)
    {
      ?>
      <html>
      <head>
        <title>City</title>
          <link rel = "icon" type = "image/png" href = "ico/city.png">
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
      <table>
        <tr>
          <th> # </th>
          <th> City Name </th>
          <th> Action </th>

        </tr>
    <?php
       $x=1;
        while ($row= mysqli_fetch_assoc($data))
        {
      ?>

      <tr><td><?php echo $x; ?></td>
          <td><?php echo $row['city_name'] ?></td>
          <td><a style="text-decoration:none" href="edit_city.php?id=<?php echo $row['city_id'] ?>">Edit </a> |
            <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['city_id'] ?>')">Delete</a>

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

    <?php
     $conn->close();

?>
<br>
<a href="add_city.php" class="link">Add City</a>
<a href="admin_index.php" class="link">Back</a>
</body>
</html>

<script>
function chk(val){
 var result =confirm("Are u want to delete ?");
 if(result){
   location.href="delete_city.php?id="+val;
 }

}
</script>
