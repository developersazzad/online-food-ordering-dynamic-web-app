<?php
include('header.php');
$cart_error_msg='';
if($web_status=='1'){
  redirect('shop.php');
 }
$usr_name='';
$usr_email='';
$user_id_fatch='';
$user_mobile='';
if($cartCount==0){
  redirect('shop.php');
}
if(isset($_SESSION['USER_ID'])){
    $is_show_order="yes_show";
    $is_login_box="not_show";
}else{
    $is_show_order="not_show";
    $is_login_box="yes_show";
}
//======POPLOATE DATA=========//
if(isset($_SESSION['USER_ID'])){
  $usr_name=$_SESSION['USER_NAME'];
  $usr_email=$_SESSION['USER_EMAIL'];
  $user_id_fatch=$_SESSION['USER_ID'];
  $user_mobile=$_SESSION['MOBILE'];
}
//=======ORDER SUBMIT===============//
if(isset($_REQUEST['order_submit'])){
  $name=get_safe_value($_REQUEST['name']);
  $email=get_safe_value($_REQUEST['email']);
  $mobile=get_safe_value($_REQUEST['mobile']);
  $addriss=get_safe_value($_REQUEST['Address']);
  $city=get_safe_value($_REQUEST['city']);
  $zip_code=get_safe_value($_REQUEST['zip_code']);
  $countery=get_safe_value($_REQUEST['countery']);
  $pamment_method=get_safe_value($_REQUEST['pamment_method']);
  $date=date('Y-m-d h:i:s');
  if(isset($_SESSION['COPONE_COAD']) &&  $_SESSION['FINAL_PRICE']){
    $final_price=$_SESSION['FINAL_PRICE'];
    $copone_coad=$_SESSION['COPONE_COAD'];
  }else{
    $final_price=$totalPrice;
    $copone_coad='';
  }
  $error='';
  if($final_price!=''){
    $sql_setting_cart_min_value=mysqli_fetch_assoc(mysqli_query($con,"SELECT `cart_min_value` FROM `setting` WHERE id='1'"));
    $cart_min_value=$sql_setting_cart_min_value['cart_min_value'];
    if($cart_min_value>$final_price){
      $error="yes";
      $cart_error_msg="Cart Minimum Value ".$cart_min_value;
    }
  }
 if($error==''){
   $sql_data=mysqli_query($con,"INSERT INTO `order_master`( `user_id`, `name`, `email`, `mobile`, `address`, `city`, `zip_code`, `total_price`, `final_price`, `copone_coad`,`gst`, `delevery_boy_id`, `pamment_type`, `order_stats`, `add_on`) VALUES ('$user_id_fatch','$name','$email','$mobile','$addriss','$city','$zip_code','$totalPrice','$final_price','$copone_coad','1','0','$pamment_method','pandding','$date')");
   $insert_id=mysqli_insert_id($con);
   //==========Proudect Data save database===================//
   $getArrData=GetAllCartData();
   $rand_user_base_id=rand(11111,99999);
   $_SESSION['rand_user_base_id']=$rand_user_base_id;
  foreach($getArrData as $key=>$val){
      $proudect_data_save_sql=mysqli_query($con,"INSERT INTO `order_detels`( `order_id`,`user_order_id`,`desh_detali_id`, `price`, `quantity`, `add_on`) VALUES ('$insert_id','$rand_user_base_id','$key','".$val['price']."','".$val['qty']."','$date')");
  }
 //==========Proudect Data save end database===================//
   if($sql_data==true){
     //=======cart delete=========//
     unset($_SESSION['cart']);
     $sql_delete=mysqli_query($con,"DELETE FROM `add_cart` WHERE user_id='$user_id_fatch'");
     //============pamment method==========//
     if($pamment_method=='cod'){
    //====invoice sand=============//
     $email=$_SESSION['USER_EMAIL'];
     $subject=invoice($insert_id);
     $html='Food ordering invoice in your order.';
     $sand_email=sand_otp_by_email($email,$html,$subject);
     //======Invoice sand================//
      redirect('thanks.php');
    }elseif($pamment_method=='wallat'){
      wallat_amount_add_by_custom($final_price,$_SESSION['USER_ID'],"out","buying product","007");
       $sql_data=mysqli_query($con,"UPDATE `order_master` SET `pamment_stats`='success',`order_stats`='panding' where id='$insert_id'");
      //====invoice sand=============//
       $email=$_SESSION['USER_EMAIL'];
       $subject=invoice($insert_id);
       $html='Food ordering invoice in your order.';
       $sand_email=sand_otp_by_email($email,$html,$subject);
       //======Invoice sand================//
       redirect('thanks.php');

    }elseif($pamment_method=='paytm'){
        //========Add cookie=========//
        $html='<form style="display:none" method="post" id="" name="sp_formXD" action="pgRedirect.php">
      		<input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="'.$rand_user_base_id.'_'.$insert_id.'">
      		<input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="'.$_SESSION['USER_ID'].'">
      		<input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
      		<input id="CHANNEL_ID" tabindex="4" maxlength="12"
      			size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
      		<input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="'.$final_price.'">
      		<input value="CheckOut" type="submit" onclick="">
      	</form> <script type="text/javascript">
        document.sp_formXD.submit();
        </script>';
        echo $html;
    }


   }
 }
  }
 ?>
 <style type="text/css">
 .border_bottom {
   border-bottom: 1px solid #d5d5d5;
   padding-bottom: 10px;
}
 </style>
 <div class="breadcrumb-area gray-bg">
   <div class="container">
     <div class="breadcrumb-content">
       <ul>
         <li><a href="index.html">Home</a></li>
         <li class="active"> Checkout </li>
       </ul>
     </div>
   </div>
 </div>
 <!-- checkout-area start -->
 <div class="checkout-area pb-80 pt-100">
   <div class="container">
     <div class="row">
       <div class="col-lg-8">
         <div class="checkout-wrapper">
           <div id="faq" class="panel-group">
             <?php
             if($is_login_box=='yes_show'){?>
               <div class="panel panel-default">
                 <div class="panel-heading">
                   <h5 class="panel-title"><span>1.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">Checkout method</a></h5>
                 </div>
                 <div id="payment-1" class="panel-collapse collapse show">
                   <div class="panel-body">
                     <div class="row">
                       <div class="col-lg-12">
                         <div class="checkout-login">
                           <div class="title-wrap">
                             <h4 class="cart-bottom-title section-bg-white">LOGIN</h4>
                           </div>
                           <p>Already have an account? </p>
                           <span>Please log in below:</span>
                           <form method="post">
                             <div class="login-form">
                               <label  class="text-success">Email Address * </label>
                               <input type="email"  id='email_log' name="email_log" placeholder="Email" required>
                                <div style="color:red" id="err_msg"></div>
                             </div>
                             <div class="login-form">
                               <label  class="text-success">Password *</label>
                               <input type="password" id='pwd_log'  name="pwd_log" placeholder="Password" required>
                               <div style="color:red" id="err_msg_pwd"></div>
                             </div>
                             <input type="hidden" name="type" id='type_log' value="login">
                            <input type="hidden" name="is_checkout" id='is_checkout' value="yes">
                           <div class="login-forget">
                              <a style="color:red" href="link_submit_email.php">Forgot Password?</a>
                             <p style="" class="text-success">* Required Fields</p>
                           </div>
                           <div class="row">
                             <div class="col-6">
                               <div class="checkout-login-btn">
                                <a id='submit'class="bal_btn" href="javascript:void(0)" onclick="log_data()"><span>Login</span></a>
                               </div>
                               <br><br>
                                 <div style="color:red" id="err_msg_login_s"></div>
                             </div>
                             <div class="col-6">
                               <!-- login_box_stop -->
                               <div class="checkout-login-btn">
                                  <a href="login_resister.php?is_checkout=2083">Resister</a>
                               </div>
                             </div>
                           </div>
                          </form>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
            <?php
              }
              ?>
             <div class="panel panel-default">
               <div class="panel-heading">
                 <h5 class="panel-title"><span>2.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-2">billing information <strong class=" ml-3 text-danger"><?php echo $cart_error_msg ?></strong></a></h5>
               </div>
               <?php
               if($is_show_order=="yes_show"){
                ?>
               <div id="payment-2" class="panel-collapse collapse">
                 <div class="panel-body">
                   <div class="billing-information-wrapper">
                    <form method="post">
                     <div class="row">
                       <div class="col-lg-6 col-md-6">
                         <div class="billing-info">
                           <label> Name</label>
                           <input type="text" value="<?php echo $usr_name ?>" name="name">
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                         <div class="billing-info">
                           <label>Email Address</label>
                           <input type="email" value="<?php echo $usr_email ?>" name="email">
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                         <div class="billing-info">
                           <label>Mobile</label>
                           <input type="tel" value="<?php echo $user_mobile ?>" name="mobile">
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                         <div class="billing-info">
                           <label>city</label>
                           <input type="text" name="city">
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                         <div class="billing-info">
                           <label>Zip/Postal Code</label>
                           <input type="text" name="zip_code">
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6">
                         <div class="billing-select">
                           <label>Country</label>
                           <select name="countery">
                             <option value="1">United State</option>
                             <option value="2">Azerbaijan</option>
                             <option value="3">Bahamas</option>
                             <option value="4">Bahrain</option>
                             <option value="5">Bangladesh</option>
                             <option value="6">Barbados</option>
                           </select>
                         </div>
                       </div>
                       <div class="col-lg-12 col-md-12">
                         <div class="billing-info">
                           <label>Address</label>
                           <input type="text" name="Address">
                         </div>
                       </div>
                       <div class="col-lg-6 col-md-6 col-6">
                         <div class="billing-info">
                           <label>Copone Code</label>
                           <input id="copone_coad" name="copone_coad" type="text">
                         </div>
                         <span id="copone_error" class="text-danger copone_error"></span>
                       </div>
                       <div class="col-6">
                         <div class="billing-back-btn">
                           <div class="billing-btn">
                             <button type="button" name="copone" onclick="apply_compone()">Appply Copone</button>
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="ship-wrapper">
                       <label class="mb-2">Pamment Method .</label>
                       <div class="row mt-2">
                         <div class="col-md-3">
                           <div class="single-ship d-flex flex-row">
                              <input type="radio" name="pamment_method" value="cod" checked="">
                             <label><img style="margin-top: -35px;width:100px" class="image-fluid" style="width:100px;" src="media\pamment\cod-credit-debit-card-bank-transaction-32288.png" alt=""></label>
                           </div>
                         </div>
                         <div class="col-md-3">
                           <div class="single-ship">
                              <input type="radio" name="pamment_method" value="paytm" checked="">
                             <label><img style="margin-top: -15px;width:100px" class="image-fluid" style="width:100px;" src="media\pamment\paytm-logo-630x336.jpg" alt=""></label>
                           </div>
                         </div>
                         <div class="col-md-3">
                           <?php if($ammount>=$totalPrice){
                             $desabled='';
                             $msg_wallat='';
                           }else{
                             $desabled="disabled='disabled'";
                             $msg_wallat="<small class='text-danger'>wallat amount low.</small>";
                           } ?>
                           <div class="single-ship">
                              <input type="radio" name="pamment_method" value="wallat" <?php echo $desabled ?> >
                             <label><img style="margin-top:-15px;width:100px" class="image-fluid" style="width:100px;" src="media\pamment\logo-landing@2x.png" alt=""><br>
                             <?php echo $msg_wallat ?></label>
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="billing-back-btn">
                       <div class="billing-back">
                         <!-- must valid -->
                          <input type="hidden" name="type" id='type_res' value="resister">
                       </div>
                       <div class="billing-btn">
                         <button onfocus=add_data("order_now") type="order_submit" name="order_submit">Order Place</button>
                       </div>
                       <span><strong class="text-danger"><?php echo $cart_error_msg ?></strong></span>
                     </div>
                   </form>
                   </div>
                 </div>
               </div>
             <?php } ?>
             </div>
           </div>
         </div>
       </div>
       <div class="col-lg-4">
         <div class="checkout-progress">
           <h4>Checkout Progress</h4>
           <ul id="check_out_box">
             <?php
             $sql_data=GetAllCartData();
               foreach($sql_data as $key=>$call_data){
                 $qty_for_data=$call_data['qty'];
                 $price_for_data=$call_data['price'];
                 $images_for_data=$call_data['img'];
                 $name_for_data=$call_data['name'];
               ?>
               <li class="single-shopping-cart" id="">
                <div class="row border_bottom">
                  <div class="col-md-6">
                    <div class="shopping-cart-img">
                      <a href="#"><img class="image-fluid images_cart" alt="" src="media/dish/<?php echo $images_for_data ?>"></a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="shopping-cart-title">
                      <h4><a href="#"><?php echo $name_for_data ?> </a></h4>
                      <h6>Qty : <?php  echo $qty_for_data ?></h6>
                      <span>price : <?php echo $price_for_data ?>$</span>
                    </div>
                  </div>
                </div>
               </li>
            <?php }
              ?>
              <div class="shopping-cart-total">
                <h4>Shipping : <span>$20.00</span></h4>
                <h4>Total : <span class="shop-total" id="shop_total_price"><?php echo $totalPrice.'$' ;?></span></h4>
              </div>
              <div class="shopping-cart-total copone_valid_price">
                <h4 class="">Copone coad : <span class="final_copone_coad"></span></h4>
                <h4>Final Price : <span class="shop-total total_price_copone " id="shop_total_price "></span></h4>
              </div>
           </ul>
         </div>
       </div>
     </div>
   </div>
 </div>

<?php
if(isset($_SESSION['COPONE_COAD']) &&  $_SESSION['FINAL_PRICE']){
  unset($_SESSION['COPONE_COAD']);
  unset($_SESSION['FINAL_PRICE']);
}
include('footer.php');
 ?>
