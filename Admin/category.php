<?php
include('../db_connection.php');

 if(!isset($_SESSION["loggedin1"])){
      header("location:../Admin_login.php");
      exit;
  }
error_reporting(0);
    $query = "select * from category where isActive=1 ORDER BY category_name";
    $data= mysqli_query($conn,$query);
    $total= mysqli_num_rows($data);
    if($total!=0)
    {
      ?>
      <html>
      <head>
        <title>Category</title>
          <link rel = "icon" type = "image/png" href = "ico/category.png">
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
          <th> Category Name </th>
          <th> Action </th>

        </tr>
    <?php
       $x=1;
        while ($row= mysqli_fetch_assoc($data))
        {
      ?>

      <tr><td><?php echo $x; ?></td>
          <td><?php echo $row['category_name'] ?></td>
          <td><a style="text-decoration:none" href="edit_category.php?id=<?php echo $row['cat_id'] ?>">Edit </a> |
            <a style="text-decoration:none" href="javascript:void(0);" onclick="chk('<?php echo $row['cat_id'] ?>')">Delete</a>

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
 <button><a style="text-decoration:none" href=add_category.php>Add Category</a></button>
<button><a href="admin_index.php" style="text-decoration:none">Back</a></button>
</body>
</html>

<script>
function chk(val){
 var result =confirm("Are u want to delete ?");
 if(result){
   location.href="delete_category.php?id="+val;
 }

}
</script>
