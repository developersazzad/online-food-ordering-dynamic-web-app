<?php
include('top.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update user set stats='$status' where id='$id'");
		redirect('user.php');
	}

}
$sql="select * from user order by id desc";
$res=mysqli_query($con,$sql);
?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">User Master</h1>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="10%">S.No #</th>
                            <th width="20%">User</th>
                            <th width="15%">Email</th>
                            <th width="15%">Mobile</th>
														<th width="15%">Date</th>
                            <th style="width:200px" width="10%">Wallat</th>
														<th width="30%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
					          		$i=1;
					          		while($row=mysqli_fetch_assoc($res)){
												?>
						<tr>
              <td><?php echo $i?></td>
              <td><?php echo $row['name']?></td>
              <td><?php echo $row['email']?></td>
              <td><?php echo $row['mobile']?></td>
              <td><?php $strtime=strtotime($row['add_on']);
              echo date('d-m-y',$strtime)?></td>
							<td >
								<?php
								$user_id=$row['id'];
								echo $wallat=wallat_amount_get($user_id);
								 ?> $
							</td>
							<td>
								<?php
								if($row['stats']==1){
								?>
								<a href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-danger">Active</label></a>
								<?php
								}else{
								?>
								<a href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-info">Deactive</label></a>
								<?php
								}
								?>
							 <a href="Add_mony.php?id=<?php echo $row['id']?>"><label class="badge badge-success">Add mony</label></a>
							</td>
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
