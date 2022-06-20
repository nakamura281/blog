<?php
include __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Infrastructure\BlogDao;

session_start();

$user_id = $_SESSION['formInputs']['userId'];
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

$obj = new BlogDao();
//データベースに追加
$stmt = $obj->insert($user_id , $title , $content);

//マイページへリダイレクト
$request = new Action;
$action = $request->redirect('mypage.php');
?>