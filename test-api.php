<?php

 /*
  Arabic Spinner Api
  Url : http://syriancoders.com/
  Copyright © Syrian Coders 2016. All Rights Reserved
  Phone : +90553376202 / +905060604007
 */
 
 $apikey   = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";  // Enter Your Api Key
 $apipass  = "00000000";  // Enter Your Api Password
 
 /* 
   Your Article
   Note : You can type your article with html.
 */
 
 $yourtext = "<p>بيسب ربهمعشيا رمسهخيشبلهخرلا بايهعخسيحتءؤى &nbsp;</p>";  // Enter Your Article
 
 /* 
  *
  Check informaiton 
 */
 
 if (strlen($apikey) != 32) {
   echo "The api key not right please check it and try again";
   exit(); 
 }
 
 if (strlen($apipass) != 7) {
   echo "The api password not right please check it and try again";
   exit(); 
 }
 
 if ($yourtext == "") {
   echo "You Must type yor Article it's null";
   exit(); 
 } 
 
 /*
  * 
  Sart Do XML 
 */


 // initializing or creating array
 /*
  Not : You must use "html_entity_decode" function to yor text as html_entity_decode($yourtext) if you will use html
 */
 $info     = array("apikey"=>$apikey,"apipass"=>$apipass,"text"=>html_entity_decode($yourtext) );
 
 // function call to convert array to json
 function ArrayToJeson ($array) {
        if (is_array($array)) {
           $return = json_encode( $array, JSON_UNESCAPED_UNICODE );
        } else {
           $return = "False Array To array"; 
        }
        return $return ;
 }
 
 $json   = ArrayToJeson ($info);

 /*
  *
  Send Information To Server 
 */
 
 $posturl  = "http://api.arabicspinner.com/api.php?mode=spinner";
 $ch       = curl_init();
 curl_setopt($ch, CURLOPT_URL,$posturl);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS,"json=".$json);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 // Get Output
 $server_output = curl_exec ($ch);
 curl_close ($ch);
 
 echo $server_output ;
 
?>