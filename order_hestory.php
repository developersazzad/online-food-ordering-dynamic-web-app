<?php
include('header.php');
$rating_sp='';
$rating_msg='';
if(!isset($_SESSION['USER_ID'])){
    redirect('shop.php');
}
 $user_id=$_SESSION['USER_ID'];

if(isset($_REQUEST['cancel_id'])){
  $cancel_id=$_REQUEST['cancel_id'];
  $date=date("Y-m-d h:i:s");
  $sql_order=mysqli_query($con,"UPDATE `order_master` SET `order_stats`='cancel' , cancel_at='user',cancel_date='$date' WHERE order_stats = 'pandding' and user_id='$user_id' and id='$cancel_id'");
    redirect("order_hestory.php");

}
 $user_id=$_SESSION['USER_ID'];
 $sql_order=mysqli_query($con,"SELECT `id`, `user_id`, `name`, `email`, `mobile`, `address`, `city`, `zip_code`, `total_price`, `copone_coad`, `final_price`, `gst`, `delevery_boy_id`, `pamment_stats`, `order_stats`, `add_on` FROM `order_master` WHERE user_id='$user_id' order by add_on desc");
 ?>
<div class="breadcrumb-area gray-bg">
  <div class="container">
    <div class="breadcrumb-content">
      <ul>
        <li><a href="index.html">Home</a></li>
        <li class="active"> <strong>Order history</strong> </li>
        <li class="active"> <strong><?php echo $email ?></strong> </li>
        <li class="active"> <strong><?php echo $name ?></strong> </li>
      </ul>
    </div>
  </div>
</div>
<div class="container bootdey">
  <div class="panel panel-default panel-order">
    <div class="panel-heading p-2 mb-4">
      <div class="btn-group pull-right">
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
            Filter history <i class="fa fa-filter"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="#">Approved orders</a></li>
            <li><a href="#">Pending orders</a></li>
          </ul>
        </div>
      </div>
    </div>
    <?php
    $i=1;
    while($row_sp=mysqli_fetch_assoc($sql_order)){
      $order_is_sp=$row_sp['id'];
      $date=$row_sp['add_on'];
      $res=order_detels_core($order_is_sp);
      ?>
      <div class="box">
        <div class="sub_box bg-success m-0 p-3">
          <span class="text-light mr-5"><?php echo $i ?> / This Date : <?php echo $date ?></span>
          <span>invoice downlode -> <a data-placement="top" class="btn btn-info  btn-xs glyphicon glyphicon-trash" href="invoice_downlode.php?order_id=<?php echo $order_is_sp ?>" title="Danger"><i class="fa fa-file-pdf-o"></i></a></span><?php
          foreach($res as $row){
                 }
                 if($row['copone_coad']!=''){
                 ?>
                 <span class="weight sp_invoice_s">Copone coad : <?php echo $row['copone_coad'] ?>, Final price : <?php echo $row['final_price']?> $</span> <br>
               <?php }else{
                 ?>
                 <span class="weight sp_invoice_s"> Final price : <?php echo $row['total_price']?> $</span> <br>
               <?php
               } ?>
        </div>
        <div class="panel-body p-5 bg_dark mb-4">
          <?php foreach($res as $row){
            $order_stats=$row['order_stats'];
            $name=$row['name'];
            $email=$row['email'];
            $city=$row['city'];
            $zip_code=$row['zip_code'];
            $address=$row['address'];
            $pamment_stats=$row['pamment_stats'];
            $add_on_date=$row['add_on'];
            $p_id=$row['id'];
            $order_id_sp=$row['order_id_sp'];
           //=========Rating==============//
           $rating_sql=mysqli_query($con,"SELECT `id`, `user_id`, `proudect_id`, `rating` FROM `rating` WHERE user_id='$user_id' and proudect_id='$p_id'");
           $check_rating=mysqli_num_rows($rating_sql);
           if($check_rating>0){
             $fatch_rating=mysqli_fetch_assoc($rating_sql);
             $rating_sp=$fatch_rating['rating'];
            }
            ?>
          <div class="row p-2">
            <div class="col-md-1 bg-info  "><img class="align-middle" src="media/dish/<?php echo $row['images'] ?>" class="media-object img-thumbnail"></div>
            <div class="col-md-11">
              <div class="row  bg-light p-3">
                <div class="col-md-12">
                  <div class="pull-right">
                    <label  class="p-1 px-2 mr-1 rounded text-white bg-info"><small><?php echo $order_stats?></small></label>
                  <?php
                    if($order_stats=="pandding"){
                      ?>
                        <label  class="ml-1 p-1 px-2 rounded text-white bg-danger"><small><a  onclick="alert('are you sure ..?')" href="?cancel_id=<?php echo $order_id_sp ?>" class="text-light">Cancel all this date</a></small></label>
                      <?php
                    }
                   ?>
                  </div>
                  <br><br><br>
                  <div class="pull-right ">
                    <label class="p-1  text-dark"><strong>Rating : </strong>
                         <!-- one_ster -->
                    <?php if($rating_sp==1){
                      $rating_msg="Bad";
                      ?>
                     <i  class="text-danger fa fa-star"></i>
                   <?php }elseif($rating_sp==0){ ?>
                     <span id="one_rating_<?php echo $p_id ?>">
                       <i onclick="rating_sp_1('<?php echo $row['id'] ?>','<?php echo $user_id ?>')" class="fa fa-star-o"></i>
                     </span>
                   <?php } ?>
                   <!-- tow_ster -->
                   <?php if($rating_sp==2){
                     $rating_msg="Avrages";
                     ?>
                        <i  class="text-danger fa fa-star"></i>
                        <i  class="text-danger fa fa-star"></i>
                  <?php }elseif( $rating_sp!=3 && $rating_sp!=4 && $rating_sp!=5){ ?>
                     <span id="tow_rating_<?php echo $p_id ?>">
                        <i onclick="rating_sp_2('<?php echo $row['id'] ?>','<?php echo $user_id ?>')" class="fa fa-star-o"></i>
                      </span>
                  <?php } ?>
                       <!-- three_ster -->
                       <?php if($rating_sp==3){
                         $rating_msg="Good";
                         ?>
                          <i  class="text-danger fa fa-star"></i>
                          <i  class="text-danger fa fa-star"></i>
                      <?php }elseif( $rating_sp!=4 && $rating_sp!=5){ ?>
                        <span id="three_rating_<?php echo $p_id ?>">
                            <i onclick="rating_sp_3('<?php echo $row['id'] ?>','<?php echo $user_id ?>')" class="fa fa-star-o"></i>
                        </span>
                      <?php } ?>
                       <!-- four_ster -->
                       <?php if($rating_sp==4){
                         $rating_msg="Very Good";
                         ?>
                           <i  class="text-danger fa fa-star"></i>
                           <i  class="text-danger fa fa-star"></i>
                           <i  class="text-danger fa fa-star"></i>
                           <i  class="text-danger fa fa-star"></i>
                      <?php }elseif( $rating_sp!=5){ ?>
                              <span id="four_rating_<?php echo $p_id ?>">
                                 <i onclick="rating_sp_4('<?php echo $row['id'] ?>','<?php echo $user_id ?>')" class="fa fa-star-o"></i>
                              </span>
                      <?php } ?>
                      <!-- five_ster -->
                      <?php if($rating_sp==5){
                        $rating_msg="Wonderful Food";
                        ?>
                        <i  class="text-danger fa fa-star"></i>
                        <i  class="text-danger fa fa-star"></i>
                        <i  class="text-danger fa fa-star"></i>
                        <i  class="text-danger fa fa-star"></i>
                        <i  class="text-danger fa fa-star"></i>
                     <?php }else{ ?>
                          <span id="five_rating_<?php echo $p_id ?>">
                            <i onclick="rating_sp_5('<?php echo $row['id'] ?>','<?php echo $user_id ?>')" class="fa fa-star-o"></i>
                          </span>
                     <?php } ?>

                   <br><strong>status : <span id="msg_rating_<?php echo $row['id'] ?>"> <?php echo $rating_msg ?>.</span></strong>
                  </label>
                </div><br>
                  <span><strong class="weight_text">Order name : <?php echo $row['dish'] ?></strong></span><br>
                  <span class="weight">Quantity : <?php echo $row['quantity'] ?></span> <br>
                  <span class="weight mr-2">City : <?php echo $city ?>. and</span>
                  <span class="weight mr-2">Zip code : <?php echo $zip_code ?>.</span><br>
                  <span class="weight">Addriss : <?php echo $address ?>.</span><br>
                  <a data-placement="top" class="btn btn-success btn-xs glyphicon glyphicon-ok" href="#" title="View"><i class="fa fa-dollar"></i></a>
                  <a data-placement="top" class="btn btn-info  btn-xs glyphicon glyphicon-usd" href="#" title="Danger"><i class="fa fa-check"></i></a>
                </div>
                <div class="col-md-12 bg-info text-white">
                  order made on: <?php $add_on_date ?> by <a class="text-warning" href="#"><?php echo $name ?> </a>
                </div>
              </div>
            </div>
          </div>
         <?php  } ?>
        </div>

      </div>
     <?php
     $i++;
    }
     ?>
    <div class="panel-footer">Put here some note for example: bootdey si a gallery of free bootstrap snippets bootdeys</div>
  </div>
