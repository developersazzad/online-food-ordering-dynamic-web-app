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

function sand_otp_by_email($email,$Subject,$html){
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="sazzadrahath@gmail.com";
	$mail->Password="sazzad##1234";
	$mail->SetFrom("sazzadrahath@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject=$Subject;
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		// echo "done";
	}else{
		echo "Error occur";
	}
}

//add to cart===========function============//
function GetUserCart(){
	$userid=$_SESSION['USER_ID'];
	global $con;
	$sql=mysqli_query($con,"SELECT `id`, `user_id`, `proudect_id`, `qty`, `add_on` FROM `add_cart` WHERE 1");
	$dataArr=array();
	while($data=mysqli_fetch_assoc($sql)){
		$dataArr[]=$data;
	}
	return $dataArr;
}
//===Add data cart use session and datebase=======//
function ManagesCartData($user_id,$attr,$qty){
	global $con;
	$date=date('Y-m-d h:i:s');
	$sql=mysqli_query($con,"SELECT `id`, `user_id`, `proudect_id`, `qty`, `add_on` FROM `add_cart` WHERE user_id='$user_id' and proudect_id='$attr'");
	$check=mysqli_num_rows($sql);
	if($check>0){
		$row=mysqli_fetch_assoc($sql);
		$cid=$row['id'];
		$update_sql=mysqli_query($con,"UPDATE `add_cart` SET `qty`='$qty' WHERE id='$cid'");
	}else{
			$sql_insert=mysqli_query($con,"INSERT INTO `add_cart`( `user_id`, `proudect_id`, `qty`, `add_on`) VALUES ('$user_id','$attr','$qty','$date')");
	}
}
//========data callect============//
function GetAllCartData($attr_id=''){
	$CartArr=array();
	if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']>0){
	$GetuserCart=GetUserCart();
	$CartArr=array();
	foreach($GetuserCart as $list){
  	$CartArr[$list['proudect_id']]['qty']=$list['qty'];
		$proudect_id=$list['proudect_id'];
		$dish_data_all=proudect_data_callect($proudect_id);
		$CartArr[$list['proudect_id']]['price']=$dish_data_all['Price'];
		$CartArr[$list['proudect_id']]['name']=$dish_data_all['dish'];
		$CartArr[$list['proudect_id']]['img']=$dish_data_all['images'];
	}
	}else{
	if(isset($_SESSION['cart']) && $_SESSION['cart']>0){
	$CartArr=$_SESSION['cart'];
	foreach($CartArr as $key=>$val){
  	$CartArr[$key]['qty']=$val['qty'];
	  $dish_data_all=proudect_data_callect($key);
		$CartArr[$key]['price']=$dish_data_all['Price'];
		$CartArr[$key]['name']=$dish_data_all['dish'];
		$CartArr[$key]['img']=$dish_data_all['images'];
	}
	}
	}
	if($attr_id!=''){
		return $CartArr[$attr_id]['qty'];
	}else{
 	 return $CartArr;
	}
}

//========Cart_Data_manages========//
function proudect_data_callect($id){
	global $con;
	$sql=mysqli_query($con,"SELECT dish.images,dish.dish,`dish_details`.`Price`from dish,dish_details WHERE dish_details.id='$id' and dish.id=dish_details.dish_id ");
	$row=mysqli_fetch_assoc($sql);
	return $row;
}

?>
