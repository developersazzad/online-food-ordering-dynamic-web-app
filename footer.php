<div class="footer-area black-bg-2 pt-70">
  <div class="footer-bottom-area border-top-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-7">
          <div class="copyright">
            <p>Copyright © <a href="#">Billy.</a> . All Right Reserved.</p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-5">
          <div class="footer-social">
            <ul>
              <li><a href="#"><i class="ion-social-facebook"></i></a></li>
              <li><a href="#"><i class="ion-social-twitter"></i></a></li>
              <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
              <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
              <li><a href="#"><i class="ion-social-rss"></i></a></li>
              <li><a href="#"><i class="ion-social-dribbble-outline"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- all js here -->
<script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/ajax-mail.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
function res_data(){
var type=jQuery('#type_res').val();
var name=jQuery('#name').val();
var mobile=jQuery('#mobile').val();
var password=jQuery('#password').val();
var email=jQuery('#email').val();
var error='';
//=========VALIDATION============//
if(name==''){
  jQuery('#err_msg_name').html('pleace enter name.');
  error='yes';
}else{
  jQuery('#err_msg_name').html('');
}
if(email==''){
  jQuery('#err_msg_eml').html('pleace enter email.');
  error='yes';
}else{
  jQuery('#err_msg_eml').html('');
}
if(mobile==''){
  jQuery('#err_msg_mobile').html('pleace enter mobile number.');
  error='yes';
}else{
  jQuery('#err_msg_mobile').html('');
}
if(password==''){
  jQuery('#err_msg_pass').html('pleace enter email.');
  error='yes';
}else{
  jQuery('#err_msg_pass').html('');
}
if(error==''){
  jQuery('#err_msg_email').html('pleace wait...');
  jQuery.ajax({
    url:'login_resister_core.php',
    type:'post',
    data:"name="+name+"&email="+email+"&mobile="+mobile+"&password="+password+"&type="+type,
    success:function(result){
       if(result=='success'){
          jQuery('#err_msg_email').html('');
         window.location.href='verify.php';
       }
       if(result=='email_exes'){
         jQuery('#err_msg_email').html('Your email already rester in this website.');
       }
    }
  })
}
}
function log_data(){
  var type=jQuery('#type_log').val();
  var email=jQuery('#email_log').val();
  var password=jQuery('#pwd_log').val();
  var is_checkout=jQuery('#is_checkout').val();
  var error='';
  //=========VALIDATION============//
  if(email==''){
    jQuery('#err_msg').html('pleace enter email.');
    error='yes';
  }else{
    jQuery('#err_msg').html('');
  }
  if(password==''){
    jQuery('#err_msg_pwd').html('pleace enter password');
    error='yes';
  }else{
    jQuery('#err_msg_pwd').html('');
  }

  if(error==''){
    jQuery.ajax({
      url:'login_resister_core.php',
      type:'post',
      data:"email="+email+"&password="+password+"&type="+type,
      success:function(result){
        if(is_checkout=='yes'){
          if(result=='login_success'){
           window.location.href='checkout.php';
         }
        }
        if(is_checkout=='no'){
          if(result=='login_success'){
            window.location.href='shop.php';
          }
        }
        if(result=='login_fail'){
           jQuery('#err_msg_login_s').html('your email or password wrong .pleace enter valid email & passsword.');
        }
       if(result=='verify_again'){
         jQuery('#err_msg_login_s').html('your email not valid pleace verify your email.');
       }
       if(result=='desabald'){
         jQuery('#err_msg_login_s').html('your email is blocked in food ordering commenity.');
       }
      }
    });
  }
  }
  //==========Add to Cart=============//
  function add_to_cart(id,type){
    var qty=jQuery('#qty_'+id).val();
    //Attr is dish detail id//
    var attr=jQuery('input[name="attr_'+id+'"]:checked').val();
    error='';
    if(typeof attr=='undefined'){
       error='yes';
       swal("error", "pleace select dish Attribute!", "error");
    }
    if(error==''){
      jQuery.ajax({
        url:'add_to_cart.php',
        type:'post',
        data:'qty='+qty+'&attr='+attr+'&type='+type,
        success:function(result){
          var data=jQuery.parseJSON(result);
              swal("Congrats!", "This Proudect add to Cart!", "success");
              jQuery('span#attr_'+id).html('(Added-'+qty+')');
                jQuery('#cart_count').html(data.count);
              // var $cart_count=jQuery('#cart_count').html();
              // $cart_count++;
              if(data.count==1){
                jQuery('#Cart_total_price').html(data.totalPrice+'$');
                var cart_html='<div class="shopping-cart-content"><ul id="add_li_ajax"><li id="attr_sp_'+attr+'" class="single-shopping-cart"><div class="shopping-cart-img"><a href="javascript:void(0)"><img alt="" class="images_cart" src="media/dish/'+data.images+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.name+'</a></h4><h6>Qty: '+qty+'</h6><span>'+data.price+'$</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li></ul><div class="shopping-cart-total"><h4>Total : <span class="shop-total" id="shop_total_price">'+data.totalPrice+'$</span></h4></div><div class="shopping-cart-btn"><a href="cart.php">view cart</a><a href="checkout.php">checkout</a></div></div>';
              jQuery('.header-cart').append(cart_html);
            }else{
              jQuery('#Cart_total_price').html(data.totalPrice+'$');
              jQuery('#attr_sp_'+attr).remove();
              var cart_ul_html='<li id="attr_sp_'+attr+'" class="single-shopping-cart"><div class="shopping-cart-img"><a href="#"><img alt="" class="images_cart" src="media/dish/'+data.images+'"></a></div><div class="shopping-cart-title"><h4><a href="#">'+data.name+'</a></h4><h6>Qty: '+qty+'</h6><span>'+data.price+'$</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li>';
              jQuery('#shop_total_price').html(data.totalPrice+'$');
              jQuery('#add_li_ajax').append(cart_ul_html);
            }
        }
      })
    }
  }

  function delete_cart(id,is_type){
       //Attr is dish detail id//
    var type='delete';
    jQuery.ajax({
      url:'add_to_cart.php',
      type:'post',
      data:'attr='+id+'&type='+type,
      success:function(result){
        if(is_type=='load'){
          window.location.href=window.location.href;
        }else{
       var dataArr=jQuery.parseJSON(result);
        jQuery('#cart_count').html(dataArr.total_count);
        jQuery('#Cart_total_price').html(dataArr.totalPrice+'$');
        jQuery('#shop_total_price').html(dataArr.totalPrice+'$');
        if(dataArr.total_count==0){
          jQuery('.shopping-cart-content').remove();
        }else{
          jQuery('span#cart_ajax_'+id).html('');
          jQuery('#attr_sp_'+id).remove();
          jQuery('.sp_cls_'+id).remove();
        }
       }
      }
    })
  }

  function go_to_this_pages(link_submit){
    window.location.href=link_submit;
  }

  function update_data(){
  var name=jQuery('#name_sp_update').val();
    jQuery('#username_sp_update').html(name);
  }

  function apply_compone(){
    var copone_coad=jQuery('#copone_coad').val();
    if(copone_coad==''){
      jQuery('#copone_error').html('pleace enter copone coad.');
    }else{
      jQuery('#copone_error').html('');
    }

   if(copone_coad!=''){
     jQuery.ajax({
       url:'apply_copone.php',
       type:'post',
       data:'copone_coad='+copone_coad,
       success:function(result){
       var json_data=jQuery.parseJSON(result);
       if(json_data.status=='success'){
         jQuery('.copone_valid_price').show();
         jQuery('.final_copone_coad').html(json_data.copone_code);
         jQuery('.total_price_copone').html(json_data.total_price+' $');
         swal("success",json_data.msg , "success");

       }
       if(json_data.status=='error'){
           swal("error",json_data.msg , "error");
       }
       }
     })
     }
  }
