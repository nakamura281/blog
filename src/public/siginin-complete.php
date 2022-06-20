<?php
include __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Lib\Session;
use App\Infrastructure\UserDao;

$email = filter_input(INPUT_POST, "email");
$pass = filter_input(INPUT_POST, "pass");

$session = Session::getInstance();

/* バリデーション */
//passwordかemailが未入力
if (empty($email) || empty($pass)) {
  $session->appendError('パスワードとメールアドレスを入力してください!');
  $request = new Action;
  $action = $request->redirect1('user/siginin.php');
}

// バリデーションクリア（エラーメッセージなし）の場合
$userDao = new UserDao();
$member = $userDao->findByEmail($email);


if (!password_verify($pass, $member['password'])) {
  $_SESSION['errors'][] = 'メールアドレスまたは<br />パスワードが違います';
  // バリデーションを持ってログインページへ
  $request = new Action;
  $action = $request->redirect1('user/siginin.php');
}

$_SESSION['formInputs']['userId'] = $member['id'];
$_SESSION['formInputs']['name'] = $member['name'];
//トップページへリダイレクト
$request = new Action;
$action = $request->redirect('index.php');

 