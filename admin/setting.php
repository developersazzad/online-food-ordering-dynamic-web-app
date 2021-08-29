<?php
include('top.php');
if(isset($_GET['type'])){
  $type=$_GET['type'];
  if($type=='deactive'){
    $sql=mysqli_query($con,"UPDATE `setting` SET `website_stats`= '1' WHERE id='1'");
  }
}
//==========other=-=======//
if(isset($_GET['type'])){
  $type=$_GET['type'];
  if($type=='active'){
    $sql=mysqli_query($con,"UPDATE `setting` SET `website_stats`='0' WHERE id='1'");
  }
}
//======================================================================//

$sql="SELECT * FROM `setting` WHERE 1";
$res=mysqli_query($con,$sql);
?>
<div class="card">
  <div class="card-body">
    <h1 class="grid_title">Website Setting</h1>
    <div class="row grid_box">
      <div class="col-12">
        <div class="table-responsive">
          <table id="order-listing" class="table">
            <thead>
              <tr>
                <th>Website Oner</th>
                <th class="text-center align-middle">Cart Min Value</th>
                <th class="text-center align-middle">Wallat Ammount</th>
                <th class="text-center align-middle">website cloges msg</th>
                <th class="text-center align-middle">Website Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(mysqli_num_rows($res)>0){
                $row=mysqli_fetch_assoc($res);
								?>
            <center><tr>
                <td class="text-center"><img style="width:120px;height:100px;border-radius:0px;border:4px solid gray" class=" image-fluid" src="..\media\profile\1588.jpg" alt=""></td>
                <td class="text-center"><?php echo $row['cart_min_value']?> $</td>
                <td class="text-center"><?php echo $row['wallat_amount']?> $</td>
                <td class="text-center"><?php echo $row['website_off_msg']?></td>
                <td class="text-center">
                  <a href="manages_setting.php"><label class="badge badge-success">Changes</label></a>&nbsp;
                  <?php
								if($row['website_stats']==0){
								?>
                  <a href="?type=deactive"><label class="badge badge-danger">Website Open Now</label></a>
                  <?php
								}elseif($row['website_stats']==1){
								?>
                  <a href="?type=active"><label class="badge badge-info">Website Closed Now</label></a>
                  <?php
								}}
								?>
                </td>
              </tr></center>
              <tr>
                <td colspan="5">No data found</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php');?>
