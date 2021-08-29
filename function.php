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
function web_setting(){
	global $con;
	$sql=mysqli_query($con,"select * from setting where id='1'");
	$fatch_data=mysqli_fetch_assoc($sql);
	return $fatch_data;
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
	$sql=mysqli_query($con,"SELECT `id`, `user_id`, `proudect_id`, `qty`, `add_on` FROM `add_cart` WHERE user_id='$userid'");
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
		$status_dish_details=CheckDishDetails_stats($list['proudect_id']);
		if($status_dish_details==1){
			$CartArr[$list['proudect_id']]['qty']=$list['qty'];
			$proudect_id=$list['proudect_id'];
			$dish_data_all=proudect_data_callect($proudect_id);
			$CartArr[$list['proudect_id']]['price']=$dish_data_all['Price'];
			$CartArr[$list['proudect_id']]['name']=$dish_data_all['dish'];
			$CartArr[$list['proudect_id']]['img']=$dish_data_all['images'];
		}else{
			DeleteCartAttr($list['proudect_id']);
		}
	}
	}else{
	if(isset($_SESSION['cart']) && $_SESSION['cart']>0){
	$CartArr=$_SESSION['cart'];
	foreach($CartArr as $key=>$val){
	  $status_dish_details=CheckDishDetails_stats($key);
		if($status_dish_details==1){
			$CartArr[$key]['qty']=$val['qty'];
			$dish_data_all=proudect_data_callect($key);
			$CartArr[$key]['price']=$dish_data_all['Price'];
			$CartArr[$key]['name']=$dish_data_all['dish'];
			$CartArr[$key]['img']=$dish_data_all['images'];
		}else{
			unset($_SESSION['cart'][$key]);
			?>
			<script>
			window.location.href='shop.php';
			</script>
	<?php	}
	}
		}
	 		}

	if($attr_id!=''){
		return $CartArr[$attr_id]['qty'];
	}else{
 	 return $CartArr;
	}
}
//==CHECK ATTRIBUTE EXISEST OR NOT DISH DETAILS===========function============//
function CheckDishDetails_stats($id){
	global $con;
	$sql=mysqli_query($con,"SELECT `status` FROM `dish_details` WHERE id='$id'");
  $data=mysqli_fetch_assoc($sql);
	return $data['status'];
}
//=======DElete data===========//
function DeleteCartAttr($attr){
	if(isset($_SESSION['USER_ID'])){
			 //Attr is dish detail id//
	 	global $con;
		$sql=mysqli_query($con,"DELETE FROM `add_cart` WHERE proudect_id='$attr'");
	}else{
		unset($_SESSION['cart'][$attr]);
	}
}
//========Cart_Data_manages========//
function proudect_data_callect($id){
	global $con;
	$sql=mysqli_query($con,"SELECT dish.images,dish.dish,`dish_details`.`Price`from dish,dish_details WHERE dish_details.id='$id' and dish.id=dish_details.dish_id and `dish_details`.`status`='1' ");
	$row=mysqli_fetch_assoc($sql);
	return $row;
}

function order_detels_core($factch_id_sp){
	global $con;
	$ussArr=array();
	$sql="SELECT `order_detels`.*,order_master.*,order_master.id as order_id_sp, dish.id,dish.images,dish.dish,dish_details.Attribute,dish_details.Price FROM order_detels,order_master,dish,dish_details WHERE `order_detels`.`desh_detali_id`= `dish_details`.`id`and `dish_details`.`dish_id`=dish.id and `order_detels`.`order_id`=order_master.id and order_master.id='$factch_id_sp' ";
	// and dish_details.status=1
	$res=mysqli_query($con,$sql);
	while ($row=mysqli_fetch_assoc($res)) {
		$ussArr[]=$row;
	}
	return $ussArr;
}

