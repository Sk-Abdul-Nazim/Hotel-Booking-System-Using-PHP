<?php
   ini_set("sendmail_from", "indianhotel81@gmail.com");
   $to = "sknazim1818@gmail.com";//change receiver address
   $subject = "This is subject";
   $message = "This is simple text message.";
   $header = "From:indianhotel81@gmail.com \r\n";

   $result = mail ($to,$subject,$message,$header);

   if( $result == true ){
      echo "Message sent successfully...";
   }else{
      echo "Sorry, unable to send mail...";
   }
?>
