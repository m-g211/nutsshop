<?php require 'header.php';
require_once 'connect.php';
 ?>
<?php require 'menu.php' ?>
<form action="product.php" method="post">
  商品検索
  <input type="text" name="keyword">
  <input type="submit" value="検索">
</form>
<hr>
<table>
  <tr>
    <th>商品番号</th>
    <th>商品名</th>
    <th>価格</th>
  </tr>

<div class="row">
  <?php
if (isset($_REQUEST['keyword'])) {
	$sql=$pdo->prepare('select * from product where name like ?');
	$sql->execute(['%'.$_REQUEST['keyword'].'%']);
} else {
	$sql=$pdo->query('select * from product');
}


foreach ($sql as $row) {
  $id=$row['id'];
?>
<div class="col-md-3 col-sm-4 col-6">
    <p><a href="detail.php?id=<?= $row['id']?>"><img alt="image" src="image/<?= $row['id']?>.jpg"></a></p>
    <p>商品番号：<?= $row['id']?></p>
    <p>商品名：<?= $row['name']?></p>
    <p>価格：<?= $row['price']?></p>
    </div>
   
  <?php } ?>
  </div>
<?php require 'footer.php' ?>