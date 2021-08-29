<?php
include('top.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
  if($type=='delete'){
    mysqli_query($con,"DELETE FROM `dish` WHERE id='$id'");
  }
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update dish set stats='$status' where id='$id'");
	}
}
 $sql="SELECT dish.*,category.category_name FROM dish,category WHERE dish.category_id=category.id order by dish.id desc";
$res=mysqli_query($con,$sql);
?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Delevery Boy </h1>
             <h4><a href="manage_dish.php" class="add_link">Add Dish</a></h4>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No #</th>
                            <th width="15%">Dish Name</th>
                            <th width="15%">Dish Category</th>
                            <th width="15%">Images</th>
                            <th width="10%">Date</th>
                            <th width="25%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
					          		$i=1;
					          		while($row=mysqli_fetch_assoc($res)){
												?>
						<tr>
              <td><?php echo $i?></td>
              <td><?php echo $row['dish']?></td>
              <td><?php echo $row['category_name']?></td>
              <td><a target="_blank" href="../media/dish/<?php echo $row['images']?>">
                <img style="width:120px;height:100px" src="../media/dish/<?php echo $row['images']?>" alt="">
              </a></td>
              <td><?php $strtime=strtotime($row['add_on']);
              echo date('d-m-y',$strtime)?></td>
							<td>
             	<a href="manage_dish.php?id=<?php echo $row['id']?>"><label class="badge badge-info">edit</label></a>
              <a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-warning">Delete</label></a>
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
