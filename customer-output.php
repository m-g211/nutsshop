<?php session_start(); ?>
<?php 
 	require 'header.php';
	require_once 'connect.php';
?>
<?php require 'menu.php'; ?>
<?php
	if( $_REQUEST['token'] != $_SESSION['unique_id']) {
		echo 'トークンが一致しません';
		exit; //ここで停止
	}

	$sql=$pdo->prepare('select * from customer where login=?');
	$sql->execute([$_REQUEST['login']]);
	// }
	$pdo_arr = $sql->fetchAll(PDO::FETCH_NUM);
	echo '<!--';
	echo $pdo_arr[0]['name'] ;
	echo $pdo_arr[0][1] ;
	// var_dump($pdo_arr); 
	echo '-->';

if (empty($pdo_arr)) {
	// 該当ユーザーが居ない場合
	if (isset($_SESSION['customer'])) {
			//ログイン済みならこれらを更新する
		$id=$_SESSION['customer']['id'];

		$sql=$pdo->prepare(
			'UPDATE customer set name=?, 
													address=?, 
													login=?, 
													password=? 
			WHERE id = ?'  //
		);

		$sql->execute([
			$_REQUEST['name'], 
			$_REQUEST['address'], 
			$_REQUEST['login'], 
			$_REQUEST['password'], 
			$id
		]);

		//セッション情報作り直し	
		$_SESSION['customer']=[
			'id'=>$id, 
			'name'=>$_REQUEST['name'], 
			'address'=>$_REQUEST['address'], 
			'login'=>$_REQUEST['login'], 
			'password'=>$_REQUEST['password']
		];
		echo 'お客様情報を更新しました。';

	} else {
		//非ログインの場合は､新規会員登録
		$sql=$pdo->prepare(
			'INSERT into customer values(null,?,?,?,?)');
		$sql->execute([
			$_REQUEST['name'], 
			$_REQUEST['address'], 
			$_REQUEST['login'], 
			$_REQUEST['password']]
		);
		echo 'お客様情報を登録しました。';
	}

} else {
	echo 'ログイン名がすでに使用されていますので、変更してください。';
}

?>
<?php require 'footer.php'; ?>
