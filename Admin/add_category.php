<?php
include('../db_connection.php');
error_reporting(0);
if(!isset($_SESSION["loggedin1"])){
     header("location:../Admin_login.php");
     exit;
 }
if(isset($_POST['addcat']))
{
   $catname = $_POST['catname'];
   $sql = "INSERT INTO `category` (category_name,isActive) VALUES ('$catname',1)";
   if(mysqli_query($conn, $sql)){
       echo "Records inserted successfully.";
   } else{
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   $conn->close();
   header('location:category.php');
}
?>

<html>
<head>
<title>Add Category</title>
<link rel = "icon" type = "image/png" href = "ico/category.png">
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > <!--id="frm"-->
   <table>
      <tr>
         <td>Category Name</td><td>:</td>
             <td><input type="text" autocomplete="off"  name="catname" placeholder="Enter Category Name" autofocus></td>
      </tr>
   </table>
</script>
<br>
<button><a href="category.php" style="text-decoration:none">Back</a></button>
<input type="submit" value="Submit" name="addcat">
</form>
</body>
</html>
