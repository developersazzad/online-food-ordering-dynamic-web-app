<?php
include('connection.php');
include('function.php');
$attr=get_safe_value($_POST['attr']);
$type=get_safe_value($_POST['type']);
if($type=='add'){
  $qty=get_safe_value($_POST['qty']);
  if(isset($_SESSION['USER_ID'])){
    $user_id=$_SESSION['USER_ID'];
    ManagesCartData($user_id,$attr,$qty);
  }else{
    $_SESSION['cart'][$attr]['qty']=$qty;
  }
  $Fulldata=GetAllCartData();
  $totalPrice=0;
  foreach($Fulldata as $list){
    $qty_data=$list['qty'];
    $price_data=$list['price'];
    $totalPrice=$totalPrice+($qty_data*$price_data);
  }
   $fatch=proudect_data_callect($attr);
   $dish_name=$fatch['dish'];
   $price=$fatch['Price'];
   $images=$fatch['images'];
   $cartCount=count($Fulldata);
   $arr=array('count'=>$cartCount,'totalPrice'=>$totalPrice,'price'=>$price,'images'=>$images,'name'=>$dish_name);
   echo json_encode($arr);
}

if($type=='delete'){
   $data_delete=DeleteCartAttr($attr);
   $Fulldata=GetAllCartData();
   $totalCount=count($Fulldata);
   $totalPrice=0;
   foreach($Fulldata as $list){
     $qty_data=$list['qty'];
     $price_data=$list['price'];
     $totalPrice=$totalPrice+($qty_data*$price_data);
   }
   $Data_Arr=array('total_count'=>$totalCount,'totalPrice'=>$totalPrice);
   echo json_encode($Data_Arr);

}
 ?>
