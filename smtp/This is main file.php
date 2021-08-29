<?php

include('smtp/PHPMailerAutoload.php');
 $email="your user email";
 $Subject="email subject";
 $body="email body";
$mail=new PHPMailer(true);
$mail->isSMTP();
$mail->Host="smtp.gmail.com";
$mail->Port=587;
$mail->SMTPSecure="tls";
$mail->SMTPAuth=true;
$mail->Username="Your carrent email";
$mail->Password="Your carrent password";
$mail->SetFrom("Your carrent email");
$mail->addAddress($email);
$mail->IsHTML(true);
$mail->Subject=$Subject;
$mail->Body=$body;
$mail->SMTPOptions=array('ssl'=>array(
  'verify_peer'=>false,
  'verify_peer_name'=>false,
  'allow_self_signed'=>false
));
if($mail->send()){
   echo "done";
}else{
  echo "Error occur";
}


?>