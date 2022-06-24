<?php 
include __DIR__ . ('/../app/Lib/Action.php');
include_once (__DIR__ . '/../vendor/autoload.php');

use App\Infrastructure\CommentDao;

$commenter_name = filter_input(INPUT_POST, "commenter_name");
$comments = filter_input(INPUT_POST, "comments");
$blog_id = filter_input(INPUT_POST, "id");
$user_id = filter_input(INPUT_POST, "user_id");

$obj = new CommentDao();
$stmt = $obj->addToDb($user_id, $blog_id, $commenter_name, $comments);
//リダイレクト
$request = new Action;
$action = $request->redirect('detail.php');
?>