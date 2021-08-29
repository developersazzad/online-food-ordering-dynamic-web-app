<?php
include('connection.php');
include('function.php');
 //========Add cookie=========//
   $user_id=$_SESSION['USER_ID'];
   $user_email=$_SESSION['USER_EMAIL'];
  //========Add cookie=========//
  setcookie('user_id',$user_id,time()+(3600));
  setcookie('user_email',$user_email,time()+(3600));
  setcookie('add_wallat',"order_now",time()+(3600));
  redirect("transection_history.php");
 //========Add cookie=========//
 ?>
