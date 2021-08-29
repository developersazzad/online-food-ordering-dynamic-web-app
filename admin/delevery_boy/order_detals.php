<?php
session_start();
include('../connection.php');
include('../function.inc.php');
include('../constent.php');
if(isset($_REQUEST['order_id'])){
  $order_id=$_REQUEST['order_id'];
}else{
  redirect('index.php');
}
//===========Collect Order id============//
$sql_user=mysqli_query($con,"SELECT `id`, `user_id`, `name`, `email`, `mobile`,`total_price`, `pamment_stats`, `order_stats`,delevery_boy_id, `add_on` FROM `order_master` WHERE id='$order_id'");

$fatch=mysqli_fetch_assoc($sql_user);
$user_id=$fatch['id'];
$name=$fatch['name'];
$email=$fatch['email'];
$pamment_stats=$fatch['pamment_stats'];
$order_stats=$fatch['order_stats'];
$add_on_date=$fatch['add_on'];
$delevery_boy=$fatch['delevery_boy_id'];
$sql="SELECT `order_detels`.*, dish.images,dish.dish,dish_details.Attribute,dish_details.Price FROM order_detels,dish,dish_details WHERE `order_detels`.`desh_detali_id`= `dish_details`.`id`and `dish_details`.`dish_id`=dish.id and `order_detels`.`order_id`='$order_id'";
$res=mysqli_query($con,$sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Food Ordering - Order</title>
  <!-- plugins:css -->
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/sweetalert.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/custom.css">
  <style type="text/css">
    @media (min-width: 992px) {
      span.mdi.mdi-menu {
        display: none;
      }

      .main-panel {
        transition: width 0.25s ease, margin 0.25s ease;
        width: calc(100%);
        min-height: calc(100vh - 70px);
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: column;
        flex-direction: column;
      }

    }
  </style>
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
          <a class="navbar-brand brand-logo" href="index.php"><img src="../assets/images/logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../assets/images/logo.png" alt="logo" /></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name"><?php echo $_SESSION['DELEVERY_BOY_NAME'] ?></span>
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
      <div class="main-panel">
        <div class="content-wrapper">
          <style type="text/css">
            td#font_bog {
              font-size: 16px;
            }
          </style>
          <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Order Owner Name : <?php echo $name ?></h1>
		   	 			<p class="lead">Emai : <?php echo $email ?></p>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No #</th>
                            <th width="15%">Proudect</th>
                            <th width="15%">img</th>
                            <th width="15%">Attribute</th>
                            <th width="15%">Price</th>
                            <th width="15%">Qty</th>
                            <th width="15%">p_status</th>
                            <th width="15%">order status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
					          		$i=1;
					          		while($row=mysqli_fetch_assoc($res)){
                          $user_order_id=$row['user_order_id'];
												?>
						                  <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $row['dish']?></td>
                                <td style="width:70px">
                                  <img style="width:70px;height:60px" src="http://localhost/food_ordering/media/dish/<?php echo $row['images']?>" alt=""></td>
                                <td><?php echo $row['Attribute']?></td>
                                <td><?php echo $row['Price']?></td>
                                <td><?php echo $row['quantity']?></td>
                                <td><?php echo $pamment_stats ?></td>
							                  <td><?php echo $order_stats ?></td>
                              </tr>
            <?php
						$i++;
						} } else { ?>
						<tr>
							<td colspan="5">No data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                    <br>
                    <a href="index.php" class="btn btn-primary">Back</a>
                  </div>
				        </div>
              </div>
            </div>
          </div>
        </div>
                <footer class="footer">
                  <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
                  </div>
                </footer>
                <!-- partial -->
              </div>
              <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
          </div>
          <!-- container-scroller -->

          <!-- plugins:js -->
          <script src="assets/js/vendor.bundle.base.js"></script>
          <script src="assets/js/jquery.dataTables.js"></script>
          <script src="assets/js/dataTables.bootstrap4.js"></script>
          <!-- endinject -->
          <!-- Plugin js for this page -->
          <script src="assets/js/Chart.min.js"></script>
          <script src="assets/js/bootstrap-datepicker.min.js"></script>
          <!-- End plugin js for this page -->
          <!-- inject:js -->
          <script src="assets/js/off-canvas.js"></script>
          <script src="assets/js/hoverable-collapse.js"></script>
          <script src="assets/js/template.js"></script>
          <script src="assets/js/settings.js"></script>
          <script src="assets/js/todolist.js"></script>
          <!-- endinject -->
          <!-- Custom js for this page-->
          <script src="assets/js/data-table.js"></script>
          <!-- End custom js for this page-->

        </body>
        </html>
