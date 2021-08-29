<?php
include('top.php');
$msg="";
$name="";
$mobile="";
$id="";

if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from delevery_boy where id='$id'"));
	$name=$row['name'];
	$mobile=$row['mobile'];
}

if(isset($_POST['submit'])){
	$delevery_boy_name=get_safe_value($_POST['delevery_boy_name']);
	$mobile=get_safe_value($_POST['mobile']);
	$added_on=date('Y-m-d h:i:s');

	if($id==''){
		$sql="select * from delevery_boy where name='$delevery_boy_name'";
	}else{
		$sql="select * from delevery_boy where name='$delevery_boy_name' and id!='$id'";
	}
  $check=mysqli_num_rows(mysqli_query($con,$sql));
	if($check>0){
		$msg="this delevery already added";
	}else{
		if($id==''){
			mysqli_query($con,"INSERT INTO `delevery_boy`(`name`, `mobile`, `stats`) values('$delevery_boy_name','$mobile','1')");
		}else{
			mysqli_query($con,"update delevery_boy set name='$delevery_boy_name', mobile='$mobile' where id='$id'");
		}
		redirect('Delevery_boy.php');
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
                      <label for="exampleInputName1">delevery boy name</label>
                      <input type="text" class="form-control" placeholder="Category" name="delevery_boy_name" required value="<?php echo $name?>">
					  			<div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Order Number</label>
                      <input type="textbox" class="form-control" placeholder="mobile" name="mobile"  value="<?php echo $mobile?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		   </div>
<?php include('footer.php');?>