//===================================================Rating==============//
  function rating_sp_1(id,usr_id){
    jQuery.ajax({
      url:'rating.php',
      type:'post',
      data:'proudect_id='+id+'&usr_id='+usr_id+'&rating_count='+1,
      success:function(result){
        if(result=='rating_one'){
          jQuery('#one_rating_'+id).html('<i class="text-danger fa fa-star"></i>');
          jQuery('#msg_rating_'+id).html('Bad');
          jQuery('#tow_rating_'+id).remove();
          jQuery('#three_rating_'+id).remove();
          jQuery('#four_rating_'+id).remove();
          jQuery('#five_rating_'+id).remove();
        }
      }
    })
  }
  function rating_sp_2(id,usr_id){
    jQuery.ajax({
      url:'rating.php',
      type:'post',
      data:'proudect_id='+id+'&usr_id='+usr_id+'&rating_count='+2,
      success:function(result){
        if(result=='rating_tow'){
          jQuery('#tow_rating_'+id).html('<i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i>');
          jQuery('#msg_rating_'+id).html('Avrages');
          jQuery('#one_rating_'+id).remove();
          jQuery('#three_rating_'+id).remove();
          jQuery('#four_rating_'+id).remove();
          jQuery('#five_rating_'+id).remove();
        }
      }
    })
  }
  function rating_sp_3(id,usr_id){
    jQuery.ajax({
      url:'rating.php',
      type:'post',
      data:'proudect_id='+id+'&usr_id='+usr_id+'&rating_count='+3,
      success:function(result){
        if(result=='rating_three'){
          jQuery('#three_rating_'+id).html('<i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i>');
          jQuery('#msg_rating_'+id).html('Good');
          jQuery('#one_rating_'+id).remove();
          jQuery('#tow_rating_'+id).remove();
          jQuery('#four_rating_'+id).remove();
          jQuery('#five_rating_'+id).remove();
        }
      }
    })
  }
  function rating_sp_4(id,usr_id){
    jQuery.ajax({
      url:'rating.php',
      type:'post',
      data:'proudect_id='+id+'&usr_id='+usr_id+'&rating_count='+4,
      success:function(result){
          if(result=='rating_four'){
          jQuery('#four_rating_'+id).html('<i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i>');
          jQuery('#msg_rating_'+id).html('Very Good');
          jQuery('#one_rating_'+id).remove();
          jQuery('#tow_rating_'+id).remove();
          jQuery('#three_rating_'+id).remove();
          jQuery('#five_rating_'+id).remove();
        }
      }
    })
  }
  function rating_sp_5(id,usr_id){
    jQuery.ajax({
      url:'rating.php',
      type:'post',
      data:'proudect_id='+id+'&usr_id='+usr_id+'&rating_count='+5,
      success:function(result){
      if(result=='rating_five'){
      jQuery('#five_rating_'+id).html('<i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i><i class="text-danger fa fa-star"></i>');
      jQuery('#msg_rating_'+id).html('Wonderful foood');
      jQuery('#one_rating_'+id).remove();
      jQuery('#tow_rating_'+id).remove();
      jQuery('#three_rating_'+id).remove();
      jQuery('#four_rating_'+id).remove();
      }
     }
    })
  }
  function add_data(status){
    jQuery.ajax({
      url:"cookie_set_user.php",
      type:"post",
      data:"status="+status,
      success:function(data){
        alert("Are You Conform ?");
      }
    })
  }
</script>
</body>
</html>
