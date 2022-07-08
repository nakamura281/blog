<?php
include __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Usecase\UseCaseInput\CreateInput;
use App\Usecase\UseCaseInteractor\CreateInteractor;

session_start();

$user_id = $_SESSION['formInputs']['userId'];
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

$createInput = new CreateInput($user_id, $title, $content);
$useCase = new CreateInteractor($createInput);
$createOutput = $useCase->handler();

$request = new Action;

if ($createOutput->isSuccess()) {
  $action = $request->redirect('mypage.php');
} else {
  $_SESSION['errors'][] = $createOutput->message();
  $action = $request->redirect('/post/create.php');
}

?>