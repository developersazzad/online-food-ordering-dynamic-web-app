<?php
include('top.php');
$wallat_amt="";
if(isset($_POST['submit'])){
	$cart_min_value_form=get_safe_value($_POST['cart_min_value']);
	$website_off_msg_form=get_safe_value($_POST['website_off_msg']);
	$wallat_amount=get_safe_value($_POST['wallat_amt']);
	$added_on=date('Y-m-d h:i:s');
			mysqli_query($con,"UPDATE `setting` SET `website_off_msg`='$website_off_msg_form',`cart_min_value`='$cart_min_value_form',`wallat_amount`='$wallat_amount',`date`='$added_on' WHERE id='1'");
     	redirect('setting.php');
		}
$row=mysqli_fetch_assoc(mysqli_query($con,"SELECT `id`, `website_stats`, `website_off_msg`, `cart_min_value` , `wallat_amount`, `date` FROM `setting` WHERE id='1'"));
$website_off_msg=$row['website_off_msg'];
$cart_min_value=$row['cart_min_value'];
$wallat_amt=$row['wallat_amount'];
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Website Setting</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Cart Min Value</label>
                      <input type="text" class="form-control" placeholder="cart min value" name="cart_min_value" required value="<?php echo $cart_min_value?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Order Number</label>
                      <textarea class="form-control" name="website_off_msg" rows="5" cols="50" ><?php echo $website_off_msg ?></textarea>
                    </div>
										<div class="form-group">
											<label for="exampleInputName1">Wallat ammount gift</label>
											<input type="text" class="form-control" placeholder="wallat ammount" name="wallat_amt"  value="<?php echo $wallat_amt?>">
										</div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		 </div>

<?php include('footer.php');?>
