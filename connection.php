<?php
$con=mysqli_connect('localhost','root','','online_food');
session_start();
if($con==false){
  echo "connection error.!";
}
?>
