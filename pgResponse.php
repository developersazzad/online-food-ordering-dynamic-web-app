<?php
include("connection.php");
include("function.php");
include('constent.php');
// header("Pragma: no-cache");
// header("Cache-Control: no-cache");
// header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";
$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
if($isValidChecksum == "TRUE") {
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
     $order_id=$_POST['ORDERID'];
		 $rand_id=explode('_',$order_id);
		 $order_id_rand=$rand_id[0];
		 $_SESSION['rand_user_base_id']=$order_id_rand;
	   $order_id=$rand_id[1];
		 $TXNID=$_POST['TXNID'];
		 $TXNAMOUNT=$_POST['TXNAMOUNT'];
		  $wallat=$_COOKIE['TYPE'];
		 $user_id=$_COOKIE['USR_ID'];
		 if($wallat=="add_mony"){
			 $user_id=$_COOKIE['USR_ID'];
			 $type="in";
			 $msg="Add By yourself";
	    		wallat_amount_add_by_custom($TXNAMOUNT,$user_id,$type,$msg,$TXNID);
					//====invoice sand=============//
	 				// $email=$_SESSION['USER_EMAIL'];
	 				// $subject=invoice($order_id);
	 				// $html='Food ordering invoice in your order.';
	 				// $sand_email=sand_otp_by_email($email,$html,$subject);
					$_SESSION['USER_ID']=$user_id;
					//========Add cookie=========//
					setcookie('USR_EMAIL',$user_email,time()-(3600*5));
					setcookie('TYPE',$status,time()-(3600*5));
				 //========Add cookie=========//
	 				redirect('transection_history.php');
	 				//======Invoice sand================//
		 }elseif($wallat=="order_now"){
			 $sql=mysqli_query($con,"UPDATE `order_master` SET pamment_stats='success',`pamment_type`='paytm',`pamment_id`='$TXNID' WHERE user_id='$user_id'");
			 //====invoice sand=============//
			 unset($_SESSION['ADD_WALLAT']);
			 $user_email=$_COOKIE["USR_EMAIL"];
			 $Email_ex=explode('%40',$user_email);
			 $email=$Email_ex[0];
				$subject=invoice($order_id);
				$html='Food ordering invoice in your order.';
				$sand_email=sand_otp_by_email($email,$html,$subject);
				$_SESSION['USER_ID']=$user_id;
				//========Add cookie=========//
				setcookie('USR_EMAIL',$user_email,time()-(3600*5));
				setcookie('TYPE',$status,time()-(3600*5));
			 //========Add cookie=========//
				redirect('thanks.php');
				//======Invoice sand================//
		 }

	}else {
		$sql=mysqli_query($con,"UPDATE `order_master` SET pamment_stats='fail' `pamment_type`='paytm',`pamment_id`='fail_txnid' WHERE 1");
	   redirect('error_transection.php');
	}

}else {
	redirect('error_transection.php');
}

?>
