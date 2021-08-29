<?php
include('header.php');
$sort_get_data='';
$sort_data_init=array();
$sort_data_implode='';
$search_value="";
if(isset($_GET['search_value'])){
  $search_value=$_GET['search_value'];
}
if(isset($_REQUEST['sort_data_res'])){
  $sort_get_data=$_REQUEST['sort_data_res'];
  $sort_data_init=array_filter(explode(':',$sort_get_data));
  $sort_data_implode=implode(",",$sort_data_init);
}
$sart_data='';
$er_msg='';
$sort_id='';
//collect catigory==============//
  $category_sql=mysqli_query($con,"SELECT `id`, `category_name`, `order_number`, `stats`, `add_on` FROM `category` WHERE 1");
//collect proudect==============//
  $sql="SELECT `id`, `category_id`, `dish`, `dish_detail`, `images`, `stats`, `add_on` FROM `dish` WHERE stats = 1 ";
if($sort_data_implode!=''){
  $sql.="and category_id in ($sort_data_implode) order by dish.id desc ";
}elseif($search_value!=''){
  $sql.=" and  dish LIKE '%$search_value%' or `dish_detail` LIKE '%$search_value%'";
}else{
    $sql.="order by dish.id desc";
}
$proudect_sql=mysqli_query($con,$sql);
$check=mysqli_num_rows($proudect_sql);
 ?>
<style type="text/css">
     .select_opt_qty {
    box-shadow: 0px 0 4px 2px #c5c5c5;
    width: 45%;
    height: 28px;
    /* border: 1px solid #818181; */
    margin-right: 10px;
    margin-left: 4px;
    margin-bottom: 10px;
    padding: 3px;
    background: whitesmoke;
    border-radius: 4px;
    }

  .box_res_select {
    font-size: 16px;
    font-weight: 700;
  }

  a.cart_ancor i {
    color: #f42a33;
    font-size: 23px;
    text-align: center;
    margin-left: 4px;
    transition: all .3s;
    padding: 8px 8px;
    border-radius: 50%;
    background: #eaeaea;
    box-shadow: 0 0px 5px 0px #666666, -1px 0px 11px 0px #666666;
    transition: .4s ease;
  }

  a.cart_ancor :hover {
    background: #ffffff;
    transform: scale(1.1);
  }

  p.box_res_select.mt-2 {
    margin-bottom: 0px;
  }

  .cart_add_text {
    font-size: 12px;
    color: #f42a33;
    font-weight: 700;

  }

  button.btn.btn-danger.my-2.my-sm-0 {
    /* padding: 17px; */
    text-align: center;
    height: 43px;
    width: 100px;
    border-radius: 6px;
  }

  .search_box.mb-3.align-right {
    justify-content: flex-end;
    display: flex;
  }

  from.form-inline.my-2.mx-1.my-lg-0 {
    display: flex;
    justify-content: flex-end;
  }
</style>
<div class="breadcrumb-area gray-bg">
  <div class="container">
    <div class="breadcrumb-content">
      <ul>
        <li><a href="shop.php">Home</a></li>
        <li class="active">Shop Grid Style </li>
      </ul>
    </div>
  </div>
