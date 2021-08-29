<?php
include('top.php');

$sql="SELECT * FROM `order_master` order by id DESC LIMIT 4";
$res=mysqli_query($con,$sql);
?>
<style type="text/css">
  td#font_bog {
    font-size: 16px;
  }

  p.lead {
    font-weight: 600;
  }

  .card.card-bst {
    border-radius: 7px;
    transition: .4s ease;
  }

  img.image-fluid.w-100 {
    filter: contrast(0.8);
    border-radius: 7px;
  }

  .card.card-bst:hover img.bst_img {
    filter: brightness(1.1) drop-shadow(1px 8px 30px #b1afaf);
    transition: .4s ease;
  }

  .card.card-bst:hover .bst-txt {
    background: #3d3d3d;
    transition: .4s;
    padding: 1px;
    width: 100%;
    font-size: 12px;
    transform: translateX(0px);
    border-radius: 4px;
  }

  .bst-txt {
    color: white;
    font-weight: 700;
    margin-bottom: 5px !important;
    padding: 1px;
    width: 100%;
    font-size: 12px;
  }

  .bst_oregin {
    padding: 5px 5px;
  }

  .row.aa {
    margin-top: 22px;
  }

  .card.text-center {
    border-radius: 7px;
  }

  .align-baseline {
    display: flow-root;
    position: relative;
    color: white !important;
    width: 100;
    padding: 5px 1px;
    align-items: center;
    border-radius: 5px;
    text-align: center;
  }

  span.counter_box {
    background: #73f8ea6b;
    padding: 5px 8px;
    font-size: 13px;
    border-radius: 50%;
    box-shadow: 0px 0px 7px 2px black;
  }

  span.count_text_sale {
    padding: 3px 6px;
    font-size: 11px;
    color: #ffffff;
    font-weight: 700;
    background: #2b1d1d;
    border-radius: 5px;
  }

  card-img-overlay.text-light {
    position: absolute;
    /* bottom: 2%; */
    top: 35%;
  }

  .card.sp_user_card:hover img.img_user {
    filter: contrast(1);
  }
</style>
<div class="row">
  <div class="col-md-8">
    <h3 class="mb-3"> Sells Information : </h3>
    <div class="row aa">
      <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3">
        <div class="card text-center">
          <div class="card-header bg-">
            <h4 class="shoping_icon text-danger"><i style="font-size:45px" class="mdi mdi-shopping"></i></h4>
          </div>
          <div class="card-body text-center">
            <h6> Daily Sale</h6>
            <?php
						 $start=date("Y-m-d")." 00:00:00";
						 $End=date("Y-m-d")." 23:59:59";
						 $daily_sell=get_sells($start,$End);
						 ?>
             
            <p class="lead"><?php	echo $daily_sell ?> $ </p>
            <small>last 1 days sale</small>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3">
        <div class="card text-center">
          <div class="card-header bg-">
            <h4 class="shoping_icon text-success"><i style="font-size:45px" class="mdi mdi-shopping"></i></h4>
          </div>
          <div class="card-body text-center">
            <?php
             $start=strtotime(date("Y-m-d"));
             $start=strtotime("-7 day",$start);
             $start=date("Y-m-d",$start);
             $End=date("Y-m-d")." 23:59:59";
             $Weekly_sell=get_sells($start,$End);
             ?>
            <h6>7 days Sale</h6>
            <p class="lead"><?php echo $Weekly_sell ?> $</p>
            <small>last 7 days sale</small>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3">
        <div class="card text-center">
          <div class="card-header bg-">
            <h4 class="shoping_icon text-primary"><i style="font-size:45px" class="mdi mdi-shopping"></i></h4>
          </div>
          <div class="card-body text-center">
            <?php
             $start=strtotime(date("Y-m-d"));
             $start=strtotime("-30 day",$start);
             $start=date("Y-m-d",$start);
             $End=date("Y-m-d")." 23:59:59";
             $monthly_sell=get_sells($start,$End);
             ?>
            <h6>30 days</h6>
            <p class="lead"><?php echo $monthly_sell ?> $</p>
            <small>last 30 days sale</small>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-lg-3 col-xl-3">
        <div class="card text-center">
          <div class="card-header bg-">
            <h4 class="shoping_icon text-warning"><i style="font-size:45px" class="mdi mdi-shopping"></i></h4>
          </div>
          <div class="card-body text-center">
            <?php
             $start=strtotime(date("Y-m-d"));
             $start=strtotime("-30 day",$start);
             $start=date("Y-m-d",$start);
             $End=date("Y-m-d")." 23:59:59";
             $yearly_sell=get_sells($start,$End);
             ?>
            <h6>This-year </h6>
            <p class="lead"><?php echo $yearly_sell ?> $</p>
            <small>last 365 days sale</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 pl-2 p-0">
    <h3 class="mb-3"> Best product : </h3>
    <div class="row">
      <?php
       $best_proudect=get_best_proudect();
       foreach($best_proudect as $data){
        ?>
      <div class="col-4 col-md-4 bst_oregin">
        <div class="card card-bst">
          <img class="image-fluid w-100 bst_img" src="..\media\dish\<?php echo $data['images'] ?>" alt="">
          <div class="card-img-overlay text-dark">
            <div class="text-bst-p align-baseline">
              <p class="bst-txt"><?php echo $data['dish'] ?></p>
              <p><small class="bst-txt">price : <?php echo $data['Price'] ?></small></p>
              <p><small class="mt-1"><span class="count_text_sale">sale :</span> <span class="counter_box"> <?php echo $data['t'] ?></span></small></p>
            </div>
          </div>
        </div>
      </div>
      <?php
      }
        ?>
      <!-- example_box -->
    </div>
  </div>
</div>
<h4 class="mb-2 mt-3"> Best Selling User.</h4>
<div class="row">
  <?php
     $best_user=get_best_seller();
      foreach($best_user as $best_data){ ?>
  <div class="col-md-2 col-sm-4 col-6 mt-2">
    <div class="card sp_user_card">
      <img style="height:" class="w-100 img_user image-fluid" src="..\media\profile\<?php echo $best_data['images'] ?>" alt="best_user">
      <div class="card-img-overlay  text-light">
        <strong><?php echo $best_data['name'] ?></strong><br>
        <small><?php echo $best_data['email'] ?></small>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
</div>
<br>
<div class="card">
  <div class="card-body">
    <div class="row grid_box">
      <div class="col-12">
        <div class="table-responsive">
          <table id="order-listing" class="table">
            <thead>
              <tr>
                <th width="">S.No #</th>
                <th width="">Name/Emai/Mobile</th>
                <th width="">Total price</th>
                <th style="" class="" width="10%">Pamment/Order stats</th>
                <th style="" class="" width="15%">Order Detals</th>
                <th width="">Date</th>
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
                <td id='' class=""><a style="padding:10px !important" class="btn btn-outline-success btn-sm" href="order_detals.php?order_id=<?php echo $row['id'] ?>">Order detals</a></td>
                <td style="width:110px"><?php $datestr=strtotime($row['add_on']);
               echo date('Y-m-d h:m',$datestr);
               ?></td>
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
<script src="assets/js/Chart.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
</body>
</html>
