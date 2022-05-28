<?php
//$id = filter_input(INPUT_POST, "id");
$id = 2;
$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

$sql = "SELECT * FROM blogs WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->bindParam(':id' , $id , PDO::PARAM_INT);
$statement->execute();
$contacts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
<?php include('header.php'); ?>  
  <?php foreach($contacts as $row) : ?>
    <form method=post action=edit-update.php>
      <div style="text-align: center">
        <li>
          <h3>編集</h3>
          <a>title</a><br>
          <input name="title" value="<?php echo $row["title"]; ?>"/><br>
          <a>内容</a><br>
          <textarea rows="10" cols="50" name="content" ><?php echo $row["content"]; ?></textarea><br>
          <button type="submit">編集</button>
        </li>  
      </div>
      <input type="hidden" name="id" value="<?= $row['id']?>">
    </form>
  <?php endforeach; ?>    
</body>