<?php 
session_start(); 
 require 'header.php'; 
 require 'connect.php'; 
 require 'menu.php'; 
 

if (isset($_SESSION['customer'])) {
  $values = [  //入れる値
    $_SESSION['customer']['id'], 
    $_REQUEST['id']
  ] ;

 // お気に入りの重複チェック
  $s = "SELECT count(*) as count
    FROM favorite
    WHERE customer_id = ?
    AND product_id = ?
    ";
  $sql = $pdo->prepare( $s );
  $sql->execute( $values );
  
  foreach ($sql as $row) {
    if ($row['count'] != 0) {
      echo '既に登録済みです';
      exit;
    }
 }
// お気に入りの重複チェックここまで
  $s= "INSERT into favorite values(?,?)";
	$sql = $pdo->prepare( $s );
	$sql->execute( $values );

	echo '<p> お気に入りに商品を追加しました。</p> ';
 
	require 'favorite.php';  // お気に入りの表示

} else {
	echo 'お気に入りに商品を追加するには、ログインしてください。';
}
require 'footer.php'; 
