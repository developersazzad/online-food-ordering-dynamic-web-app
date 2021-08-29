<?php
include('top.php');
$copone_code='';
$copone_type='';
$copone_value='';
$cart_min_value='';
$expire_on='';
$stats='';
$msg='';
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from copone_code where id='$id'"));
  $copone_code=$row['copone_code'];
  $copone_type=$row['copone_type'];
  $copone_value=$row['copone_value'];
  $cart_min_value=$row['cart_min_value'];
  $expire_on=$row['expire_on'];
  $stats=$row['stats'];
  $date=$row['add_on'];
}

if(isset($_POST['submit'])){
  $copone_name=get_safe_value($_POST['copone_coad']);
  $copone_type=get_safe_value($_POST['copone_type']);
  $copone_value=get_safe_value($_POST['copone_value']);
  $min_value=get_safe_value($_POST['min_value']);
  $copone_expire_date=get_safe_value($_POST['date_sp']);
	$added_on=date('Y-m-d h:i:s');
	if($id==''){
		$sql="select * from copone_code where copone_code='$copone_name'";
	}else{
		$sql="select * from copone_code where copone_code='$copone_name' and id!='$id'";
	}
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="This copone coad already added";
	}else{
		if($id==''){
			mysqli_query($con,"INSERT INTO `copone_code`(`copone_code`, `copone_type`, `copone_value`, `cart_min_value`, `expire_on`, `stats`, `add_on`) values('$copone_name','$copone_type','$copone_value','$min_value','$copone_expire_date','1','$added_on')");
		}else{
			mysqli_query($con,"update copone_code set copone_code='$copone_name',
      copone_type='$copone_type',copone_value='$copone_value',cart_min_value='$min_value',expire_on='$copone_expire_date', stats='1',add_on='$date' where id='$id'");
		}
		redirect('copone_coad.php');
	}
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Copone Coad</label>
                      <input type="text" class="form-control" placeholder="Coad" name="copone_coad" required value="<?php echo $copone_code?>">
					  		  	<div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Copone Type</label>
                      <select class="form-control select" name="copone_type">
                      <?php
                      $arr=array('P'=>'Percentage','F'=>'Fixed','M'=>'mixed');
                      foreach($arr as $key=>$val){
                        if($key==$copone_type){
                            echo " <option style='color:black' value=".$key." selected>".$val."</option>";
                        }else{
                            echo " <option style='color:black' value=".$key.">".$val."</option>";
                        }

                      }
                       ?>
                     </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Copone Min Value</label>
                      <input type="text" class="form-control" placeholder="min value" name="min_value" required value="<?php echo  $cart_min_value?>">

                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Copone Value</label>
                      <input type="text" class="form-control" placeholder="copone_value" name="copone_value" required value="<?php echo $copone_value?>">

                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Expire Date</label>
                      <input type="date" class="form-control"  name="date_sp"  value="<?php echo $expire_on?>">

                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		 </div>

<?php include('footer.php');?>
