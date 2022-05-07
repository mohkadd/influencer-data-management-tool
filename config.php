<?php
 $connect = mysqli_connect("localhost","root","","inhouse");

// Check connection
if (!$connect)
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
?>