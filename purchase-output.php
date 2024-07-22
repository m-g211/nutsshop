<?php session_start(); ?>
<?php require 'header.php';
require_once 'connect.php';
 ?>
<?php require 'menu.php'; ?>
<?php
// 手動でオートインクリメントを作っている
$purchase_id=1; 
$s = 'SELECT max(id) as max FROM purchase';
$sql = $pdo->query($s) ;

foreach ($sql as $row) {
	$purchase_id = ++$row['max'];
}
//次の購入ID取得完了

// 購入テーブルに購入IDと顧客IDと日時を挿入
$sql=$pdo->prepare('INSERT into purchase values(?,?,?)');

$created = date('Y-m-d H:i:s');

if ($sql->execute([
	$purchase_id, 
	$_SESSION['customer']['id'] ,
	$created
])) {
		// ↑ 成功すると挿入した件数が返ってくる 
	foreach ($_SESSION['product'] as $product_id => $product ) {
		//カートから商品を一つずつ取り出して詳細テーブルに挿入する
		$sql=$pdo->prepare('INSERT into purchase_detail values(?,?,?)');
		$sql->execute([$purchase_id, $product_id, $product['count']]);
	}
	unset($_SESSION['product']);  //カートをカラに
	echo '購入手続きが完了しました。ありがとうございます。';
	
} else {
	echo '購入手続き中にエラーが発生しました。申し訳ございません。';
}


?>
<?php require 'footer.php'; ?>
