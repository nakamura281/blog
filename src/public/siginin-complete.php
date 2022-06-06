<?php
session_start();
include __DIR__ . ('/SqlSelect.php');
include __DIR__ . ('/Action.php');
$email = filter_input(INPUT_POST, "email");
$pass = filter_input(INPUT_POST, "pass");

/* バリデーション */
//passwordかemailが未入力
if (empty($email) || empty($pass)) {
  $errors['pass'] ='パスワードとメールアドレスを入力してください!';
  $request = new Action;
  $action = $request->redirect1('user/siginin.php');
}

// バリデーションクリア（エラーメッセージなし）の場合
$obj = new SqlSelect();
$sql = "SELECT * FROM users WHERE email = :email ORDER BY id DESC";
$member = $obj->select1($sql , $email);

//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['pass'] , $member[0]["password"])) {
  //DBのユーザー情報をセッションに保存
  $_SESSION['id'] = $member[0]['id'];
  $_SESSION['name'] = $member[0]['name'];

  //トップページへリダイレクト
  $request = new Action;
  $action = $request->redirect('index.php');
}
//メールアドレスまたはパスワードが違う
$errors['pass'] = 'メールアドレスまたはパスワードが違います!';
// バリデーションを持ってログインページへ
$request = new Action;
$action = $request->redirect1('user/siginin.php');
 