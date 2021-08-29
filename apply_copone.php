<?php
include('connection.php');
include('function.php');
$C_P_N_coad=get_safe_value($_POST['copone_coad']);
$sql=mysqli_query($con,"SELECT `id`, `copone_code`, `copone_type`, `copone_value`, `cart_min_value`, `expire_on`, `stats`, `add_on` FROM `copone_code` WHERE copone_code='$C_P_N_coad' and stats=1 ");
$check_sql=mysqli_num_rows($sql);
if($check_sql>0){
    $fatch_data=mysqli_fetch_assoc($sql);
    $expire_on=strtotime($fatch_data['expire_on']);
    $carr_time=strtotime(date('Y-m-d'));
    if($carr_time>$expire_on){
      $arr=array('status'=>'error','msg'=>'copone coad is expire');
       echo json_encode($arr);
    }else{
      $cart_min_value=$fatch_data['cart_min_value'];
      $copone_code=$fatch_data['copone_code'];
      $copone_type=$fatch_data['copone_type'];
      $copone_value=$fatch_data['copone_value'];
      $totalPrice=get_total_price();
    if($cart_min_value<$totalPrice){
      if($copone_type=='F'){
        $apply_price=$totalPrice-$copone_value;
      }
      if($copone_type=='P'){
        $apply_price=$totalPrice-($copone_value/100)*$totalPrice;
      }
      $_SESSION['COPONE_COAD']=$copone_code;
      $_SESSION['FINAL_PRICE']=$apply_price;
      $arr=array('status'=>'success','msg'=>'total price this p'.$apply_price,'total_price'=>$apply_price,'copone_code'=>$copone_code);
       echo json_encode($arr);

    }else{
      $arr=array('status'=>'error','msg'=>'copone only apply grater than '.$cart_min_value);
       echo json_encode($arr);
    }
    }

}else{
  $arr=array('status'=>'error','msg'=>'copone coad not found');
   echo json_encode($arr);
}
 ?>
