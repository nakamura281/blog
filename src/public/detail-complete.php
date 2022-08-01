<?php 
include __DIR__ . ('/../app/Lib/Action.php');
include_once (__DIR__ . '/../vendor/autoload.php');

use App\Usecase\UseCaseInput\CommentInput;
use App\Usecase\UseCaseInteractor\CommentInteractor;
use App\Infrastructure\CommentDao;
use App\Domain\ValueObject\CommenterName;
use App\Domain\ValueObject\CommentContent;

session_start();
$request = new Action;

$commenter = filter_input(INPUT_POST, "commenter_name");
$comments = filter_input(INPUT_POST, "comments");
$blog_id = filter_input(INPUT_POST, "id");
$user_id = filter_input(INPUT_POST, "user_id");

try {
  $commenterName = new CommenterName($commenter);
  $commentContent = new CommentContent($comments);
  $useCaseInput = new CommentInput($commenterName, $commentContent);
  $useCase = new CommentInteractor($useCaseInput);
  $useCaseOutput = $useCase->handler();

  if (!$useCaseOutput->isSuccess()) {
    throw new Exception($useCaseOutput->message());
  }
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  $_SESSION['blog_id'][] = $blog_id;
  $action = $request->redirect('detail.php');
}
$commentDao = new CommentDao();
$statement = $commentDao->addToDb($user_id, $blog_id, $commenter, $comments);
//リダイレクト
$_SESSION['blog_id'][] = $blog_id;
$_SESSION['message'] = $useCaseOutput->message();
$action = $request->redirect('detail.php');
?>