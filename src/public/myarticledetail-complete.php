<?php
$id = filter_input(INPUT_POST, "id");
$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);  
  
$sql = "DELETE FROM blogs WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

header('Location: ./mypage.php');
exit();
?>