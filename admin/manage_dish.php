<?php
include('top.php');
//========DISH DETAIL TARGET=================//
if(isset($_REQUEST['dish_detail_id'])){
  $delete_id=$_REQUEST['dish_detail_id'];
  // $id=$_REQUEST['id'];
  // $delete_sql=mysqli_query($con,"DELETE FROM `dish_details` WHERE id='$delete_id'");
  // redirect('manage_dish.php?id='.$id);
}

$dish_name='';
$disg_detail='';
$dish_category_id='';
$images='';
$added_on='';
$stats='';
$msg='';
$images_stats="required";
$images_error='';
$id='';
if(isset($_GET['id']) && $_GET['id']>0){
  $images_stats='';
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from dish where id='$id'"));
  $dish_id=$row['id'];
  $dish_name=$row['dish'];
  $disg_detail=$row['dish_detail'];
  $dish_category_id=$row['category_id'];
  $images=$row['images'];
  $added_on=$row['add_on'];
}
if(isset($_POST['submit'])){
	$dish_name=get_safe_value($_POST['dish']);
  $disg_detail=get_safe_value($_POST['dish_detail']);
  $dish_category_id=get_safe_value($_POST['dish_Category']);
	$added_on=date('Y-m-d h:i:s');
  //======images ===================//
  //======images ===================//
  $images=$_FILES['dish_images']['name'];
  $type=$_FILES['dish_images']['type'];
  $images_name_gen=rand(11111,99999).'_proudect';
  //======images ===================//
	if($id==''){
		$sql="select * from dish where dish='$dish_name'";
	}else{
		$sql="select * from dish where dish='$dish_name' and id!='$id'";
	}
  $check=mysqli_num_rows(mysqli_query($con,$sql));
	if($check>0){
		$msg="this delevery already added";
	}else{
		if($id==''){
      if($type!='image/jpeg' && $type!='image/png'){
          $images_error="Images format Invalid";
      }else{
        //======images ===================//
        $images_tmp_name=$_FILES['dish_images']['tmp_name'];
         move_uploaded_file("$images_tmp_name",SERVER_DISH_IMAGES.$images_name_gen.'.jpg');
         //======images ===================//
         mysqli_query($con,"INSERT INTO `dish`(`category_id`, `dish`, `dish_detail`,`images`,`stats`,`add_on`) values('$dish_category_id','$dish_name','$disg_detail','$images_name_gen.jpg','1','$added_on')");
       		redirect('dish.php');
      }
		}else{
     if($images!=''){
        if($type!='image/jpeg' && $type!='image/png' ){
          $images_error="Images format Invalid";
      }else{
        //============IMAGES DELETE====================//
          $Old_img_call=mysqli_fetch_assoc(mysqli_query($con,"select images from dish where id='$id'"));
          $images_delete=unlink(SERVER_DISH_IMAGES.$Old_img_call['images']);
          //============IMAGES DELETE====================//
         $images_tmp_name=$_FILES['dish_images']['tmp_name'];
        move_uploaded_file("$images_tmp_name",SERVER_DISH_IMAGES.$images_name_gen.'.jpg');
        mysqli_query($con,"update dish set dish='$dish_name',dish_detail='$disg_detail',category_id='$dish_category_id',stats='1',images='$images_name_gen.jpg',add_on='$added_on' where id='$id'");
        		redirect('dish.php');
       }
     }else{
      mysqli_query($con,"update dish set dish='$dish_name',dish_detail='$disg_detail',category_id='$dish_category_id',stats='1',add_on='$added_on' where id='$id'");

      //attribute indixing data NEW=========//
          $dish_detals_stats=$_POST['dish_detals_stats'];
           $AttributeArr=$_POST['Attribute'];
           $PriceArr=$_POST['price'];
           $dish_detail_update_or_not_Arr=$_POST["dish_details_id_sp"];
           // prx($dish_detail_update_or_not_Arr);
           foreach($AttributeArr as $key=>$value){
             $attribute=$value;
             $status=$dish_detals_stats[$key];

             $price=$PriceArr[$key];
             if(isset($dish_detail_update_or_not_Arr[$key])){
               $dish_sp_difine_id=$dish_detail_update_or_not_Arr[$key];
             $sql=mysqli_query($con,"UPDATE `dish_details` SET `dish_id`='$dish_id',`Attribute`='$attribute',`Price`='$price',`status`='$status',`date`='$added_on' WHERE id='$dish_sp_difine_id'");
             }else{
                $sql=mysqli_query($con,"INSERT INTO `dish_details`(`dish_id`, `Attribute`, `Price`,`status`,`date`) VALUES ('$dish_id','$attribute','$price','$status','$added_on')");
             }
        }
    //attribute indixing data=========//
      redirect('dish.php');
       }
      }
		}
	}
?>
<style media="screen">
  .form-control{
    color:black !important;
  }
