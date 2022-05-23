<?php 
//ログインしていない時の処理
// session_start();
// if (empty($_SESSION['id'])) {
//   header('Location: user/siginin.php');
//   exit;
// }
?>
<?php
//$user_id = $_SESSION['id']だが、便宜上具体的な数字を入れておく。
$user_id = 9;

$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

//user_idで絞り込む
$sql = "SELECT * FROM blogs WHERE user_id = :user_id ORDER BY id DESC";
$statement = $pdo->prepare($sql);
$statement->bindValue(':user_id', $user_id);
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
<?php include('header.php'); ?>
    <main>
      <span style="text-align: center">
        <h1>マイページ</h1>
        <form action="post/create.php" method="post">
          <input type="submit" value="新規作成">
        </form>  
      </span>
      <div class="blog">
        <?php foreach ($contacts as $row) : ?>
        <li class="blog1">
        <img src="image/world.jpeg" title="空と城">
          <h2><?php echo $row['title']  ; ?></h2>
          <h5><?php echo $row['created_at'] ; ?></h5>
          <p><?php  if (mb_strlen($row['content']) > 15){
                      echo mb_substr($row['content'] , 0 , 15) . "..." ;
                    } else {
                      echo $row['content'] ;
                    } ; ?></p>
          <form action="myarticledetail.php" method="get">
            <input type="submit" name="detail" value="記事詳細へ">
          </form>
        </li>
        <?php endforeach; ?>
      </div>
    </main>
</body>