function invoice($order_id){
	$rand_id=$_SESSION['rand_user_base_id'];
	$user_id=$_SESSION['USER_ID'];
	$data=order_detels_core($order_id);
	$html='<!doctype html>
	<html>
	<head>
	  <meta charset="utf-8">
	  <title>A simple, clean, and responsive HTML invoice template</title>
	  <style>
	    .invoice-box {
	      max-width: 800px;
	      margin: auto;
	      padding: 30px;
	      border: 1px solid #eee;
	      box-shadow: 0 0 10px rgba(0, 0, 0, .15);
	      font-size: 16px;
	      line-height: 24px;
	      color: #555;
	    }

	    .invoice-box table {
	      width: 100%;
	      line-height: inherit;
	      text-align: left;
	    }

	    .invoice-box table td {
	      padding: 5px;
	      vertical-align: top;
	    }

	    .invoice-box table tr td:nth-child(2) {
	      text-align: right;
	    }

	    .invoice-box table tr.top table td {
	      padding-bottom: 20px;
	    }

	    .invoice-box table tr.top table td.title {
	      font-size: 45px;
	      line-height: 45px;
	      color: #333;
	    }

	    .invoice-box table tr.information table td {
	      padding-bottom: 40px;
	    }

	    .invoice-box table tr.heading td {
	      background: #eee;
	      border-bottom: 1px solid #ddd;
	      font-weight: bold;
	    }

	    .invoice-box table tr.details td {
	      padding-bottom: 20px;
	    }

	    .invoice-box table tr.item td {
	      border-bottom: 1px solid #eee;
	    }

	    .invoice-box table tr.item.last td {
	      border-bottom: none;
	    }

	    .invoice-box table tr.total td:nth-child(2) {
	      border-top: 2px solid #eee;
	      font-weight: bold;
	    }
	     .text-right{
	        text-align: left;
	        }
	    @media only screen and (max-width: 600px) {
	      .invoice-box table tr.top table td {
	        width: 100%;
	        display: block;
	        text-align: center;
	      }

	      .invoice-box table tr.information table td {
	        width: 100%;
	        display: block;
	        text-align: center;
	      }
	    }

	    /** RTL **/
	    .rtl {
	      direction: rtl;
	    }

	    .rtl table {
	      text-align: right;
	    }

	    .rtl table tr td:nth-child(2) {
	      text-align: left;
	    }
	  </style>
	</head>
	<body>
	  <div class="invoice-box">
	    <table cellpadding="0" cellspacing="0">
	      <tr class="top">
	        <td colspan="2">
	          <table>
	            <tr>
	              <td class="title">
	                <img style="width:160px;" src="assets\img\logo\logo.png" alt=""><br /><br />
	                <h4>Hi <span style="color:#e02c2b">'.$data[0]['name'].'</span> </h4>
	              </td>
	              <td>
	              <strong>  Invoice id: '.$rand_id.' </strong><br>
	                Created: '.$data[0]['add_on'].' <br>
	                Due: after 2 or 3 hour.
	              </td>
	            </tr>
	          </table>
	        </td>
	      </tr>
	      <tr class="information">
	        <td colspan="2">
	          <table>
	            <tr>
	              <td>
	                city : '.$data[0]['city'].'.<br>
	                zip : '.$data[0]['zip_code'].'.<br>
	                Address : '.$data[0]['address'].'.
	              </td>

	              <td>
	              <strong class="text-right">Food ordring.</strong><br>
	              <span class="text-right">contect us :</span><br>
	                sazzadrahath@example.com
	              </td>
	            </tr>
	          </table>
	        </td>
	      </tr>
	      <tr class="heading">
	        <td> Item </td>
	        <td>Attribute </td>
	        <td>Qty </td>
	        <td>Price </td>
	      </tr>';
	      $totalprice=0;
	           foreach($data as $row){
	              $order_stats=$row['order_stats'];
	              $pamment_stats=$row['pamment_stats'];
	              $add_on_date=$row['add_on'];
	              $totalprice=$totalprice+($row['quantity']*$row['price']);
	              $html.=' <tr class="item">
	                 <td> '.$row['dish'].'</td>
	                 <td> '.$row['Attribute'].'</td>
	                 <td> '.$row['quantity'].'</td>
	                 <td>$ '.$row['price'].'</td>
	               </tr>';
	        }
	        $html.='  <tr class="total">
	        <td>
	          Total price : '.$data[0]['final_price'].'$
	        </td>
	      </tr>
	    </table>
			<p>Your order detals and your porduct list is hare.it is document for any problam you can sult it.</p>
		<br />
	    <p><b>consultation :</b>This snippet was created to help web designers, front-end and back-end developer save time. Use it in your project and build your app faster,</p>
				<small>Thanks Happy Food Delevery. </small>
	  </div>
	</body>
	</html>';
	return $html;
}

function get_total_price(){
	$data=GetAllCartData();
	$totalPrice=0;
	foreach($data as $list){
	  $qty_data=$list['qty'];
	  $price_data=$list['price'];
	  $totalPrice=$totalPrice+($qty_data*$price_data);
	}
	return $totalPrice;
}
function get_total_rating($proudect_id){
 global $con;
 $sql=mysqli_query($con,"SELECT sum(rating) as rating , count(*) as total from rating WHERE proudect_id='$proudect_id'");
 $fatch=mysqli_fetch_assoc($sql);
 $rating=$fatch['rating'];
 $total=$fatch['total'];
if($total>0){
	$cal=$rating/$total;
	return $cal;
}
}
//=========CUSTOM ADD USER=====================//
function wallat_amount_add_by_custom($ammount,$user_id,$type,$msg,$txn_id){
  global $con;
  $date=date("Y-m-d h:i:s");
  $sql=mysqli_query($con,"INSERT INTO `wallat`(`user_id`, `amount`, `type`, `msg`,`Txn_id`, `add_on`) VALUES ('$user_id','$ammount','$type','$msg','$txn_id','$date')");
}
//=========GIFT USER AMMOUNT=====================//
function wallat_amount_add($user_id,$type,$msg){
	$setting=web_setting();
	$ammount=$setting['wallat_amount'];
  global $con;
  $date=date("Y-m-d h:i:s");
  $sql=mysqli_query($con,"INSERT INTO `wallat`(`user_id`, `amount`, `type`, `msg`, `add_on`) VALUES ('$user_id','$ammount','$type','$msg','$date')");
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
