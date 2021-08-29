<?php
include("connection.php");
include('function.php');
$name=get_safe_value($_REQUEST['name']);
$email=get_safe_value($_REQUEST['email']);
$subject=get_safe_value($_REQUEST['subject']);
$mobile=get_safe_value($_REQUEST['mobile']);
$messages=get_safe_value($_REQUEST['message']);
$date=date('Y-m-d h:i:s');
$insert_sql=mysqli_query($con,"INSERT INTO `contect_us`( `name`, `mobile`, `email`, `subject`, `message`, `date`) VALUES ('$name','$mobile','$email','$subject','$messages','$date')");
echo "Thank you for your kind information.";
 ?>
