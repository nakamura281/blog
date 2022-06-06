<?php
session_start();
include __DIR__ . ('/SqlInsert.php');
include __DIR__ . ('/Action.php');
$user_id = $_SESSION['id'];
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

$obj = new SqlInsert();
//データベースに追加
$sql = "INSERT INTO blogs (
  user_id , title , content , created_at , updated_at	
  ) VALUES (
  :user_id , :title , :content , now() , now()
  )";
$stmt = $obj->insert($sql , $user_id , $title , $content);

//マイページへリダイレクト
$request = new Action;
$action = $request->redirect('mypage.php');
?>