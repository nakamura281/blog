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

var_dump($id);
var_dump($title);
var_dump($content);

//画面遷移の機能は後ほど追加します。
//header('Location: myarticledetail.php');
exit();
?>