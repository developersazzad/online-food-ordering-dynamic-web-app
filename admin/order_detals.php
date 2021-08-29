<?php
include('top.php');
if(isset($_REQUEST['order_id'])){
  $order_id=$_REQUEST['order_id'];
}else{
  redirect('order.php');
}
if(isset($_REQUEST['submit_data'])){
  $ordert_stats_update=$_REQUEST['order_stats_upadte'];
  $delevery_boy_id=$_REQUEST['delevery_boy_name'];
  $date=date("Y-m-d h:i:s");
  if($ordert_stats_update=="cancel"){
    $sql_up_usr_master=mysqli_query($con,"UPDATE `order_master` SET `order_stats`='$ordert_stats_update',cancel_date='$date',cancel_at='Admin',delevery_boy_id='$delevery_boy_id' WHERE id='$order_id'");
    redirect('order.php');
  }else{
    $sql_up_usr_master=mysqli_query($con,"UPDATE `order_master` SET `order_stats`='$ordert_stats_update',delevery_boy_id='$delevery_boy_id' WHERE id='$order_id'");
    redirect('order.php');
  }

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
                                <td style="width:70px"><img style="width:70px;height:60px" src="../media/dish/<?php echo $row['images']?>" alt=""></td>
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
                    <form class="form" method="post">
                       <div class="container">
                         <div class="row mt-5 mb-3">
                           <div class="col-md-4 col-8">
                             <h3> Order stats -  </h3>
                             <select class="select form-control" name="order_stats_upadte">
                           <?php
                            $sql_select=mysqli_query($con,"SELECT `id`, `order_stats` FROM `order_stats` WHERE 1");
                            while($data=mysqli_fetch_assoc($sql_select)){
                              if($order_stats== $data['order_stats']){?>
                                <option selected value="<?php echo $data['order_stats'] ?>"><?php echo $data['order_stats'] ?></option>
                             <?php }else{ ?>
                                <option value="<?php echo $data['order_stats'] ?>"><?php echo $data['order_stats'] ?></option>
                           <?php  }
                            }
                            ?>
                             </select>
                           </div>
                           <div class="col-md-4 col-8">
                               <h3> delevery boy name -  </h3>
                             <select class="select form-control" name="delevery_boy_name">
                           <?php
                            $sql_select=mysqli_query($con,"SELECT `id`, `name`, `mobile`, `password`, `stats`, `add_on` FROM `delevery_boy` WHERE 1");
                            while($data=mysqli_fetch_assoc($sql_select)){
                              if($delevery_boy == $data['id']){?>
                                <option selected value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                             <?php }else{?>
                                <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                           <?php  }
                            }
                            ?>
                             </select>
                           </div>
                             <div class="col-md-4 col-4">
                               <p class="mb-3"></p>
                               <input type="submit" class="mt-4 btn btn-primary" name="submit_data" value="confrom">
                             </div>
                         </div>
                         <div class="row">
                           <div class="col-12">
                             <a href="../invoice_downlode.php?order_id=<?php echo $order_id ?>&rand_id=<?php echo $user_order_id ?>"  class="btn btn-danger "><i class="mdi-file-pdf mdi"></i> inVoice </a>
                           </div>
                         </div>
                       </div>
                    </form>
                    <div class="m-5 p-5"></div>
                  </div>
				        </div>
              </div>
            </div>
          </div>

<?php include('footer.php');?>
