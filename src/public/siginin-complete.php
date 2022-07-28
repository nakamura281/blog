<?php
include_once __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Usecase\UseCaseInput\SignInInput;
use App\Usecase\UseCaseInteractor\SignInInteractor;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\InputPassword;

try {
  session_start();
  $email = filter_input(INPUT_POST, "email");
  $pass = filter_input(INPUT_POST, "pass");
  $request = new Action;

  /* バリデーション */
  //passwordかemailが未入力
  if (empty($email) || empty($pass)) {
    throw new Exception('パスワードとメールアドレスを入力してください!');
  }

  // バリデーションクリア（エラーメッセージなし）の場合
  $userEmail = new Email($email);
  $inputPassword = new InputPassword($pass);
  $useCaseInput = new SignInInput($userEmail, $inputPassword);
  $useCase = new SignInInteractor($useCaseInput);
  $useCaseOutput = $useCase->handler();

  if ($useCaseOutput->isSuccess()) {
    $action = $request->redirect('index.php');
  } else {
    throw new Exception($useCaseOutput->message());
  }
} catch (Exception $e) {
  $_SESSION['errors'][] = $e->getMessage();
  $request->redirect('user/siginin.php');
}  
?>