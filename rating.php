<?php
include('connection.php');
$proudect_id=$_REQUEST['proudect_id'];
$user_id=$_REQUEST['usr_id'];
$rating=$_REQUEST['rating_count'];

$sql_check=mysqli_num_rows(mysqli_query($con,"select * from rating where proudect_id='$proudect_id'"));

if($sql_check>0){
   $sql=mysqli_query($con,"UPDATE `rating` SET `user_id`='$user_id',`proudect_id`='$proudect_id',`rating`='$rating' WHERE proudect_id='$proudect_id'");
}else{
  $sql=mysqli_query($con,"insert into rating (`user_id`,`proudect_id`,`rating`) values('$user_id','$proudect_id','$rating')");
}


if($rating==1){
  echo "rating_one";
}elseif($rating==2){
  echo "rating_tow";
}elseif($rating==3){
  echo "rating_three";
}elseif($rating==4){
  echo "rating_four";
}elseif($rating==5){
  echo "rating_five";
}

 ?>
