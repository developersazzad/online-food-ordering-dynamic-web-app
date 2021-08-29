<?php
require("connection.php");
$delete_id=$_REQUEST['delete_id'];
$delete_sql=mysqli_query($con,"DELETE FROM `dish_details` WHERE id='$delete_id'");
echo "delete Ok";
 ?>
