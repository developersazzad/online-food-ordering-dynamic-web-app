<?php
include('connection.php');
include('function.php');
$rand_id=$_SESSION['rand_user_base_id'];
$user_id=$_SESSION['USER_ID'];
$data=order_detels_core($user_id);
 ?>
