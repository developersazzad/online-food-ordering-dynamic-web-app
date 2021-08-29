<?php
session_start();
include('../connection.php');
include('../function.inc.php');
$msg="";
if(isset($_POST['submit'])){
	$mobile=get_safe_value($_POST['mobile']);
	$password=get_safe_value($_POST['password']);
	$sql="select * from delevery_boy where mobile='$mobile' and password='$password'";
	$res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
    $_SESSION['IS_LOGIN_DELEVERY_BOY']='yes';
		$_SESSION['IS_LOGIN_DELEVERY_ID']=$row['id'];
		$_SESSION['DELEVERY_BOY_NAME']=$row['name'];
		redirect('index.php');
	}else{
		$msg="Please enter valid login details";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Food Ordering Admin Login</title>
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo text-center">
                <img src="../assets/images/logo.png" alt="logo">
              </div>
              <h6 class="font-weight-light">Sign in to delevgery boy.</h6>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="textbox" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="mobile" name="mobile" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password"  name="password" required>
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN" name="submit"/>
                </div>
              </form>
			          <div class="login_msg"><?php echo $msg?></div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
</body>
</html>
