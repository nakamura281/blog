<?php
include __DIR__ . ('/../app/Lib/SqlSelect.php');
include __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Lib\Session;

$email = filter_input(INPUT_POST, "email");
$pass = filter_input(INPUT_POST, "pass");

session_start();

$session = Session::getInstance();

/* バリデーション */
//passwordかemailが未入力
if (empty($email) || empty($pass)) {
  $session->appendError('パスワードとメールアドレスを入力してください!');
  $request = new Action;
  $action = $request->redirect1('user/siginin.php');
}

// バリデーションクリア（エラーメッセージなし）の場合
$obj = new SqlSelect();
$sql = "SELECT * FROM users WHERE email = :email ORDER BY id DESC";
$member = $obj->select1($sql , $email);

//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($pass , $member[0]["password"])) {
  //DBのユーザー情報をセッションに保存
  $formInputs = [
    'userId' => $member[0]['id'],
    'userName' => $member[0]['name'],
  ];  
  $session->setFormInputs($formInputs);

  //トップページへリダイレクト
  $request = new Action;
  $action = $request->redirect('index.php');
}
//メールアドレスまたはパスワードが違う
$session->appendError('メールアドレスまたは<br />パスワードが違います');
// バリデーションを持ってログインページへ
$request = new Action;
$action = $request->redirect1('user/siginin.php');
 