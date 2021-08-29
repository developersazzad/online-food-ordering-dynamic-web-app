<?php
session_start();
include('function.php');
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['USER_EMAIL']);
redirect('shop.php');
 ?>
