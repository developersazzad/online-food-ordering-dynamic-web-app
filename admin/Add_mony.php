<?php
include('top.php');
$msg="";
$category="";
$order_number="";
$id="";
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
  $sql=mysqli_query($con,"SELECT `id`, `user_id`, `amount`, `type`, `msg`, `Txn_id`, `add_on` FROM `wallat` WHERE user_id='$id'");
  $check=mysqli_num_rows($sql);
   if($check>0){
   	$row=mysqli_fetch_assoc($sql);
     $ammount=$row['amount'];
     $msg=$row['msg'];
   }

}

if(isset($_POST['submit'])){
	$Mony=get_safe_value($_POST['Mony']);
	$Massages=get_safe_value($_POST['Massages']);
	$added_on=date('Y-m-d h:i:s');
  $type='in';
  $txn_id='007';
   wallat_amount_add_by_custom($Mony,$id,$type,$Massages,$txn_id);
   redirect('user.php');
	}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Total Mony : <?php echo wallat_amount_get($id) ?>$</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Mony</label>
                      <input type="text" class="form-control" placeholder="Mony" name="Mony" required value="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Massages</label>
                      <input type="textbox" class="form-control" placeholder="Massages" name="Massages"  value="">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		      </div>

<?php include('footer.php');?>
