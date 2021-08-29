<?php
include('header.php');
$err_msg='';
if(!isset($_SESSION['USER_ID'])){
    redirect('shop.php');
}
if(isset($_POST['submit'])){
 $mony=$_POST['add_mony'];
if($mony>0){
  $rand_user_base_id=rand(1111,9999);
  $insert_id=007;
  $_SESSION['ADD_WALLAT']='add_amout';
  $html='<form style="display:none" method="post" id="" name="sp_formXD" action="pgRedirect.php">
    <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="'.$rand_user_base_id.'_'.$insert_id.'">
    <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="'.$_SESSION['USER_ID'].'">
    <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
    <input id="CHANNEL_ID" tabindex="4" maxlength="12"
      size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
    <input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="'.$mony.'">
    <input value="CheckOut" type="submit" onclick="">
  </form> <script type="text/javascript">
  document.sp_formXD.submit();
  </script>';
  echo $html;
}else{
  $err_msg="<p class='text-danger'>Pleace enter valid Mony.</p>";
}
}
 $user_id=$_SESSION['USER_ID'];
 $sql_order=mysqli_query($con,"SELECT `id`, `user_id`, `amount`, `type`, `msg`, `add_on` FROM `wallat` WHERE user_id='$user_id'");
 ?>
<div class="breadcrumb-area gray-bg">
  <div class="container">
    <div class="breadcrumb-content">
      <ul>
        <li><a href="shop.html">Home</a></li>
        <li class="active"> <strong>Transection history</strong> </li>
        <li class="active"> <strong><?php echo $_SESSION['USER_NAME'] ?></strong> </li>
        <li class="active"> <strong><?php echo $_SESSION['USER_EMAIL'] ?></strong> </li>
      </ul>
    </div>
  </div>
</div>
<div class="container bootdey">
  <div class="row">
    <div class="panel panel-default panel-order col-md-4 col-sm-12">
      <div class="box">
        <div class="my-5 pt-5"></div>
          <div class="login_form p-2 align-middle">
            <div class="card">
              <div class="card-header">
                 <h4 class="mt-2 text-info"><b>Add Mony in your Wallat.</b></h4>
              </div>
               <div class="card-body">
                 <form class="form text-center" method="post">
                   <div class="form-group">
                     <input id="input_mony" class="form-control-sm form-control" type="number" name="add_mony" placeholder="Add Mony* " value="">
                   </div><?php echo $err_msg ?><br>
                   <div class="form-group">
                     <input style="width: 120px;margin-top: -15px;height:40px;border-radius: 4px;" type="submit" class="btn btn-info" name="submit" onfocus=add_data("add_mony") value="submit">
                   </div>
                 </form>
               </div>
               <div class="card-footer text-success"><span>Power by : Bally.</span></div>
            </div>
          </div>
        </div>
    </div>
    <div class="panel panel-default panel-order col-md-8 col-sm-12">
      <?php
      $i=1;
      while($row_sp=mysqli_fetch_assoc($sql_order)){
        $order_is_sp=$row_sp['id'];
        $date=$row_sp['add_on'];
        $amount=$row_sp['amount'];
        $msg=$row_sp['msg'];
        $type=$row_sp['type'];
        ?>
        <div class="box">
          <div class="sub_box bg-success m-0 p-3">
            <span class="text-light mr-5"><?php echo $i ?> / This Date : <?php echo $date ?></span>
          </div>
          <div class="panel-body p-5 bg_dark mb-4">
            <div class="row p-2">
              <div class="col-md-1 bg-info"><img style="" class="align-top text-center mb-2" src="media\porto_ipad.png" class="media-object img-thumbnail" alt="sazzad hossain"></div>
              <div class="col-md-11">
                <div class="row  bg-light p-3">
                  <div class="col-md-12">
                    <div class="pull-right"><label class="p-2 px-3 rounded text-white bg-info"><strong>Type : <?php echo $type ?></strong> </label></div>
                    <span><strong class="weight_text">Transection detals : <?php echo $msg ?></strong></span><br><br>
                    <a data-placement="top" class="btn btn-success btn-xs glyphicon glyphicon-ok" href="#" title="View"> Transection ammount : <?php echo $amount ?> <i class="fa fa-dollar"></i></a>
                    <a data-placement="top" class="btn btn-info  btn-xs glyphicon glyphicon-usd" href="#" title="Danger"><i class="fa fa-check"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       <?php
       $i++;
      }
       ?>
      <div class="panel-footer"><?php $_SESSION['USER_EMAIL'] ;?></div>
    </div>
  </div>
</div>

<?php
include('footer.php');
 ?>
<style type="text/css">
input::placeholder{
  color:#17a2b8 !important;
  opacity: 1;
}
#input_mony{
  margin-top:20px;
  border: 2px solid #17a2b8;
  width: 75%;
  display: inline;
  border-radius: 5px;
}
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
</style>
