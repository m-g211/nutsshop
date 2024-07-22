<?php
//後からだと大変なので､各ファイルからrequireで読み込み
if( $_SERVER['HTTP_HOST']=='localhost'){
$host   = 'localhost';
$dbname = 'shop'; // 'xs619812_xss';  // xserverで変わる情報
$user = 'root';    // 'xs619812_xss'; 
$pswd = 'wert'; // 'wert3333'; 
} else {
  $host = 'localhost';
  $dbname = 'xs619812_xcc'; 
  $user = 'xs619812_xcc'; 
  $pswd = 'mg0417iao';
}

try{
  $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8",
    $user, 
    $pswd 
  );
} catch (Exception $e) {
  echo '';
}