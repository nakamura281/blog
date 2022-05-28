<?php 
$commenter_name = filter_input(INPUT_POST, "commenter_name");
$comments = filter_input(INPUT_POST, "comments");
$blog_id = filter_input(INPUT_POST, "id");
$user_id = filter_input(INPUT_POST, "user_id");


$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

$sql = "INSERT INTO comments (
    user_id , blog_id , commenter_name , comments , created_at , updated_at	
    ) VALUES (
    :user_id , :blog_id , :commenter_name , :comments , now() , now()
    )";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':blog_id', $blog_id, PDO::PARAM_STR);
$stmt->bindValue(':commenter_name', $commenter_name, PDO::PARAM_STR);
$stmt->bindValue(':comments', $comments, PDO::PARAM_STR);
$stmt->execute();

//リダイレクト
header('Location: detail.php');
exit;
?>