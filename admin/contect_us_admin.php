<?php
include('top.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from contect_us where id='$id'");
	}
}

$sql="SELECT `id`, `name`,`mobile`,`email`, `subject`, `message`, `date` FROM `contect_us` WHERE 1";
$res=mysqli_query($con,$sql);
?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Contect Master</h1>
              <div class="row grid_box">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">S.No #</th>
														<th width="15%">Name</th>
                            <th width="15%">mobile</th>
                            <th width="20%">Email</th>
                            <th width="20%">Subject</th>
                            <th width="30%">Messages</th>
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
							<td><?php echo $row['name']?></td>
              <td><?php echo $row['mobile']?></td>
              <td><?php echo $row['email']?></td>
              <td><?php echo $row['subject']?></td>
							<td style="width:30% !importent"><?php echo $row['message']?></td>
              <td><?php echo $row['date']?></td>
							<td>
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
