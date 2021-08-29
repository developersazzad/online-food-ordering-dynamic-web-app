<?php
include('top.php');

$sql="SELECT `id`, `user_id`, `name`, `email`, `mobile`, `address`, `city`, `zip_code`, `total_price`,`copone_coad`,`final_price`,`gst`, `delevery_boy_id`, `pamment_stats`, `order_stats`, `add_on` FROM `order_master` WHERE 1";
$res=mysqli_query($con,$sql);
?>
<style type="text/css">
td#font_bog {
  font-size: 16px;
}
</style>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Category Master</h1>
		   	 			<h4><a href="manage_category.php" class="add_link">Add Category</a></h4>
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
                            <th style=""class="" width="10%">Pamment/Order stats</th>
                            <th style=""class="" width="15%">Order Detals</th>
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
              <td><p>Name : <?php echo $row['name'] ?></p>
                  <p>Email :<?php echo $row['email'] ?></p>
                  <p>Mobile :<?php echo $row['mobile'] ?></p>
              </td>
							<td><p>City :<?php echo $row['city'] ?></p>
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
               <td><p>Pament :<?php echo $row['pamment_stats'] ?></p>
                 <p>Or:<span class="bg-danger text-light p-1"><?php echo $row['order_stats'] ?></span></p></td>
               <td id='' class=""><a style="padding:10px !important" class="btn btn-outline-success btn-sm" href="order_detals.php?order_id=<?php echo $row['id'] ?>">Order detals</a></td>
               <td style="width:70px"><?php $datestr=strtotime($row['add_on']);
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

<?php include('footer.php');?>
