<?php
include('../db_connection.php');
error_reporting(0);

if(isset($_POST["query"]))
 {
      $output = '';
      $query = "SELECT * FROM hotel WHERE hotel_name LIKE '%".$_POST["query"]."%'";
      $result = mysqli_query($conn, $query);
      $output = '<ul class="list-unstyled">';
      if(mysqli_num_rows($result) > 0)
      {
           while($row = mysqli_fetch_array($result))
           {
                $output .= '<li>'.$row["hotel_name"].'</li>';
           }
      }
      else
      {
           $output .= '<li>Hotel Not Found</li>';
      }
      $output .= '</ul>';
      echo $output;
 }
 ?>
