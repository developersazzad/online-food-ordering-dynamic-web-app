<?php
include('top.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from copone_code where id='$id'");
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update copone_code set stats='$status' where id='$id'");
		redirect('copone_coad.php');
	}
}
$sql="select * from copone_code order by id desc";
$res=mysqli_query($con,$sql);
?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Copone Coad Master</h1>
		   	 			<h4><a href="manage_coponeCoad.php" class="add_link">Add Copone</a></h4>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No</th>
                            <th width="10%">copone</th>
                            <th width="15%">Type</th>
                            <th width="10%">Value</th>
                            <th width="10%">Min Value</th>
                            <th width="15%">Expire On</th>
                            <th width="10%">Add On</th>
                            <th class="text-center align-middle" width="30%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
					          		$i=1;
					          		while($row=mysqli_fetch_assoc($res)){
												?>
						<tr>
              <td><?php echo $i?></td>

              <td><?php echo $row['copone_code']?></td>
              <td><?php echo $row['copone_type']?></td>
              <td><?php echo $row['copone_value']?></td>
              <td><?php echo $row['cart_min_value']?></td>
              <td><?php echo $row['expire_on']?></td>
							<td><?php $strtime=strtotime($row['add_on']);
              echo date('d-m-y',$strtime)?></td>
							<td>
								<a href="manage_coponeCoad.php?id=<?php echo $row['id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
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
								&nbsp;
								<a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger delete_red">Delete</label></a>
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
