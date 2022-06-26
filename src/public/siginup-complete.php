<?php
include (__DIR__ . '/../app/Lib/Validation.php');
include (__DIR__ . '/../app/Lib/Action.php');
include_once (__DIR__ . '/../vendor/autoload.php');

use App\Usecase\UseCaseInput\SignUpInput;
use App\Usecase\UseCaseInteractor\SignUpInteractor;

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
    $useCaseInput = new SignUpInput($name, $email, $pass);
    $useCase = new SignUpInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if (!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['errors'][] = $useCaseOutput->message();
    // サインインページへリダイレクト
    $request = new Action;
    $action = $request->redirect('user/siginin.php');
  } catch (Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['formInputs']['name'] = $name;
    $_SESSION['formInputs']['email'] = $email;
    // バリデーションを持って登録画面へ
    $request = new Action;
    $action = $request->redirect1('user/siginup.php');
  }
  
}
?>