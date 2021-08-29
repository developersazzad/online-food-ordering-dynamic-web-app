<?php
include('top.php');
$msg="";
$heading='';
$sub_heading='';
$link='';
$link_text='';
$order_number='';
$id='';
$error_img_msg='';
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"SELECT `id`, `heading`, `sub_heading`, `images`, `link`, `link_text`, `order_number`, `stats`, `addad_on` FROM `index_banner` WHERE id='$id'"));
	$heading=$row['heading'];
  $sub_heading=$row['sub_heading'];
  $link=$row['link'];
  $link_text=$row['link_text'];
	$order_number=$row['order_number'];
}

if(isset($_POST['submit'])){
	$heading=get_safe_value($_POST['heading']);
  $sub_heading=get_safe_value($_POST['sub_heading']);
  $link=get_safe_value($_POST['link']);
  $link_text=get_safe_value($_POST['link_text']);
	$order_number=get_safe_value($_POST['order_number']);
  $images=$_FILES['banner_images']['name'];
  $type=$_FILES['banner_images']['type'];

	$added_on=date('Y-m-d h:i:s');
	if($id==''){
		$sql="select * from index_banner where heading='$heading'";
	}else{
		$sql="select * from index_banner where heading='$heading' and id!='$id'";
	}
  //=======Other Logic=========//
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Category already added";
	}else{
		if($id!=''){
       if($images!=''){
          if($type!='image/jpeg' && $type!='image/png'){
            $error_img_msg="Images Formet Invalid.";
          }else{
            $images_name_gen=rand(11111,99999).'_proudect';
            $images_tmp_name=$_FILES['banner_images']['tmp_name'];
             move_uploaded_file("$images_tmp_name",SERVER_BANNER_IMAGES.$images_name_gen.'.jpg');
             mysqli_query($con,"UPDATE `index_banner` SET `heading`='$heading',`sub_heading`='$sub_heading',`images`='$images_name_gen.jpg',`link`='$link',`link_text`='$link_text',`order_number`='$order_number',`stats`='0',`addad_on`='$added_on' WHERE id='$id'");
            redirect('banner.php');
           }
       }else{
         mysqli_query($con,"UPDATE `index_banner` SET `heading`='$heading',`sub_heading`='$sub_heading',`link`='$link',`link_text`='$link_text',`order_number`='$order_number',`stats`='0',`addad_on`='$added_on' WHERE id='$id'");
         redirect('banner.php');
       }

		}else{
      //======images ===================//
       if($type!='image/jpeg' && $type!='image/png'){
         $error_img_msg="Images Formet Invalid.";
       }else{
         $images_name_gen=rand(11111,99999).'_proudect';
         $images_tmp_name=$_FILES['banner_images']['tmp_name'];
          move_uploaded_file("$images_tmp_name",SERVER_BANNER_IMAGES.$images_name_gen.'.jpg');
          //======Insert sql===========//
        	$sql=mysqli_query($con,"INSERT INTO `index_banner`(`heading`, `sub_heading`, `images`, `link`, `link_text`, `order_number`, `stats`, `addad_on`) VALUES ('$heading','$sub_heading','$images_name_gen.jpg','$link','$link_text','$order_number','0','$added_on')");
        redirect('banner.php');
       }
      //======images ===================//
		}
	}
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Big Heading</label>
                      <input type="text" class="form-control" placeholder="Heading" name="heading" required value="<?php echo $heading?>">
					  		    	<div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                     <label for="exampleInputEmail3" required>Sub Heading</label>
                      <input type="textbox" class="form-control" placeholder="Sub heading" name="sub_heading"  value="<?php echo $sub_heading?>">
                    </div>
                    <div class="form-group">
                     <label for="exampleInputEmail3" required>Banner Images</label>
                      <input type="file" class="form-control"  name="banner_images"  >
                      <div class="error mt8"><?php echo $error_img_msg?></div>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Link</label>
                      <input type="text" class="form-control" placeholder="link" name="link" required value="<?php echo $link?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Link Text</label>
                      <input type="text" placeholder="link text" class="form-control"  name="link_text"  value="<?php echo $link_text?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Order Number</label>
                      <input type="text" placeholder="order number" class="form-control"  name="order_number"  value="<?php echo $order_number?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
		      </div>
<?php include('footer.php');?>
