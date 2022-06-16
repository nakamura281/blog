<?php
include (__DIR__ . '/../app/Lib/Validation.php');
include (__DIR__ . '/../app/Lib/Action.php');
include (__DIR__ . '/../app/Infrastructure/UserDao.php');
include_once (__DIR__ . '/../vendor/autoload.php');

use App\Lib\Session;
use App\Lib\SessionKey;

// フォームから値が入力された場合
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = filter_input(INPUT_POST, 'name');
  $email = filter_input(INPUT_POST, 'email');
  $pass = filter_input(INPUT_POST, 'pass');
  $pass_check = filter_input(INPUT_POST, 'pass_check');

  /* バリデーション */
  // 確認用パスワードとの一致
  if ($pass !== $pass_check) {
    $errors = '※確認用パスワードが一致しません';
  }
  
  $validations = new Validation;
  $errors = $validations->errors($user , $name , $email);

  $session = Session::getInstance();
  if (isset($errors)) {
    $session->appendError($errors);
  }
  
  if ($session->existsErrors()) {
    $formInputs = [
        'mail' => $mail,
        'userName' => $userName,
    ];
    $formInputsKey = new SessionKey(SessionKey::FORM_INPUTS_KEY);
    $session->setFormInputs($formInputsKey, $formInputs);
    $request = new Action;
    $action = $request->redirect1('user/siginup.php');
  }
  //バリデーションクリア（エラーメッセージなし）の場合
  if (empty($errors)) {
    $userDao = new UserDao();
    $user = $userDao->findByEmail($email);

    if (!is_null($user)) {
      $_SESSION['errors'][] = 'すでに登録済みのメールアドレスです';
    }

    $userDao->create($name, $email, $pass);

    // サインインページへリダイレクト
    $request = new Action;
    $action = $request->redirect('user/siginin.php');
  } else {
    // バリデーションを持って登録画面へ
    $request = new Action;
    $action = $request->redirect1('user/siginup.php');
  }
}
?>