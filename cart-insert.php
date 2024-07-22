<?php session_start(); 
	 require 'header.php'; 
	 require 'menu.php'; 

$id = $_REQUEST['id'];  // 選んだ商品のid

if (!isset($_SESSION['product'])) { 
	// カートが作成されてなければカラの配列を作成(初期化)
	$_SESSION['product'] = []; // ← これがカートの中身
}

$count=0;
if ( isset($_SESSION['product'][$id]) ) {
	//すでにカートに同じ商品が入っていれば $countに代入
	$count = $_SESSION['product'][$id]['count'];
}
  
  //カートを更新
$_SESSION['product'][$id] = [
	'name'  => $_REQUEST['name'], 		// name というキーで商品名を代入(上書き)
	'price' => $_REQUEST['price'], 		//  値段を 〃
	'count' => $count+$_REQUEST['count'] //数量だけは元の数量に加算
];

echo '<p>カートに商品を追加しました。</p><hr>';

require 'cart.php';  //カートの表示
require 'footer.php'; 
