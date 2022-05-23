<?php
//$user_id = $_SESSION['id']だが、便宜上具体的な数字を入れておく。
$user_id = 9;
$title = $_POST['title'];
$content = $_POST['content'];

$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

//データベースに追加
$sql = "INSERT INTO blogs (
  user_id , title , content , created_at , updated_at	
  ) VALUES (
  :user_id , :title , :content , now() , now()
  )";
  
$statement = $pdo->prepare($sql);
$statement->bindValue(':user_id', $user_id);
$statement->bindValue(':title', $title);
$statement->bindValue(':content', $content);
$statement->execute();
$contacts = $statement->fetchAll(PDO::FETCH_ASSOC);

//マイページへリダイレクト
header('Location: mypage.php');
exit;
?>