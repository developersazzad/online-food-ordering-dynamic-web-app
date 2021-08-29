<?php
include('header.php');
if(!isset($_SESSION['USER_ID'])){
  redirect('shop.php');
}
$name=$_SESSION['USER_NAME'];
$rand_id=$_SESSION['rand_user_base_id'];
 ?>
 <div class="breadcrumb-area gray-bg">
   <div class="container">
     <div class="breadcrumb-content">
       <ul>
         <li><a href="index.php">Home</a></li>
         <li class="active">Thanks</li>
       </ul>
     </div>
   </div>
 </div>
 <div class="about-us-area pt-50 pb-100">
   <div class="container">
     <div class="row">
       <div class="col-lg-12 col-md-7 d-flex align-items-center">
         <div class="overview-content-2">
           <h2 class="display-3">Thank You <?php echo $name ?><span> For </span> Fodordering !</h2><br>
           <p class="lead">Just waitting for our Boy came to your Home as soon as possable.</p><br>
           <h4 class=" display-4">Your Order id <?php echo $rand_id ?>.</h4>
         </div>
       </div>
     </div>
   </div>
 </div>
<?php
include('footer.php');
 ?>
