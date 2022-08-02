<?php
include (__DIR__ . '/../app/Lib/Validation.php');
include (__DIR__ . '/../app/Lib/Action.php');
include_once (__DIR__ . '/../vendor/autoload.php');

use App\Usecase\UseCaseInput\SignUpInput;
use App\Usecase\UseCaseInteractor\SignUpInteractor;
use App\Domain\ValueObject\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\InputPassword;

// フォームから値が入力された場合
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = filter_input(INPUT_POST, 'name');
  $email = filter_input(INPUT_POST, 'email');
  $pass = filter_input(INPUT_POST, 'pass');
  $pass_check = filter_input(INPUT_POST, 'pass_check');

  /* バリデーション */
  // 確認用パスワードとの一致
  try {
    session_start();
    if (empty($pass) || empty($pass_check)) {
        throw new Exception('パスワードを入力してください');
    }
    if ($pass !== $pass_check) {
        throw new Exception('パスワードが一致しません');
    }

    $userName = new UserName($name);
    $userEmail = new Email($email);
    $userPassword = new InputPassword($pass);
    $useCaseInput = new SignUpInput($userName, $userEmail, $userPassword);
    $useCase = new SignUpInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if (!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    $request = new Action;
    $request->redirect('user/siginin.php');
  } catch (Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['formInputs']['name'] = $name;
    $_SESSION['formInputs']['email'] = $email;
    // バリデーションを持って登録画面へ
    $request = new Action;
    $request->redirect('user/siginup.php');
  }
  
}
?>