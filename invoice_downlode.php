<?php
include('connection.php');
include('function.php');
include('vendor/autoload.php');
if(isset($_REQUEST['order_id'])){
  if(isset($_REQUEST['rand_id'])){
     $_SESSION['rand_user_base_id']=$_REQUEST['rand_id'];
  }

  $order_id=$_REQUEST['order_id'];
  $pdf_data=invoice($order_id);
  $mpdf = new \Mpdf\Mpdf();
  $mpdf -> WriteHTML($pdf_data);
  $file=time().'food_ordering_hestory.pdf';
  $mpdf->Output($file,'D');
}
 ?>
