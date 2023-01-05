<?php

$con = mysqli_connect("localhost:3300","root","","iaisponsorship");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>