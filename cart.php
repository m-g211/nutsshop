<table class="table table-striped">
<tr><th>商品番号</th><th>商品名</th>
<th>価格</th><th>個数</th><th>小計</th><th></th></tr>

<?php
if (!empty($_SESSION['product'])) {

	$total=0;
	foreach ($_SESSION['product'] as $id=>$product) {
		$subtotal = $product['price'] * $product['count'];
		$total += $subtotal;
?>
		<tr>
		<td><?=$id?></td>
		<td><a href="detail.php?id=<?=$id?>"> <?=$product['name']?></a></td>
		<td><?= $product['price']?></td>
		<td><?= $product['count']?></td>
		<td><?= $subtotal				 ?></td>
		<td><a href="cart-delete.php?id=<?=$id?>">削除</a></td>
		</tr>
<?php	} ?>
 

	<tr><td>合計</td><td></td><td></td><td></td><td> <?=$total?> 
		</td><td></td></tr>
	</table>
<?php
} else {
	echo 'カートに商品がありません。';
}
?>
