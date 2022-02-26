<?php
include('db_connection.php');
$query ="SELECT * FROM hotel WHERE city_id ='".$_POST["city_id"]."'";

  $result = mysqli_query($conn, $query);
?>
<option>select</option>
<?php
$result2 = mysqli_query($conn, $query);
    while($row22=mysqli_fetch_assoc($result2)){

  ?>
            <option value="<?php echo $row22['hotel_id']; ?>"><?php echo $row22['hotel_name']; ?>  </option>
 <?php
}?>
