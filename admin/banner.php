<?php
include('top.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from index_banner where id='$id'");
		redirect('banner.php');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update index_banner set stats='$status' where id='$id'");
		redirect('banner.php');
	}
}
//======Select Sql================//
$sql="SELECT `id`, `heading`, `sub_heading`, `images`, `link`, `link_text`, `order_number`, `stats`, `addad_on` FROM `index_banner` WHERE 1";
$res=mysqli_query($con,$sql);
?>

<style type="text/css">
img.unstyled {
    width: 140px !important;
    height: 80px !important;
    border-radius: 1px !important;
    border: 3px solid #bac3c3;
}
</style>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Banner Master</h1>
		   	 			<h4><a href="manage_banner.php" class="add_link">Add Banner</a></h4>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="10%">S.No #</th>
                            <th width="20%">Heading</th>
                            <th width="20%">Sub heading</th>
                            <th width="20%">images</th>
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
              <td><?php echo $row['heading']?></td>
              <td style="width:110px;height:110px"><?php echo $row['sub_heading']?></td>
							<td><img class="unstyled" style="" src="../media/banner/<?php echo $row['images']?>" alt=""></td>
						 	<td style="width:25%">
								<a href="manage_banner.php?id=<?php echo $row['id']?>"><label class="badge badge-success">Edit</label></a>&nbsp;
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
