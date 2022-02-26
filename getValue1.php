<?php
include('db_connection.php');
$query ="SELECT * FROM room WHERE hotel_id ='".$_POST["hotel_id"]."'";
    $result = mysqli_query($conn, $query);
?>
<!-- <h5>Hotel</h5> -->
<option>select</option>
<?php
$result2 = mysqli_query($conn, $query);
    while($row22=mysqli_fetch_assoc($result2)){

  ?>
            <option value="<?php echo $row22['room_id']; ?>"><?php echo $row22['category_name']; ?>  </option>
 <?php
}?>
