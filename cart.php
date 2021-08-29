<?php
include('header.php');
if($web_status=='1'){
  redirect('shop.php');
 }
 ?>
   <div class="cart-main-area pt-95 pb-100">
     <div class="container">
       <h3 class="page-title">Your cart items</h3>
       <?php
       $data_call=GetAllCartData();
       $is_count=count($data_call);
       if($is_count>0){
        ?>
       <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
           <form method="post">
             <div class="table-content table-responsive">
               <table>
                 <thead>
                   <tr>
                     <th>Image</th>
                     <th>Product Name</th>
                     <th>Until Price</th>
                     <th>Qty</th>
                     <th>Subtotal</th>
                     <th>action</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                   $totalPrice=0;
                     foreach($data_call as $key=>$call_data){
                       $qty_for_data=$call_data['qty'];
                       $price_for_data=$call_data['price'];
                       $images_for_data=$call_data['img'];
                       $name_for_data=$call_data['name'];
                       $totalPrice_cart=$totalPrice+($qty_for_data*$price_for_data);
                       $qty_subtotal=$qty_for_data*$price_for_data;
                     ?>
                   <tr>
                     <td class="product-thumbnail">
                       <a href="javascript:void(0)"><img style="width:120px" src="media/dish/<?php echo $images_for_data  ?>" alt=""></a>
                     </td>
                     <td class="product-name"><a href="#"><?php echo $name_for_data  ?> </a></td>
                     <td class="product-price-cart"><span class="amount"><?php echo $price_for_data  ?></span></td>
                     <td class="product-quantity">
                       <div class="cart-plus-minus">
                         <input class="cart-plus-minus-box" type="text" name="qtybutton[<?php echo $key ?>][]" value="<?php echo $qty_for_data ?>">
                       </div>
                     </td>
                     <td class="product-subtotal"><?php echo $qty_subtotal ?>$</td>
                     <td class="product-remove">
                       <!-- <a href="#"><i class="fa fa-pencil"></i></a> -->
                       <a href="javascript:void(0)" onclick=delete_cart('<?php echo $key ?>','load')><i class="fa fa-times"></i></a>
                     </td>
                   </tr>
                 <?php } ?>
                 </tbody>
               </table>
             </div>
             <div class="row">
               <div class="col-lg-12">
                 <div class="cart-shiping-update-wrapper">
                   <div class="cart-shiping-update">
                     <a href="#">Continue Shopping</a>
                   </div>
                   <div class="cart-clear">
                     <button type="submit" name='cart_update'>Update Shopping Cart</button>
                     <a href="checkout.php">checkout</a>
                   </div>
                 </div>
               </div>
             </div>
           </form>
         </div>
       </div>
     <?php }else{
       echo "Emty Cart";
     } ?>
     </div>
   </div>


<?php
include('footer.php');
 ?>
