<?php
@session_start();
if (isset($_SESSION['customer'])) {
  $logdin = true;
}else{
  $logdin = false;
}
?>

<a href="product.php">HOME</a>
<a class="<?=$logdin ? '' : 'hidden' ?>" href="favorite-show.php">お気に入り</a>
<a class="<?=$logdin ? '' : 'hidden' ?>" href="history.php">購入履歴</a>
<a class="<?=$logdin ? '' : 'hidden' ?>" href="cart-show.php">カート</a>
<a class="<?=$logdin ? '' : 'hidden' ?>" href="purchase-input.php">購入</a>
           <!--↓これがtrueなら空文字が出る -->     
<a class="<?=$logdin ? '' : 'hidden' ?>" href="logout-input.php">ログアウト</a>
           <!--↓これがfalseなら文字が出る-->
<a class="<?=$logdin ? 'hidden' : '' ?>" href="login-input.php">ログイン</a>
<a class="<?=$logdin ? '' : '' ?>" href="customer-input.php">会員登録</a>
<hr>
