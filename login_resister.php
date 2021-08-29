<?php
include("header.php");
$check_out='';
// if(isset($_SESSION['USER_ID'])){
//  redirect('profile.php');
// }
if(isset($_GET['raffer_link']) && $_GET['raffer_link'] !=''){
  $rafer_code=$_GET['raffer_link'];
  $_SESSION["RAFFERL_CODE"]=$rafer_code;
}
if(isset($_REQUEST['is_checkout'])){
  $check_out=$_REQUEST['is_checkout'];
  $_SESSION['GO_TO_CHECKOUT']='checkout';
}
 ?>
 <style type="text/css">
  #err_msg_email {
    margin-top: -29px;
    margin-bottom: 24px;
    font-size: 18px;
    color: red;
  }
  #err_msg_login_s{
    margin-top: -29px;
    margin-bottom: 24px;
    font-size: 18px;
    color: red;
  }
  #msg_email{
    margin-top:-20px;
    margin-bottom: 15px;
    font-size: 18px;
    color: black;
  }
  #err_msg_login{
    margin-top: -20px;
    margin-bottom: 24px;
    font-size: 18px;
    color: red;
  }

  .bal_btn{
    background-color: #f2f2f2;
border: medium none;
border-radius: 3px;
color: #242424;
cursor: pointer;
font-size: 14px;
font-weight: 500;
line-height: 1;
padding: 11px 30px;
text-transform: uppercase;
transition: all 0.3s ease 0s;
  }
#err_msg,#err_msg_pwd,#err_msg_name,#err_msg_mobile,#err_msg_pass,#err_msg_eml{
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
               <h4> login </h4>
             </a>
             <a data-toggle="tab" href="#lg2">
               <h4> register </h4>
             </a>
           </div>
           <div class="tab-content">
           <?php if($check_out==''){ ?>
             <div id="lg1" class="tab-pane active">
               <div class="login-form-container">
                 <div class="login-register-form">
                   <form method="post">
                     <input type="email"  id='email_log' name="email_log" placeholder="Email" required>
                     <div id="err_msg"></div>
                     <input type="password" id='pwd_log'  name="pwd_log" placeholder="Password" required>
                     <div id="err_msg_pwd"></div>
                      <input type="hidden" name="type" id='type_log' value="login">
                        <input type="hidden" name="is_checkout" id='is_checkout' value="no">
                     <div class="button-box">
                       <div class="login-toggle-btn">
                         <input type="checkbox">
                         <label>Remember me</label>
                         <a href="link_submit_email.php">Forgot Password?</a>
                       </div>
                       <a id='submit'class="bal_btn" href="javascript:void(0)" onclick="log_data()"><span>Login</span></a>
                     </div><br><br><br>
                       <div id="err_msg_login_s"></div>
                   </form>
                 </div>
               </div>
             </div>
           <?php } ?>
             <div id="lg2" class="tab-pane">
               <div class="login-form-container">
                 <div class="login-register-form">
                   <form  method="post" id='frmDataSubmit'>
                     <input type="text" id='name' name="user-name" placeholder="Username" value=''required>
                     <div id="err_msg_name"></div>
                     <input type="number" id='mobile' name="Mobile-Number" placeholder="Mobile"value=''required>
                     <div id="err_msg_mobile"></div>
                     <input type="password" id='password' name="user-password" placeholder="Password"value=''required>
                     <div id="err_msg_pass"></div>
                     <input name="user-email" id='email' placeholder="Email" type="email" value='' required>
                     <div id="err_msg_eml"></div>
                     <input type="hidden" name="type" id='type_res' value="resister">
                     <div class="button-box">
                       <a id='submit'class="bal_btn" href="javascript:void(0)" onclick="res_data()"><span>Register</span></a>
                     </div><br><br><br>
                       <div id="err_msg_email"></div>
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
include("footer.php");
 ?>
