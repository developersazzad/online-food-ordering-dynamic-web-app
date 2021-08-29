<?php
include('header.php');
if(isset($_REQUEST['remove_images_id']) && $_REQUEST['remove_images_id']!=''){
  $delete_img_id=$_REQUEST['remove_images_id'];
  $delete_sql=mysqli_query($con,"UPDATE `user` SET `images`='' WHERE id='$delete_img_id'");
}
if(isset($_REQUEST['submit_update'])){
  $usr_id=$_SESSION['USER_ID'];
  $name=get_safe_value($_REQUEST['name']);
  $mobile=get_safe_value($_REQUEST['mobile']);
  $update_profile=mysqli_query($con,"UPDATE `user` SET `name`='$name',`mobile`='$mobile' WHERE id='$usr_id'");
  $_SESSION['USER_NAME']=$name;
  $_SESSION['MOBILE']=$mobile;
}
if(isset($_REQUEST['submit'])){
   $usr_id=$_SESSION['USER_ID'];
  $profile_pic=$_FILES['profile_pic']['name'];
  $profile_pic_tmp=$_FILES['profile_pic']['tmp_name'];
  $rend_name=rand(1111,9999);
  move_uploaded_file("$profile_pic_tmp","media/profile/$rend_name.jpg");
  $update_sql=mysqli_query($con,"UPDATE `user` SET  `images`='$rend_name.jpg' WHERE id='$usr_id'");
?>
<!-- <script>
window.location.href='profile.php';
</script> -->
<?php
}
 ?>
<style type="text/css">
i.fa.fa-trash {
  font-size: 24px;
  position: absolute;
  right: 40px;
  overflow: hidden;
  z-index: 99999;
  top: 94px;
  background: #fcfcfc;
  color: #fc2b2b;
  padding: 10px 12px;
  border-radius: 50%;
}
.imags_hover{
  opacity: 0;
  transition: .3s;
}
.sp_card_call:hover .imags_hover{
  opacity: 1;
}
.small_img{
  width:120px;
  border:2px solid gray;
}
strong.text-left {
    text-align: left;
    display: block;
}
</style>
 <!-- my account start -->
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
 <div class="contact-area pt-100 pb-100">
   <div class="container">
     <div class="row">
       <div class="col-lg-4 col-md-6 col-12">
         <div class="contact-info-wrapper text-center mb-30">
          <?php
           if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']!=''){
             $usr_id=$_SESSION['USER_ID'];
             $sql=mysqli_query($con,"SELECT `id`, `name`, `images`, `email`, `mobile`, `password`, `stats`, `email_verify`, `raffarl_number`, `add_on` FROM `user` WHERE  id='$usr_id'");
             $fatch_data=mysqli_fetch_assoc($sql);
             $name=$fatch_data['name'];
             $email=$fatch_data['email'];
             $rafferl=$fatch_data['raffarl_number'];
             $mobile=$fatch_data['mobile'];
             $stats=$fatch_data['stats'];
             $images=$fatch_data['images'];
             if($images==''){?>
               <div class="card">
                 <div class="card-body">
                   <h4>Input Your profile picture.</h4>
                   <form method="post" enctype="multipart/form-data">
                     <input class="form-control" type="file" name="profile_pic">
                     <input type="submit" class="submit btn btn-primary" name="submit" value="submit">
                   </form>
                 </div>
               </div>
           <?php
         }else{?>
           <div class="card">
             <div class="card-header">
               <h4>Profile picture</h4>
             </div>
             <div class="card-body sp_card_call">
              <img src="media/profile/<?php echo $images?>" class="w-100 image-fluid" alt="">
              <a href="?remove_images_id=<?php echo $usr_id ?>" class="imags_hover"><i class="fa fa-trash"></i></a>
             </div>
             <div class="card-footer">
               <h4><a href="?edit_id=<?php echo $usr_id ?>">Edit</a></h4>
             </div>
           </div>
         <?php  }
       }else{
         redirect('shop.php');
       }
           ?>
         </div>
       </div>
       <div class="col-lg-6 col-md-6 col-12">
         <div class="mt-5 pt-3 d-none d-md-block"></div>
         <div class="contact-info-wrapper text-center mb-30">
           <div class="contact-info-icon">
           <?php  if($images!=''){  ?>
              <img src="media/profile/<?php echo $images?>" class="small_img" alt="">
           <?php }else{?>
              <i class="fa fa-user"></i>
          <?php } ?>
           </div>
           <div class="contact-info-content">
             <h4>Name : <?php echo $name ?></h4>
             <h4>Email : <?php echo $email ?></h4>
             <p>Mobile: <?php echo $mobile ?></p>
             <p>stats : <?php if($stats==1){
               echo "Your account secured.";
             } ?></p><br>
             <strong class="text-left">Raffarl Number : <?php echo $rafferl ?></strong>
             <strong class="text-left">Raffarl link : <a class="text-primary" href="login_resister.php?raffer_link=<?php echo $rafferl ?>">login_resister.php?raffer_link=<?php echo $rafferl ?></a></strong><br>
             <a class="btn btn-danger rounded" href="order_hestory.php">order Hestory</a>
            
           </div>
         </div>
       </div>
     </div>

     <!-- other section -->
   <?php
   if(isset($_REQUEST['edit_id']) && $_REQUEST['edit_id']!=''){
     $edit_id_sp=$_REQUEST['edit_id'];
     $sql_data_call=mysqli_query($con,"SELECT `id`, `name`, `images`, `email`, `mobile`, `password`, `stats`, `email_verify`, `add_on` FROM `user` WHERE id='$edit_id_sp'");
      $fatch_data_call=mysqli_fetch_assoc($sql_data_call);
     ?>
     <div class="row">
       <div class="col-12">
         <div class="contact-message-wrapper">
           <h4 class="contact-title">Your profile data</h4>
           <div class="contact-message">
             <form method="post">
               <div class="row">
                 <div class="col-lg-5">
                   <div class="contact-form-style mb-20">
                     <input value="<?php echo $fatch_data_call['name'] ?>" name="name" id='name_sp_update' placeholder="Full Name" type="text">
                   </div>
                 </div>
                 <div class="col-lg-5">
                   <div class="contact-form-style mb-20">
                     <input value="<?php echo $fatch_data_call['mobile'] ?>" name="mobile" placeholder="Mobile number" type="text">
                   </div>
                 </div>
                 <div class="col-lg-3">
                   <div class="contact-form-style">
                    <input class="submit btn-style" type="submit" name="submit_update" value="Update profile" onclick="update_data()">
                   </div>
                 </div>
               </div>
             </form>
             <p class="form-messege"></p>
           </div>
         </div>
       </div>
     </div>
     <?php
   }
    ?>
   </div>
 </div>

<?php
include('footer.php');
 ?>
