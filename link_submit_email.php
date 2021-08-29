<?php
include('header.php');
$msg="";
if(isset($_REQUEST['submit'])){
  $email=$_REQUEST['user_email'];
  $html='pleace click this link';
  $_SESSION['FORGET_EMAIL']=$email;
  $rand=rand(1111,9999);
   $subject='pleace click this link and and changes your password.link is - '.FORNT_SITE_PATH.'forget_password.php';
  $sand_email=sand_otp_by_email($email,$html,$subject);
  if($sand_email==true){
    $msg="go to email and click the link and set new password.";
  }
}
 ?>
 <div class="login-register-area pt-95 pb-100">
   <div class="container">
     <div class="row">
       <div class="col-lg-7 col-md-12 ml-auto mr-auto">
         <div class="login-register-wrapper">
           <div class="login-register-tab-list nav">
             <a class="active" data-toggle="tab" href="#lg1">
               <h4> Your Email </h4>
             </a>
             <a data-toggle="tab" href="#lg2">
               <h4>  </h4>
             </a>
           </div>
           <div class="tab-content">
             <div id="lg1" class="tab-pane active">
               <div class="login-form-container">
                 <div class="login-register-form">
                   <form action="#" method="post">
                     <input type="email" name="user_email" placeholder="User Email" required>
                     <div class="button-box">
                       <input  type="submit" class="w-25 btn-style  text-light submit" value="submit" name="submit">
                     </div>
                   </form><br><br>
                   <div class="msg">
                    <p><?php echo $msg ?></p>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>

<?php
include('footer.php');
 ?>
