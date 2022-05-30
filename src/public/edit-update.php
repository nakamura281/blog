<?php 
$id = filter_input(INPUT_POST, "id");
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

$sql = "UPDATE blogs SET title = :title , content = :content , updated_at = now() WHERE  id = :id";

$statement = $pdo->prepare($sql);
$statement->bindValue( ':id' , $id , PDO::PARAM_INT);
$statement->bindValue( ':title' , $title , PDO::PARAM_STR);
$statement->bindValue( ':content' , $content , PDO::PARAM_STR);
$statement->execute();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <form method=post action=myArticledetail.php>
    <div style="text-align: center">
      <li>
        <button type="submit">次へ</button>
      </li>  
    </div>
    <input type="hidden" name="id" value="<?= $id ?>">
  </form> 
</body>