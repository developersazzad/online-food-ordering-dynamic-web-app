<?php
include('connection.php');
include('function.php');
$status=$_POST["status"];
 //========Add cookie=========//
   $user_id=$_SESSION['USER_ID'];
   $user_email=$_SESSION['USER_EMAIL'];
  //========Add cookie=========//
  setcookie('USR_ID',$user_id,time()+(3600*4));
  setcookie('USR_EMAIL',$user_email,time()+(3600*4));
  setcookie('TYPE',$status,time()+(3600*4));
 //========Add cookie=========//
 ?>