</style>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Dish</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Dish Name</label>
                      <input type="text" class="form-control" placeholder="Dish Name" name="dish" required value="<?php echo $dish_name ?>">
					  		    	<div class="error mt8"><?php echo $msg?></div>
                    </div>
                     <div class="form-group">
                       <label for="exampleInputEmail3" required>Dish Details</label>
                       <input type="textbox" class="form-control" placeholder="detals" name="dish_detail"  value="<?php echo $disg_detail ?>">
                     </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3" required>Category</label>
                        <select class="form-control select" name="dish_Category">
                          <?php
                          $category_sql=mysqli_query($con,"select * from category WHERE 1");
                          while($data=mysqli_fetch_assoc($category_sql)){
                            if($dish_category_id==$data['id']){?>
                               <option selected value="<?php echo $data['id'] ?>"><?php echo $data['category_name'] ?></option>
                           <?php }else{ ?>
                              <option value="<?php echo $data['id'] ?>"><?php echo $data['category_name'] ?></option>
                          <?php }
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3" required>Dish images</label>
                        <input type="file" class="form-control"  name="dish_images" value="<?php echo $images ?>" <?php echo $images_stats ?>>
                        <div class="error mt8"><?php echo $images_error?></div>
                      </div>
                      <!-- start attribute box -->
                      <div class="form-group" id="attr_box">
                        <label for="exampleInputEmail3" required>Dish Attribute</label>
                 <?php
                   if($id!=''){
                     $dish_id_sp=$dish_id;
                      $attr_sql=mysqli_query($con,"SELECT `id`, `dish_id`, `Attribute`, `Price`, `status`, `date` FROM `dish_details` WHERE  dish_id='$dish_id_sp'");
                      $i=1;
                      while($dish_data=mysqli_fetch_assoc($attr_sql)){
                       ?>
                        <div id="dish_box1">
                          <div class="row" id="sp_box" >
                            <div class="col-4 mt-3">
                              <input type="hidden" name="dish_details_id_sp[]" value="<?php echo $dish_data['id'] ?>">
                              <input type="textbox" name="Attribute[]" class="form-control" placeholder="Attribute" value="<?php echo $dish_data['Attribute'] ?>">
                            </div>
                            <div class="col-3 mt-3">
                              <input type="textbox" name="price[]" class="form-control" placeholder="price" value="<?php echo $dish_data['Price'] ?>">
                            </div>
                            <div class="col-3 mt-3">
                              <select class="form-control" name="dish_detals_stats[]">
                                    <?php
                                    if($dish_data['status'] ==1){?>
                                        <option value="1" selected>Active</option>
                                        <option value="0" >Deactive</option>
                                  <?php }elseif($dish_data['status']==0){?>
                                      <option value="0" selected>Deactive</option>
                                      <option value="1" >Active</option>
                                  <?php } ?>
                              </select>
                            </div>
                                <?php if($i!=1){?>
                            <div class="col-2 mt-3">
                             <button type='button' class='btn btn-danger mr-2' name='remove_attr' onclick=remove_more_new("<?php echo $dish_data['id'] ?>")>Remove</button>
                            </div>
                          <?php }?>
                          </div>
                        </div>
                      <?php
                      $i++;
                          }}
                           ?>
                      </div>
                          <!-- end attribute box -->
                    </div>
                     <div class="row">
                       <div class="col-3">
                         <button type="submit" class="ml-5 mb-4 btn btn-primary mr-2" name="submit">Submit</button>
                       </div>
                      <?php
                      if($id!=''){ ?>
                        <div class="col-3">
                          <button type="button" class="mb-4 btn btn-success mr-2" name="submit" onclick="Add_more()">Add-More</button>
                        </div>
                     <?php  }
                       ?>
                       <div class="col-6"></div>
                     </div>
                  </form>
                </div>
              </div>
            </div>
		   </div>
       <input type="hidden" id="add_more" name="" value="1">
       <script>
       function Add_more(){
         var add_more=jQuery("#add_more").val();
         add_more++;
         jQuery('#add_more').val(add_more);
         //more defecult javascript function//=======//

         var data= "<div class='row' id='sp_box"+add_more+"'><div class='col-4 mt-3'><input type='textbox' name='Attribute[]' class='form-control' placeholder='Attribute'></div><div class='col-3 mt-3'><input type='textbox' name='price[]' class='form-control' placeholder='price'></div><div class='col-3 mt-3'><select class='form-control' name='dish_detals_stats[]'><option value='1'>Active</option><option value='0'>Deactive</option></select></div><div class='col-2 mt-3'><button type='button' class='btn btn-danger mr-2' onclick='remove_more("+add_more+")'>remove</button></div> </div>";
         jQuery('#sp_box').addClass(add_more);
          var dish_box=jQuery("#dish_box1").html();
          jQuery('#attr_box').append(data);
       }
       function remove_more(id){
        jQuery("#sp_box"+id).remove();
       }

       function remove_more_new(id){
         var result=confirm('Are You sure..?');
         if(result==true){
           jQuery.ajax({
             url:'manage_desh_delete.php',
             type:'post',
             data:"delete_id="+id,
             success:function(result){
               window.location.href=window.location.href;
                alert(result);
             }
           })
           // var carrent_path=window.location.href;
           // window.location.href=carrent_path+"&dish_detail_id="+id;
         }
       }
       </script>
<?php include('footer.php');?>
