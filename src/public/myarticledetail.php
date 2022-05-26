<?php
//今は擬態的な数字を入れておく
$id = 1;

$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

//idで絞り込む
$sql = "SELECT * FROM blogs WHERE id = :id ";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$contacts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">  
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <main>
  <form method="post">
    <?php foreach($contacts as $row) : ?>
      <span style="text-align: center">
        <h1><?php echo $row['title'];?></h1>
        <div>
          <li class=blog1>
            <p><?php echo "投稿日時：" . $row['created_at']; ?></p>
            <textarea rows="10" cols="50" name="content"><?php echo $row["content"]; ?></textarea><br>
            <button type="submit" formaction="edit.php">編集</button>
            <button type="submit" formaction="myarticledetail-complete.php">削除</button>
            <button type="submit" formaction="mypage.php">マイページへ</button>
          </li>
        </div>
        <input type="hidden" name="id" value="<?= $row['id']?>">
      </span>
    <?php endforeach; ?>
  </form> 
  </main>  
</body>