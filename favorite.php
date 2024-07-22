<?php
  if (isset($_SESSION['customer'])) {
?>
<table>
  <tr>
    <th>商品番号</th>
    <th>商品名</th>
    <th>価格</th>
    <th> </th>
  </tr>

<?php
require_once 'connect.php';
  $s = 'SELECT * from favorite, product 
    WHERE customer_id = ? 
    AND   product_id = id' ;

  $sql = $pdo->prepare( $s );
  $sql->execute([$_SESSION['customer']['id']]);

  foreach ($sql as $row) {
    $id=$row['id'];

 ?>   
    <tr>  <!--行をループ-->
      <td><?= $id?></td>
      <td><a href="detail.php?id='.$id.'"><?= $row['name']?></a></td>
      <td><?= $row['price']?></td>
      <td><a href="favorite-delete.php?id=<?= $id?>">削除</a></td>
    </tr>


<?php  } //end foreach ?>
  </table>

<?php } else { ?>

    <p>お気に入りを表示するには、ログインしてください。</p>
<?php } 