</div>

<?php
include('footer.php');
 ?>
<style type="text/css">
  body {
    background: #eee;
  }

  .panel-order .row {
    border-bottom: 1px solid #ccc;
  }

  .panel-order .row:last-child {
    border: 0px;
  }

  .panel-order .row .col-md-1 {
    text-align: center;
    padding-top: 15px;
  }

  .panel-order .row .col-md-1 img {
    width: 50px;
    max-height: 50px;
  }

  .panel-order .row .row {
    border-bottom: 0;
  }

  .panel-order .row .col-md-11 {
    border-left: 1px solid #ccc;
  }

  .panel-order .row .row .col-md-12 {
    padding-top: 7px;
    padding-bottom: 7px;
  }

  .panel-order .row .row .col-md-12:last-child {
    font-size: 11px;
    color: #555;
    background: #efefef;
  }

  .panel-order .btn-group {
    margin: 0px;
    padding: 0px;
  }

  .panel-order .panel-body {
    padding-top: 0px;
    padding-bottom: 0px;
  }

  .panel-order .panel-deading {
    margin-bottom: 0;
  }

  .panel-order .row .col-md-1 img {
    width: 70px;
    max-height: 70px;
    display: flex;
    margin-top: 24px;
    margin-left: -7px;
  }

  .weight_text {
    font-size: 19px;
    font-weight: 700;
    padding: 5px;
  }

  .weight {
    font-size: 16px;
    font-weight: 700;
    padding: 5px;
  }
  .bg_dark{
    background: #a2a2a275;
  }
  .border_sp{
    border-top:1px solid black;
  }
</style>
