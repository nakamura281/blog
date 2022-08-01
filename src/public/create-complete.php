<?php
include __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Usecase\UseCaseInput\CreateInput;
use App\Usecase\UseCaseInteractor\CreateInteractor;
use App\Domain\ValueObject\BlogTitle;
use App\Domain\ValueObject\BlogContent;


session_start();
$request = new Action;

$user_id = $_SESSION['formInputs']['userId'];
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

try {
  $blogTitle = new BlogTitle($title);
  $blogContent = new BlogContent($content);
  $createInput = new CreateInput($user_id, $blogTitle, $blogContent);
  $useCase = new CreateInteractor($createInput);
  $createOutput = $useCase->handler();

  if ($createOutput->isSuccess()) {
    $action = $request->redirect('mypage.php');
  } else {
    throw new Exception($createOutput->message());
  }
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  $action = $request->redirect('/post/create.php');
}





?>