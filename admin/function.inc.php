<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($str){
	global $con;
	$str=mysqli_real_escape_string($con,$str);
	return $str;

}

function redirect($link){
	?>
	<script>
	window.location.href='<?php echo $link?>';
	</script>
	<?php
	die();
}
function get_sells($start,$End){
	global $con;
		$sql=mysqli_query($con,"select sum(final_price) as final_price from order_master where add_on between '$start' and '$End' and order_stats='delivered'");
 	while($data=mysqli_fetch_assoc($sql)){
  	return $data['final_price'];
	}
	
}
function get_best_proudect(){
	global $con;
		$sql=mysqli_query($con,"SELECT COUNT(order_detels.desh_detali_id) as t,order_detels.desh_detali_id,dish.dish,dish.images,dish_details.id,dish_details.Price FROM order_detels,dish,dish_details where `order_detels`.`desh_detali_id`= `dish_details`.`id` and `dish_details`.`dish_id`=`dish`.`id` group by desh_detali_id order by COUNT(desh_detali_id) DESC LIMIT 6");
		$arr=array();
 	while($data=mysqli_fetch_assoc($sql)){
  	$arr[]=$data;
	}
	return $arr;
}

function get_best_seller(){
		global $con;
		$sql=mysqli_query($con,"SELECT COUNT(`order_master`.`user_id`) as t,`user`.`name`,`user`.`images`,user.email FROM `order_master`,`user` where `order_master`.`user_id`=`user`.`id` group by `order_master`.`user_id` order by COUNT(user_id) DESC LIMIT 6");
		$arr=array();
 	while($data=mysqli_fetch_assoc($sql)){
  	$arr[]=$data;
	}
	return $arr;
}
//=========CUSTOM ADD USER=====================//
function wallat_amount_add_by_custom($ammount,$user_id,$type,$msg,$txn_id){
  global $con;
  $date=date("Y-m-d h:i:s");
  $sql=mysqli_query($con,"INSERT INTO `wallat`(`user_id`, `amount`, `type`, `msg`,`Txn_id`, `add_on`) VALUES ('$user_id','$ammount','$type','$msg','$txn_id','$date')");
}
function wallat_amount_get($user_id){
  global $con;
  $date=date("Y-m-d h:i:s");
  $sql=mysqli_query($con,"select * from wallat where user_id='$user_id'");
	$in=0;
	$out=0;
	while($data=mysqli_fetch_assoc($sql)){
		$amt=$data['amount'];
		if($data['type']=='in'){
			$in=$in+$amt;
		}
		if($data['type']=='out'){
 		 $out=$out+$amt;
 	 }
	}
		 return $in-$out;
}

?>
