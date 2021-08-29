<?php
include("connection.php");
include("function.php");
include('constent.php');
$setting=web_setting();
$ammount="";
if(isset($_SESSION['USER_ID'])){
  $ammount=wallat_amount_get($_SESSION['USER_ID']);
}
$web_status=$setting['website_stats'];
$web_off_msg=$setting['website_off_msg'];
$web_cart_msg=$setting['cart_min_value'];
//===============================//
$price_data=[];
$images_for_data=[];
$name_for_data=[];
$data=GetAllCartData();
$cartCount=count($data);
$totalPrice=0;
foreach($data as $list){
  $qty_data=$list['qty'];
  $price_data=$list['price'];
  $images_for_data=$list['img'];
  $name_for_data=$list['name'];
  $totalPrice=$totalPrice+($qty_data*$price_data);
}
//===========CART DATA UPDATE BY SP CART PAGES==========//
if(isset($_POST['cart_update'])){
  $qty_cart=$_POST['qtybutton'];
 	    if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']>0){
        $user_id=$_SESSION['USER_ID'];
         foreach($qty_cart as $key=>$val){
              if($val[0]==0){
                 $sql_qty_update=mysqli_query($con,"delete from `add_cart` WHERE user_id='$user_id' and proudect_id='$key'");
                }else{
                    $sql_qty_update=mysqli_query($con,"UPDATE `add_cart` SET `qty`='".$val[0]."' WHERE user_id='$user_id' and proudect_id='$key'");
                  }
      }
  }else{
     foreach($qty_cart as $key=>$val){
      if($val[0]==0){
        unset($_SESSION['cart'][$key]['qty']);
      }else{
        $_SESSION['cart'][$key]['qty']=$val[0];
      }

  }
}
}
//===========CART DATA UPDATE BY SP CART PAGES==========//

 ?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo SITE_TITLE ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slick.css">
  <link rel="stylesheet" href="assets/css/chosen.min.css">
  <link rel="stylesheet" href="assets/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="assets/css/fontawesome.min.css"> -->
  <link rel="stylesheet" href="assets/css/simple-line-icons.css">
  <link rel="stylesheet" href="assets/css/jquery-ui.css">
  <link rel="stylesheet" href="assets/css/meanmenu.min.css">
  <link rel="stylesheet" href="assets/css/sweetalert.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<style type="text/css">
