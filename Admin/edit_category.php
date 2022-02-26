<?php
include('../db_connection.php');
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
$id = $_REQUEST['id'];
$query="select * from category where cat_id=$id";
$data= mysqli_query($conn,$query);
while ($row= mysqli_fetch_assoc($data))
{
 ?>
 <html>
 <head>
<title>Edit Category</title>
<link rel = "icon" type = "image/png" href = "ico/category.png">
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
 <body>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
       <tr>
         <input type="hidden" name="eid" value="<?php echo $row['cat_id']?>">
          <td>Category Name</td><td>:</td>
          <td><input type="text" name="catname" placeholder="Enter Category Name" value="<?php echo $row['category_name']?>" onfocus="this.select()" autofocus></td>
       </tr>
       <tr>
         <td><a href="category.php" class="link">Back</a></td>
          <td><input type="submit" name="editcat" value="Submit"></td>

       </tr>
    </table>
 </form>
 </body>
 </html>
<?php }
if(isset($_POST['editcat']))
{
  $eid = $_POST['eid'];
   $catname = $_POST['catname'];
   $sql = "update `category` set category_name='$catname' where cat_id='$eid'";
   if(mysqli_query($conn, $sql)){
       echo "Records update successfully.";
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
  header('location:category.php');
}

 ?>
