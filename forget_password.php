<?php
include('header.php');
$msg="";
$suc_id='';
$password_not_same='';
$success='';
if(isset($_SESSION['FORGET_EMAIL'])){
  $email=$_SESSION['FORGET_EMAIL'];
 if(isset($_REQUEST['submit'])){
   $email=$_SESSION['FORGET_EMAIL'];
   $pasword=$_REQUEST['password_new'];
   $pasword_tow=$_REQUEST['password_new_2'];
   if($pasword==$pasword_tow){
     $sql=mysqli_query($con,"SELECT * FROM `user` WHERE email='$email'");
     $check=mysqli_num_rows($sql);
     if($check>0){
       $update_password_sql=mysqli_query($con,"UPDATE `user` SET `password`='$pasword' WHERE email='$email'");
       if($update_password_sql==true){
         $success="your password update";
         $suc_id='019';
       }
     }

   }else{
     $password_not_same="password did not match";
   }
 }
}else{
  $msg="your Link expire pleace resand forgat email.";
}

 ?>
 <style type="text/css">
 #err_msg_email {
   margin-top: -29px;
   margin-bottom: 24px;
   font-size: 18px;
   color: red;
 }
 </style>
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
               <h4><?php echo $email ?></h4>
             </a>
           </div>
           <div class="tab-content">
             <div id="lg1" class="tab-pane active">
               <div class="login-form-container">
                 <div class="login-register-form">
                   <form action="#" method="post">
                     <input type="text" name="password_new" placeholder="New Password" required>
                     <input type="text" name="password_new_2" placeholder="Retype New Password" required>
                      <div id="err_msg_email"><?php echo $password_not_same ?></div>
                      <div class="row">
                        <div class="col-8">
                          <div class="button-box">
                            <input  type="submit" class="w-25 btn-style  text-light submit" value="submit" name="submit">
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="msg">
                           <p><?php echo $msg ?></p><br>
                           <p><?php echo $success ?></p>
                           <?php
                           if($suc_id=='019'){?>
                             <a class="btn btn-success" href="login_resister.php">Go to Login</a>
                          <?php }
                            ?>
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
     </div>
   </div>
 </div>

<?php
include('footer.php');
 ?>