.border-dark.ion-chevron-down.image-fluid.img_dammo_usr {
    border: 1px solid #888!important;
}
img.img_dammo_usr {
  width: 50px;
}
.images_cart{
  width:120px;
}
.row.box_sp_next {
    margin-bottom: 24px;
}
</style>
<body>
  <!-- header start -->
  <header class="header-area">
    <div class="header-top black-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-12 col-sm-4">
            <div class="welcome-area">
              <p>Order Now and Enjoy. </p>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-12 col-sm-8">
            <div class="account-curr-lang-wrap f-right">
              <ul>
                <li class="top-hover"><a href="#">Wallat : <?php echo $ammount ?>$<i class="ion-chevron-down"></i></a>
                  <ul>
                    <li><a href="profile.php">profile</a></li>
                    <li><a href="transection_history.php">Transection-detals</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-middle">
      <div class="container">
        <div class="row box_sp_next">
          <div class="col-lg-3 col-md-4 col-12 col-sm-4">
            <div class="logo">
              <a href="shop.php">
                <img alt="" src="assets/img/logo/logo.png">
              </a>
            </div>
          </div>
          <div class="col-lg-9 col-md-8 col-12 col-sm-8">
            <div class="header-middle-right f-right">
              <div class="header-login">
                <a href="login_resister.php">
                  <?php
                  if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']!=''){
                   $user_id=$_SESSION['USER_ID'];
                   $name=$_SESSION['USER_NAME'];
                    $email=$_SESSION['USER_EMAIL'];
                    $sql=mysqli_query($con,"SELECT  `name`, `images`, `email`, `mobile`, `password`, `stats`, `email_verify`, `add_on` FROM `user` WHERE id='$user_id'");
                    $fatch_data=mysqli_fetch_assoc($sql);
                    $images=$fatch_data['images'];
                    ?>
                    <div class="header-icon-style">
                      <div class="account-curr-lang-wrap f-right">
                        <ul>
                          <li class="top-hover">
                            <?php
                            if($images!=''){?>
                              <img class="border-dark ion-chevron-down image-fluid img_dammo_usr" src="media\profile\<?php echo $images ?>" alt="">
                           <?php }else{?>
                              <img class="ion-chevron-down image-fluid img_dammo_usr" src="media\svg\user.svg" alt="">
                          <?php }
                             ?>
                            <ul>
                              <li><a href="profile.php">profile edit</a></li>
                              <li><a href="order_hestory.php">order Hestory</a></li>
                              <li><a href="logout.php">Logout</a></li>
                            </ul>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="login-text-content">
                      <p>Welcome <br> to <span id='username_sp_update'><?php  echo $name?></span></p>
                    </div>
                    <?php
                  }else{ ?>
                    <div class="header-icon-style">
                      <i class="icon-user icons"></i>
                    </div>
                    <div class="login-text-content">
                      <p>Register <br> or <span>Sign in</span></p>
                    </div>
                <?php }
                   ?>
                </a>
              </div>
              <div class="header-wishlist">
                &nbsp;
              </div>
              <div class="header-cart">
                <a href="cart.php">
                  <div class="header-icon-style">
                    <i class="icon-handbag icons"></i>
                    <span class="count-style" id="cart_count"><?php echo $cartCount ?></span>
                  </div>
                  <div class="cart-text">
                   <span class="digit">My Cart</span>
                    <span class="cart-digit-bold" id="Cart_total_price"><?php
                     if($cartCount!=0){
                       echo $totalPrice.'$' ;
                     }?></span>
                  </div>
                </a>
                <?php
                 if($cartCount!=0){

                 ?>
                <div class="shopping-cart-content">
                  <ul id="add_li_ajax">
                    <?php
                    $sql_data=GetAllCartData();
                      foreach($sql_data as $key=>$call_data){
                        $qty_for_data=$call_data['qty'];
                        $price_for_data=$call_data['price'];
                        $images_for_data=$call_data['img'];
                        $name_for_data=$call_data['name'];
                      ?>
                      <li class="single-shopping-cart sp_cls_<?php echo $key  ?>" id="attr_sp_"<?php echo $key?>>
                        <div class="shopping-cart-img">
                          <a href="#"><img class="image-fluid images_cart" alt="" src="media/dish/<?php echo $images_for_data ?>"></a>
                        </div>
                        <div class="shopping-cart-title">
                          <h4><a href="#"><?php echo $name_for_data ?> </a></h4>
                          <h6>Qty: <?php  echo $qty_for_data ?></h6>
                          <span><?php echo $price_for_data ?></span>
                        </div>
                        <div class="shopping-cart-delete">
                          <a href="javascript:void(0)" onclick=delete_cart('<?php echo $key ?>','delete')><i class="ion ion-close"></i></a>
                        </div>
                      </li>
                   <?php }
                     ?>
                  </ul>
                  <div class="shopping-cart-total">
                    <h4>Shipping : <span>$20.00</span></h4>
                    <h4>Total : <span class="shop-total" id="shop_total_price"><?php echo $totalPrice.'$' ;?></span></h4>
                  </div>
                  <div class="shopping-cart-btn">
                    <a href="javascript:void(0)" onclick="go_to_this_pages('cart.php')">view cart</a>
                    <a href="javascript:void(0)" onclick="go_to_this_pages('checkout.php')">checkout</a>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-bottom transparent-bar black-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="main-menu">
              <nav>
                <ul>
                  <li><a href="shop.php">Home</a></li>
                  <li><a href="about_us.php">about</a></li>
                  <li><a href="contact.php">contact us</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- mobile-menu-area-start -->
    <div class="mobile-menu-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="mobile-menu">
              <nav id="mobile-menu-active">
                <ul class="menu-overflow" id="nav">
                  <li><a href="shop.php">Shop</a></li>
                  <li><a href="about_us.php">about</a></li>
                  <li><a href="contact.php">contact us</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- mobile-menu-area-end -->
  </header>
