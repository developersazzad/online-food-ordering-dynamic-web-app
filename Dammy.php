<ul id="faq">
  <?php
  $at_cls='';
  if(isset($_REQUEST['All'])=='done'){
    $at_cls='selected_category';
  }
   ?>
  <li><a class="<?php echo $at_cls ?>" href="?All='done'">All Proudect</a></li>
  <?php
  while($data=mysqli_fetch_assoc($category_sql)){
    $class='';
    if($sort_id==$data['id']){
      $class='selected_category';
    }
    ?>
    <li><a class="<?php echo $class ?>" href="?sort_id=<?php echo $data['id'] ?>"><?php echo $data['category_name'] ?></a> </li>
 <?php  }
   ?>
</ul>

<?php

if(isset($_REQUEST['sort_id'])){
  $sort_id=$_REQUEST['sort_id'];
  $sql.=" and category_id='$sort_id' ";
}
$sql.= "order by id desc";
$proudect_sql=mysqli_query($con,$sql);

 ?>
 //  }elseif($type=='login'){
 //  $email=get_safe_value($_POST['email_log']);
 //  $pasword=get_safe_value($_POST['pwd_log']);
 //  $sql=mysqli_query($con,"SELECT `id`, `name`, `email`, `mobile`, `password`, `stats`, `add_on` FROM `user` WHERE email='$email' and password='$pasword'");
 //  $checked=mysqli_num_rows($sql);
 //  if($checked>0){
 //      $fatch_data=mysqli_fetch_assoc($sql);
 //      $usr_name=$fatch_data['name'];
 //      $usr_email=$fatch_data['email'];
 //      $usr_mobile=$fatch_data['name'];
 //      $_SESSION['USER_NAME']=$usr_name;
 //      $_SESSION['USER_EMAIL']=$usr_email;
 //      $_SESSION['USER_MOBILE']=$usr_mobile;
 // }else{
 //   echo "login_fail";
 //    }
 //  }
