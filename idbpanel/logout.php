<?php
//include("include/routines.php");

$fields = array(
    'logout' => '1',
    'p' => '1'
);

$ch = curl_init('http://localhost/idb/includes/common.php');
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($fields));

// uncomment if you want to save cookie.
// curl_setopt($ch, CURLOPT_COOKIEJAR, '/var/tmp/cookie.txt');
// curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/tmp/cookie.txt');

$result = curl_exec($ch);
curl_close($ch);die;die;
/*$_SESSION['panel_user'] = array();
header("Location: ".$BaseFolder);*/
exit(0);
?>