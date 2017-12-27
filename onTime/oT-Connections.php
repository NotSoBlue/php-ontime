<?php 
error_reporting(E_ALL & ~E_NOTICE);
$db_username = 'root';
$db_password = '';
$db_name = 'ontime';
$db_host = 'localhost';
$connectMe = new mysqli($db_host, $db_username, $db_password,$db_name);
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = strip_tags($data);
   $data = htmlspecialchars($data);
   return $data;
}
date_default_timezone_set("Asia/Manila");
$getDateNow = date("Y-m-d/h:i:sa");
if ($connectMe->connect_error) {
    die("Connection failed: " . $connectMe->connect_error);
}
?>