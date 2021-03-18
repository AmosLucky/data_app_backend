<?php
$url = "https://mobileairtimeng.com/httpapi/datashare?userid=08106799951&pass=c18964f3d8a4c955b66a&network=1&phone=08106799945951&datasize=1000&user_ref=11707182020100004 &22&08106799951&08106799945951&jsn=json";
$url =  urlencode($url);
$json = file_get_contents("https://mobileairtimeng.com/httpapi/?userid=xxxx&pass=c18964f3d8a4c955b66a&network=1&phone=08106799945951&amt=1000&user_ref=11707182020100004&22&08106799951&08106799945951&jsn=json");
$arr =  json_decode($json,true);
echo $arr['code'];

// $ch = curl_init();
// // IMPORTANT: the below line is a security risk, read https://paragonie.com/blog/2017/10/certainty-automated-cacert-pem-management-for-php-software
// // in most cases, you should set it to true
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_URL, $url);
// $result = curl_exec($ch);
// curl_close($ch);

// $obj = json_decode($result);
// echo $obj->;


// //  Initiate curl
// $ch = curl_init();
// // Will return the response, if false it print the response
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// // Set the url
// curl_setopt($ch, CURLOPT_URL,$url);
// // Execute
// $result=curl_exec($ch);
// // Closing
// curl_close($ch);
// $jh = json_decode($result, true);
// echo $jh;


// Will dump a beauty json :3

;

?>