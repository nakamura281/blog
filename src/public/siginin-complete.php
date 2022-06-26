<?php
include_once __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Usecase\UseCaseInput\SignInInput;
use App\Usecase\UseCaseInteractor\SignInInteractor;

session_start();
$email = filter_input(INPUT_POST, "email");
$pass = filter_input(INPUT_POST, "pass");
$request = new Action;

/* バリデーション */
//passwordかemailが未入力
if (empty($email) || empty($pass)) {
  $_SESSION['errors'][] = 'パスワードとメールアドレスを入力してください!';
  $action = $request->redirect('user/siginin.php');
}

// バリデーションクリア（エラーメッセージなし）の場合
$useCaseInput = new SignInInput($email, $pass);
$useCase = new SignInInteractor($useCaseInput);
$useCaseOutput = $useCase->handler();

if ($useCaseOutput->isSuccess()) {
  $action = $request->redirect('index.php');
} else {
  $_SESSION['errors'][] = $useCaseOutput->message();
  $action = $request->redirect('user/siginin.php');
}
?>