<?php
session_start();
include('connection.php');
include('function.inc.php');
include('constent.php');

//======SPICIFIC TITLE SELECT===================//
$Title_str=$_SERVER['REQUEST_URI'];
$title_curr=explode("/",$Title_str);
 $title=$title_curr[count($title_curr)-1];
if($title=='category.php' || $title=='manage_category.php'){
	$real_title="Category";
}elseif($title=='add_delevery_boy.php' || $title=='Delevery_boy.php'){
	$real_title="Delevery boy";
}elseif($title=='copone_coad.php' || $title=='manage_coponeCoad.php'){
	$real_title="Copone Coad";
}elseif($title=='dish.php' || $title=='manage_dish.php'){
	$real_title="Dish";
}elseif($title=='user.php'){
	$real_title="user";
}elseif($title=='banner.php' || $title=='manage_banner.php'){
	$real_title="banner";
}elseif($title=='contect_us_admin.php'){
	$real_title="Contect us";
}elseif($title=='order.php'){
	$real_title="Order";
}elseif($title=="index.php"){
 	$real_title="Deshbord";
}
//======SPICIFIC TITLE SELECT===================//
if(!isset($_SESSION['IS_LOGIN'])){
	redirect('login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Food Ordering - <?php echo $real_title ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
	<link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
          <li class="nav-item nav-toggler-item">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
        </ul>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo.png" alt="logo"/></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name"><?php echo $_SESSION['Admin_name'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>

          <li class="nav-item nav-toggler-item-right d-lg-none">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
					<li class="nav-item">
						<a class="nav-link" href="index.php">
							<i class="mdi mdi-view-quilt menu-icon"></i>
							<span class="menu-title">Dashboard</span>
						</a>
					</li>
          <li class="nav-item">
            <a class="nav-link" href="dish.php">
              <i class="mdi mdi-view-quilt menu-icon"></i>
              <span class="menu-title">Dish</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="category.php">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Category</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="banner.php">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Banner</span>
            </a>
          </li>
					<li class="nav-item">
						<a class="nav-link" href="user.php">
							<i class="mdi mdi-account-box menu-icon"></i>
							<span class="menu-title">User</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="Delevery_boy.php">
							<i class="mdi mdi-view-headline menu-icon"></i>
							<span class="menu-title">Delevery Boy</span>
						</a>
					</li>
          <li class="nav-item">
            <a class="nav-link" href="setting.php">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Setting</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="order.php">
              <i class="mdi mdi-view-quilt menu-icon"></i>
              <span class="menu-title">Order Master</span>
            </a>
          </li>
					<li class="nav-item">
						<a class="nav-link" href="copone_coad.php">
							<i class="mdi mdi-view-headline menu-icon"></i>
							<span class="menu-title">Copone Code</span>
						</a>
					</li>
          <li class="nav-item">
            <a class="nav-link" href="contect_us_admin.php">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Contect us</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
