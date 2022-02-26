<?php
include('../db_connection.php');

 if(!isset($_SESSION["loggedin1"])){
      header("location:../Admin_login.php");
      exit;
  }
error_reporting(0);
    $query = "select * from registration where isActive=1";
    $data= mysqli_query($conn,$query);
    $total= mysqli_num_rows($data);
    if($total!=0)
    {
      ?>
      <html>
      <head>
        <title>User Details</title>
    <link rel = "icon" type = "image/png" href = "ico/user.png">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
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
                  padding: 8px;
             }

        </style>
      </head>
      <body style="padding-top: 50px; text-align:center">
      <table>
        <tr>
          <th> # </th>
          <th> First Name </th>
          <th> Last Name </th>
          <th> Email ID</th>
          <th> Phone No </th>
          <th> Address </th>
          <th> Password </th>
          <th> Action </th>

        </tr>
    <?php
       $x=1;
        while ($row= mysqli_fetch_assoc($data))
        {
      ?>

      <tr><td><?php echo $x; ?></td>
          <td><?php echo $row['first_name'] ?></td>
          <td><?php echo $row['last_name'] ?></td>
          <td><?php echo $row['email'] ?></td>
          <td><?php echo $row['phone'] ?></td>
          <td><?php echo $row['address'] ?></td>
          <td><?php echo $row['password'] ?></td>

          <td><a style="text-decoration:none" href="edit_userDetails.php?id=<?php echo $row['r_id'] ?>">Edit</a> |
          <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['r_id'] ?>')">Delete</a>

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
       <br>
     <a href="admin_index.php" class="link">Back</a>
    </body>
    </html>
    <?php
     $conn->close();

?>

<script>
function chk(val){
 var result =confirm("Are u want to delete ?");
 if(result){
   location.href="delete_userDetails.php?id="+val;
 }

}
</script>
