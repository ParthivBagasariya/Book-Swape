<?php
  $hostname = "159.69.6.244";
  $username = "user_2436";
  $password = "kCndLh0NEorGGGmeskGxrkAFt6mTWg0dOurfJjSGojY";
  $dbname = "site_2436";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
