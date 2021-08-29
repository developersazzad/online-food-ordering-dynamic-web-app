<?php
include("header.php");
$msg='';
$err_or_not='';
$msg_error='';
$button='1';

if(isset($_REQUEST['rand_name'])){
   $verify_randid=$_REQUEST['rand_name'];
   $ses_data=$_SESSION['rand_email_verify_id'];
   if($verify_randid==$ses_data){
     $button='2';
     $err_or_not='ok';
     $verify_id=$_REQUEST['id'];
     $sql=mysqli_query($con,"UPDATE `user` SET `email_verify`='1' WHERE id='$verify_id'");
     $raffer_sql=mysqli_query($con,"SELECT `id`, `name`, `images`, `email`, `mobile`, `password`, `stats`, `email_verify`, `raffarl_number`, `form_raffer_code`, `add_on` FROM `user` WHERE id='$verify_id'");

      $fatch_from_raffer=mysqli_fetch_assoc($raffer_sql);
      $form_raffer_code=$fatch_from_raffer['form_raffer_code'];
      $fond_who_is_rafer_code=mysqli_query($con,"SELECT `id`,`email_verify`, `raffarl_number` FROM `user` WHERE raffarl_number='$form_raffer_code'");
      $check=mysqli_num_rows($fond_who_is_rafer_code);
      if($check>0){
        $call_data=mysqli_fetch_assoc($fond_who_is_rafer_code);
        $email_verify=$call_data['email_verify'];
        if($email_verify==1){
          $user_id_raf=$call_data['id'];
          $ammount=30;
          $type='in';
          $msg='rafferal bonas';
          $txn_id=007;
          wallat_amount_add_by_custom($ammount,$user_id_raf,$type,$msg,$txn_id);
        }
      }
     if($sql==true){
       $msg='Thanks for Your Activity.Email Verify success';
     }
   }else{
     $button='1';
   }
}else{
  $msg_error="pleace go to email and click link.";
}
 ?>
 <div class="breadcrumb-area gray-bg">
   <div class="container">
     <div class="breadcrumb-content">
       <ul>
         <li><a href="index.html">Home</a></li>
         <li class="active"> Contact Us </li>
       </ul>
     </div>
   </div>
 </div>
 <div class="login-register-area pt-95 pb-100">
   <div class="container">
       <div class="row">
         <div class="contact-message-wrapper">
           <h4 class="contact-title"><?php if($err_or_not==''){?>
             Pleace Go to email and click a link and verify your email.
           <?php  }else{
             echo $msg;
           } ?></h4>
           <div class="contact-message">
             Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
           </div>
          </div>
          <div class="billing-btn">
            <?php if($button=='1'){ ?>
               <button type="submit" style="background-color: #3df8d0;"><a href="javascript:void(0)" disabled>Go to verify</a></button>
            <?php }elseif($button=='2'){?>
              <button type="submit" style="background-color: #3df8d0;">
                <?php if(isset($_SESSION['GO_TO_CHECKOUT'])){?>
                 <a href="checkout.php">Go to checkout</a>
               <?php }else{ ?>
                  <a href="shop.php?verify='success'">Go to shop</a>
              <?php  } ?></button>
           <?php } ?>
           <h4><?php echo $msg_error ?></h4>
          </div>
       </div>
   </div>
 </div>
<?php
include("footer.php");
 ?>
