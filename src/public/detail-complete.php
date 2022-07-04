<?php 
include __DIR__ . ('/../app/Lib/Action.php');
include_once (__DIR__ . '/../vendor/autoload.php');

use App\Usecase\UseCaseInput\CommentInput;
use App\Usecase\UseCaseInteractor\CommentInteractor;
use App\Infrastructure\CommentDao;

session_start();

$commenter = filter_input(INPUT_POST, "commenter_name");
$comments = filter_input(INPUT_POST, "comments");
$blog_id = filter_input(INPUT_POST, "id");
$user_id = filter_input(INPUT_POST, "user_id");

//$blog_id,$user_idは100％値が入るので、$commenter,$commentsについてUseCaseをかく
$useCaseInput = new CommentInput($commenter, $comments);
$useCase = new CommentInteractor($useCaseInput);
$useCaseOutput = $useCase->handler();

if (!$useCaseOutput->isSuccess()) {
  $_SESSION['errors'][] = $useCaseOutput->message();
  $_SESSION['id'][] = $blog_id;
  $request = new Action;
  $action = $request->redirect('detail.php');
  exit;
}
$obj = new CommentDao();
$stmt = $obj->addToDb($user_id, $blog_id, $commenter, $comments);
//リダイレクト
$_SESSION['id'][] = $blog_id;
$request = new Action;
$action = $request->redirect('detail.php');
?>