</div>
<?php if($web_status=='1'){ ?>
<strong>
  <marquee style="font-size:30px;color: #e02c2b;"><?php echo $web_off_msg?></marquee>
</strong>
<?php } ?>
<div class="shop-page-area pt-100 pb-100">
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-lg-9">
        <div class="banner-area pb-30">
          <a href="product_details.php"><img alt="" src="assets/img/banner/banner-49.jpg"></a>
        </div>
        <div class="search_box mb-3 align-right">
          <from class="form-inline my-2 mx-1 my-lg-0" method="post">
            <input id="search_input" placeholder="search" type="search" class="w-50 w-md-100 form-control mr-sm-2">
            <button type="submit" onclick="search_val()" class="w-25 mx-2 w-md-100 btn btn-danger my-2 my-sm-0">search</button>
          </from>
        </div>
        <div class="grid-list-product-wrapper">
          <div class="product-grid product-view pb-20">
            <div class="row">
              <?php
              if($check>0){
                $ii=1;
                  while($proudect_data=mysqli_fetch_assoc($proudect_sql)){
                    $dish_sp_id=$proudect_data['id'];
                    $category_id=$proudect_data['category_id'];
                    ?>
              <div class="product-width  col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                <div class="box_sp border m-1 p-2 ">
                  <div class="product-wrapper">
                    <div class="product-img">
                      <a href="javascript:void(0)">
                        <img src="media/dish/<?php echo $proudect_data['images'] ?>" alt="">
                      </a>
                    </div>
                    <div class="product-content">
                      <h4 class="weight_1">
                        <?php
                            if($ii%2==0){ ?>
                        <a href="javascript:void(0)"><i class="fa text-danger fa-share-square-o"></i>
                          <?php  }else{ ?>
                          <a href="javascript:void(0)"><i class="fa text-info fa-share-square-o"></i>
                            <?php   }
                             ?>
                            <?php echo $proudect_data['dish'];
                            $sql=mysqli_query($con,"SELECT `id` FROM `dish_details` WHERE dish_id='$dish_sp_id' and status=1 ");
                            $data_attr=mysqli_fetch_assoc($sql);
                             $data_id=$data_attr['id'];
                             $CartArr=GetAllCartData();
                             $cart_msg='';
                              if(array_key_exists($data_id,$CartArr)){
                                $cart_qty=GetAllCartData($data_id);
                                $cart_msg='Added-'.$cart_qty;?>
                            <span class='cart_add_text'>(<?php echo $cart_msg ?>)</span>
                            <?php   }else { ?>
                            <span id="attr_<?php echo $dish_sp_id ?>" class='cart_add_text'><?php echo $cart_msg ?></span>
                            <?php  }?>
                          </a>
                      </h4>
                      <div class="product-price-wrapper">
                        <span><?php echo $proudect_data['dish_detail'] ?></span>
                      </div>
                      <?php if($web_status=='0'){ ?>
                      <div class="box_content m-2">
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <!-- start_rating -->
                        <label class="p-1  text-dark"><strong>Rating : </strong>
                          <!-- one_ster -->
                          <?php $rating_sp=get_total_rating($dish_sp_id) ?>
                          <?php if($rating_sp==1){
                            ?>
                          <i class="text-danger fa fa-star"></i>
                          <!-- blank -->
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <?php }elseif($rating_sp==0){ ?>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <?php } ?>
                          <!-- tow_ster -->
                          <?php if($rating_sp==2){ ?>
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <!-- blank -->
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <?php }elseif($rating_sp!=0 && $rating_sp!=3 && $rating_sp!=4 && $rating_sp!=5 && $rating_sp!=6 && $rating_sp!=7 && $rating_sp!=8 && $rating_sp!=9 && $rating_sp!=10){ ?>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <?php } ?>
                          <!-- three_ster -->
                          <?php if($rating_sp==3){
                               ?>
                          <i class="text-danger fa fa-star"></i>
                          <!-- blank -->
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <i class="fa text-danger fa-star-o"></i>
                          <i class="fa text-danger fa-star-o"></i>

                          <?php }elseif($rating_sp!=0 &&$rating_sp!=4 && $rating_sp!=5 && $rating_sp!=6 && $rating_sp!=7 && $rating_sp!=8 && $rating_sp!=9 && $rating_sp!=10){ ?>
                          <i class="fa fa-star-o"></i>
                          <i class="fa fa-star-o"></i>
                          </span>
                          <?php } ?>
                          <!-- four_ster -->
                          <?php if($rating_sp==4){
                               ?>
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <!-- blank -->
                          <i class="fa text-danger fa-star-o"></i>
                          <?php }elseif( $rating_sp!=0 && $rating_sp!=5 && $rating_sp!=6 && $rating_sp!=7 && $rating_sp!=8 && $rating_sp!=9 && $rating_sp!=10){ ?>
                          <i class="text-danger fa fa-star-o"></i>
                          <?php } ?>
                          <!-- five_ster -->
                          <?php if($rating_sp>=5){
                              ?>
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <i class="text-danger fa fa-star"></i>
                          <?php }?>
                        </label>
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <!-- end_rating -->
                        <p class="box_res_select mt-2">Price - </p>
                        <div class="row  p-1 pt-0">
                          <?php
                            $sql=mysqli_query($con,"SELECT `id`, `dish_id`, `Attribute`, `Price`,status, `date` FROM `dish_details` WHERE dish_id='$dish_sp_id' and status=1 order by Price desc");
                            $iii=1;
                            while($data_attr=mysqli_fetch_assoc($sql)){ ?>
                          <div class="col-md-6 p-1">
                            <div class="proudect_warper">
                              <input name="attr_<?php echo $proudect_data['id'] ?>" value="<?php echo $data_attr['id']  ?>" id='attr_radio' class="attr_radio" type="radio">
                              <span class="box_res"><?php echo $data_attr['Attribute'] ?> : <?php echo $data_attr['Price']?>$</span>
                            </div>
                          </div>
                          <?php
                            $iii++;
                            }
                            ?>
                        </div>
                      </div>
                      <div class="product-wrapper ">
                        <span class="box_res_select">Qty : </span>
                        <select class="select_opt_qty" name="selectOpt" id='qty_<?php echo $proudect_data['id']?>'>
                          <?php
                            for($i=1;$i<=10;$i++){ ?>
                          <option><?php echo $i ?></option>
                          <?php }
                             ?>
                        </select>
                        <span><a class="cart_ancor" href="javascript:void(0)" onclick=add_to_cart('<?php echo $dish_sp_id ?>','add')><i class="fa fa-shopping-cart"></i></a></span>
                      </div>
                      <?php }else{
                        echo "<strong style='color:#e02c2b'>today our website closed.</strong>";
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              $ii++;
             }
            }else{
                $er_msg="<h3>Data not found.</h3>";
              }  ?>
              <h4><?php echo $er_msg ?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
          <div class="shop-widget">
            <h4 class="shop-sidebar-title">Shop By Categories</h4>
            <div class="shop-catigory">
              <ul id="faq">
                <?php
                  $at_cls='';
                  if(isset($_REQUEST['All'])=='done'){
                    $at_cls='selected_category';
                  }
                   ?>
                <li><a class="<?php echo $at_cls ?>" href="shop.php">All Proudect</a></li>
                <?php
                  while($data=mysqli_fetch_assoc($category_sql)){
                    $class='';
                    if($sort_id==$data['id']){
                      $class='selected_category';
                    }
                    $is_checkd='';
                    if(in_array($data['id'],$sort_data_init)){
                      $is_checkd="checked='checked'";
                    }
                    ?>
                <li><input <?php echo $is_checkd ?> class="checkbos_category" name='cartArr[]' value="<?php echo $data['id'] ?>" type="checkbox" class="form-control" onclick=set_checkbox('<?php echo $data['id'] ?>')>
                  <?php echo $data['category_name'] ?>
                </li>
                <?php  }
                   ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form method="get" id="form_sort_data">
  <input type="hidden" name="sort_data_res" value="<?php echo $sort_get_data ?>" id="sort_data_res">
</form>
<script>
function search_val(){
  var search_val=$('#search_input').val();
  window.location.href="shop.php?search_value="+search_val;
}
  function set_checkbox(id) {
    var sort_data = jQuery('#sort_data_res').val();
    var check = sort_data.search(":" + id);
    if (check != '-1') {
      sort_data = sort_data.replace(":" + id, '');
    } else {
      sort_data = sort_data + ":" + id;
    }

    jQuery('#sort_data_res').val(sort_data);
    jQuery('#form_sort_data')[0].submit();
  }
</script>
</script>
<?php
include('footer.php');
 ?>
