<?php
session_start();
include('../connection.php');
include('../function.inc.php');
include('../constent.php');
if(!isset($_SESSION['IS_LOGIN_DELEVERY_ID'])){
  redirect('login.php');
}
$delevery_boy_id=$_SESSION['IS_LOGIN_DELEVERY_ID'];
if(isset($_GET['order_id_submit'])){
  $ur_id=$_GET['order_id_submit'];
  $date=date("Y-m-d h:i:s");
  $sql=mysqli_query($con,"UPDATE `order_master` SET `delevery_boy_id`='$delevery_boy_id',`order_stats`='delivered',`delivered_on`='$date' WHERE id='$ur_id'");
  redirect('index.php');
}
$msg="";
$sql="SELECT `id`, `user_id`, `name`, `email`, `mobile`, `address`, `city`, `zip_code`, `total_price`,`copone_coad`,`final_price`,`gst`, `delevery_boy_id`, `pamment_stats`, `order_stats`, `add_on` FROM `order_master` WHERE delevery_boy_id='$delevery_boy_id' and order_stats!='delivered'";
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
              <h1 class="grid_title">ORDER SUBMIT BOY <small><?php echo $_SESSION['DELEVERY_BOY_NAME'] ?></small></h1>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th width="10%">S.No #</th>
                          <th width="25%">Name/Emai/Mobile</th>
                          <th width="20%">City/Address/Zip</th>
                          <th width="15%">Total price</th>
                          <th style="" class="" width="10%">Pamment/Order stats</th>
                          <th style="" class="" width="10%">Order Detals</th>
                          <th width="15%">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                          $copone=$row['copone_coad'];
                        ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td>
                            <p>Name : <?php echo $row['name'] ?></p>
                            <p>Email :<?php echo $row['email'] ?></p>
                            <p>Mobile :<?php echo $row['mobile'] ?></p>
                          </td>
                          <td>
                            <p>City :<?php echo $row['city'] ?></p>
                            <p>Address :<?php echo $row['address'] ?></p>
                            <p>Zip :<?php echo $row['zip_code'] ?></p>
                          </td>
                          <td>
                            <?php
                            if($copone!=''){ ?>
                            <p>Copone : <?php echo $row['copone_coad'] ?></p>
                            <p>Price : <?php echo $row['final_price'] ?></p>
                            <?php }else{
                              echo $row['total_price'];
                              }
                              ?>
                          </td>
                          <td>
                            <p>Pament :<?php echo $row['pamment_stats'] ?></p>
                            <p>Or:<span class="bg-danger text-light p-1"><?php echo $row['order_stats'] ?></span></p>
                          </td>
                           <td id='' class=""><a class="btn btn-success btn-sm" href="order_detals.php?order_id=<?php echo $row['id'] ?>">Order detals</a></td>
                          <td style="width:70px"><?php $datestr=strtotime($row['add_on']);
                            echo date('Y-m-d h:m',$datestr);
                            ?></td>
                        </tr>
                        <tr><a onclick='are_u_sure("<?php echo $row['id'] ?>")' class="p-3 btn btn-success btn-sm" href="javascript:void(0)">Order delivered</a><br><br></tr>
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
  <script src="../assets/js/vendor.bundle.base.js"></script>
  <script src="../assets/js/jquery.dataTables.js"></script>
  <script src="../assets/js/dataTables.bootstrap4.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../assets/js/Chart.min.js"></script>
  <script src="../assets/js/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/template.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../assets/js/sweetalert.min.js"></script>
  <!-- End custom js for this page-->
  <script>
  function are_u_sure(id){
    swal({
      title: "Are you sure?",
      text: "Your will order status update!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes, Order Dalevered",
      closeOnConfirm: false
    },
    function(){
      swal("Deleted!", "Dalevered status updaye.", "success");
       window.location.href="index.php?order_id_submit="+id;
    });
  }
  </script>
</body>

</html>
