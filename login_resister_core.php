<?php
include("connection.php");
include('function.php');
include('constent.php');
$type=get_safe_value($_POST['type']);
$date=date('Y-m-d h:i:s');
if($type=='resister'){
          $name=get_safe_value($_POST['name']);
          $mobile=get_safe_value($_POST['mobile']);
          $password=get_safe_value($_POST['password']);
          $email=get_safe_value($_POST['email']);
          $sql=mysqli_query($con,"SELECT `id`, `name`, `email`, `mobile`, `password`, `stats`, `add_on` FROM `user` WHERE email='$email'");
                $check=mysqli_num_rows($sql);
                if($check>0){
                  echo "email_exes";
                }else{
                //=======raffarl_number======//
                $rand_raf=rand(11111,99999);
                $raffarl_number=md5(sha1($rand_raf));
                if(isset($_SESSION["RAFFERL_CODE"])){
                 $form_raffer_code=$_SESSION["RAFFERL_CODE"];
               }else{
                 $form_raffer_code='';
               }

                //=======raffarl_number======//
               $sql_insert=mysqli_query($con,"INSERT INTO `user`( `name`,`images`,`email`, `mobile`, `password`, `stats`,`email_verify`,`raffarl_number`,`form_raffer_code`, `add_on`) VALUES ('$name','','$email','$mobile','$password','1','0','$raffarl_number','$form_raffer_code','$date')");
                  $id=mysqli_insert_id($con);
                  //=====wallat ammount add===========//
                  $type="in";
                  $msg="Sign up bonus";
                  $wallat=wallat_amount_add($id,$type,$msg);
                  unset($_SESSION["RAFFERL_CODE"]);
                  //=====wallat ammount add===========//
                  $html='pleace click this link';
                  $rand=sha1(md5(rand(1111,9999)));
                  $_SESSION['rand_email_verify_id']=$rand;
                  $sub_data=FORNT_SITE_PATH.'verify.php?rand_name='.$rand.'&id='.$id;
                   $subject='pleace click this link and verify your Food Ordering website.link is - '.$sub_data;
                  $sand_email=sand_otp_by_email($email,$html,$subject);
                  echo "success";
                  }
             }elseif($type=='login'){
                $email=get_safe_value($_POST['email']);
                $pasword=get_safe_value($_POST['password']);
                $sql=mysqli_query($con,"SELECT `id`, `name`, `email`, `mobile`, `password`, `stats`,`email_verify`,`add_on` FROM `user` WHERE email='$email' and password='$pasword'");
                $checked=mysqli_num_rows($sql);
                if($checked>0){
                    $fatch_data=mysqli_fetch_assoc($sql);
                    $usr_name=$fatch_data['name'];
                    $usr_email=$fatch_data['email'];
                    $user_id_fatch=$fatch_data['id'];
                    $user_mobile=$fatch_data['mobile'];
                    $stats=$fatch_data['stats'];
                    $check_verify_or_not=$fatch_data['email_verify'];
                    if($check_verify_or_not==1){
                      if($stats==1){
                        $_SESSION['USER_NAME']=$usr_name;
                        $_SESSION['USER_EMAIL']=$usr_email;
                        $_SESSION['USER_ID']=$user_id_fatch;
                        $_SESSION['MOBILE']=$user_mobile;
                       if(isset($_SESSION['cart']) && $_SESSION['cart']>0){
                          $cart=$_SESSION['cart'];
                          foreach($cart as $key=>$val){
                            ManagesCartData($user_id_fatch,$key,$val['qty']);
                          }
                       }
                         echo "login_success";
                         unset($_SESSION['cart']);
                      }else{
                        echo "desabald";
                      }
                    }else{
                       echo "verify_again";
                    }
               }else{
                 echo "login_fail";
                  }
                }
            ?>
