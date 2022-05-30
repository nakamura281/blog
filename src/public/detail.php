<?php
session_start();
//userのid
$user_id = $_SESSION['id'];
//blogのid
$id = filter_input(INPUT_POST, "id");

$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

//idで絞り込む（ブログ記事のDB）
$sql = "SELECT * FROM blogs WHERE id = :id ";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$contacts = $statement->fetchAll(PDO::FETCH_ASSOC);


$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

//コメントのDB
$sql1 = "SELECT * FROM comments WHERE blog_id = :blog_id";
$statement1 = $pdo->prepare($sql1);
$statement1->bindValue(':blog_id', $id);
$statement1->execute();
$contacts1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
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
            <button type="submit" formaction="index.php">一覧ページへ</button>
          </li>
        </div>
      </span>
    <?php endforeach; ?>
  </form>
  <form action="detail-complete.php" method="post">
  <span style="text-align: center">
    <div>
      <li>
        <h2>この投稿にコメントしますか？</h2>
        <p>名前</p>
        <input type="text" name="commenter_name" ><br>
        <p>内容</p>
        <textarea rows="10" cols="50" name="comments"></textarea><br>
        <input type="submit" name="confirm" value="送信" class="button">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
      </li>
    </div>
  </span> 
  </form>
  <span style="text-align: center">
  <h2>コメント一覧</h2>
      <div>
        <?php foreach ($contacts1 as $row1) : ?>
            <h3><?php echo $row1['comments']; ?></h3>
            <p><?php echo $row1['created_at']; ?></p>
            <p><?php echo $row1['commenter_name']; ?></p>
        <?php endforeach; ?>
      </div>
  </span>
  </main>  
</body>
