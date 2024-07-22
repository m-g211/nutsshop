<?php
session_start();
 require 'header.php'; 
 require 'menu.php'; 
 require_once 'connect.php';

// var_dump($_SESSION['customer']);
$customer_id = isset($_SESSION['customer']) ? $_SESSION['customer']['id'] : 0;

$query = 'SELECT * from product 
    left join (
      SELECT * FROM `favorite` 
      where customer_id = ? 
    ) as sub
    ON sub.product_id = id
    where id= ? ';

  $sql=$pdo->prepare($query);
  $sql->execute([
    $customer_id ,
    $_REQUEST['id']
  ]);
  
  foreach ($sql as $row) {

?>
<p>
  <img alt="image" src="image/<?= $row['id']?>.jpg"></p>
  <form action="cart-insert.php" method="post">
    <p>商品番号：<?= $row['id']?></p>
    <p>商品名：<?= $row['name']?></p>
    <p>価格：<?= $row['price']?></p>
    <p>個数：
      <select name="count">
        <?php 
        for ($i=1; $i<=10; $i++) {
          echo "<option value='$i'>$i</option>";
        }
      ?>
      </select>
  </p>
  
  <input type="hidden" name="id" value="<?= $row['id']?>">
  <input type="hidden" name="name" value="<?= $row['name']?>">
  <input type="hidden" name="price" value="<?= $row['price']?>">
  
  <p><input type="submit" value="カートに追加"></p>
</form>
<p>
<?php if (empty($row['customer_id'])) { ?>  
  <a href="favorite-insert.php?id=<?= $row['id'] ?>">お気に入りに追加</a>
<?php } ?>  
</p>

<?php
}
 require 'footer.php'; 
