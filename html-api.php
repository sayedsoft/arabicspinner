<?php

/*
  Arabic Spinner Api
  Url : http://sayedsoft.com/
  Copyright © Sayedsoft 2016. All Rights Reserved
  Phone : +90553376202
 */
 
 $apikey   = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";  // Enter Your Api Key
 $apipass  = "00000000";  // Enter Your Api Password
 
 /* 
   Your Article
   Note : You can type your article with html.
 */
 
 $mode    = "normal";
 $content = "";
 
 ini_set('default_charset', 'UTF-8');
 
if (isset($_POST["text"]) and $_POST["text"] != "") { 
 
 $yourtext = $_POST["text"];  // Your Post of Article
 
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
 
 /*
  * 
  Sart Do XML 
 */


 // initializing or creating array
 /*
  Not : You must use "html_entity_decode" function to yor text as html_entity_decode($yourtext) if you will use html
 */
 $info     = array("apikey"=>$apikey,"apipass"=>$apipass,"text"=>html_entity_decode($yourtext) );
 
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
 
 // Convert Output json to array
 
 $out      = $server_output;
 $out      = json_decode($server_output,true);

 $mode     = $out["mode"];
 $message  = $out["message"];
 $content  = $_POST["text"];
}
 
 
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="gencyolcu" />
    <meta charset="UTF-8" /> 
	<title>Arabic Spinner Test | تجريب السبينر العربي</title>
    <link rel="stylesheet" type="text/css" href="assets/js/ckeditor/skins/bootstrapck/editor.css?t=EAPE" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="http://test.arabicspinner.com/assets/js/jquery-1.11.3.min.js"></script>
    <script src="http://test.arabicspinner.com/assets/js/ckeditor/ckeditor.js"></script>
    <script src="http://test.arabicspinner.com/assets/js/ckeditor/config-ar.js?t=EAPE"></script>
    <script src="http://test.arabicspinner.com/assets/js/ckeditor/skins/bootstrapck/editor.css?t=EAPE"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    <script src="http://test.arabicspinner.com/assets/js/ckeditor/spinner.js"></script>
    <style>
     h1,div,a,input {
     }
     .bg-warning {
        padding: 10px;
        background: #f2dede;
        
     }
    </style>
</head>

<body>

<div class="container theme-showcase">
  <h1>Arabic Spinner Test | تجريب السبينر العربي</h1>
  <br />
  <form action="" method="post">
    <div class="form-group">
     <label for="ckeditor1">The original text | النص الأصلي</label>
      <textarea class="" id="ckeditor1" name="text" style="width: 100%;height: 500px;"><?php echo $content ; ?></textarea>
    </div>
    <?php 
     if ($mode != "normal") {
      if ($mode == "true") {
        
        $spinContent  =  $out["spinnedText"];
      ?>
      <br />
      <div class="form-group">
        <label for="ckeditor2">The Changed Text | النص المعدل</label>
        <textarea class="" id="ckeditor2" name="textx" style="width: 100%;height: 500px;"><?php echo $spinContent ; ?></textarea>
      </div>
      <?php
     } elseif ($mode == "false") {
      $spinContent  =  "";
      ?>
       <p class="bg-warning"><?php echo $out["message"]; ?></p>
      <?php 
     }
     
    }// if mode normal
   ?>
   <input type="submit" class="btn btn-default" value="Spin" />
  </form>
</div>
  
  
</body>
</html>
  
