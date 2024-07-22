<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
<?php
	$name=$address=$login=$password='';
	if (isset($_SESSION['customer'])) {
		$name=$_SESSION['customer']['name'];
		$address=$_SESSION['customer']['address'];
		$login=$_SESSION['customer']['login'];
		$password=$_SESSION['customer']['password'];
	}
	$_SESSION['unique_id'] = uniqid();
  //トークン→ランダムな長い文字を生成します

?>

<form class="h-adr" action="customer-output.php" method="post">

  <!-- //csrf対策	 -->
  <input type='hidden' value="<?=$_SESSION['unique_id']?>" name='token'>

  <span class="p-country-name" style="display:none;">Japan</span>
  <input type="hidden" class="p-country-name" value="Japan">
  <table>
    <tr>
      <td>お名前</td>
      <td>
        <input type="text" name="name" value="<?= $name?>">
      </td>
    </tr>
    <tr>
      <td>〒</td>
      <td>
        <input type="text" class="p-postal-code" size="8" maxlength="8" >
      </td>
    </tr>
    <tr>
      <td>ご住所</td>
      <td>
        <input type="text"  class="p-region p-locality p-street-address p-extended-address" name="address" value="<?= $address?>">
      </td>
    </tr>
    <tr>
      <td>ログイン名</td>
      <td>
        <input type="text" name="login" value="<?= $login?>">
      </td>
    </tr>
    <tr>
      <td>パスワード</td>
      <td>
        <input type="password" name="password" value="<?= $password?>">
      </td>
    </tr>
  </table>
  <input type="submit" value="確定">
</form>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
<?php require 'footer.php'; ?>