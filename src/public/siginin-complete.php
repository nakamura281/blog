<?php
session_start();
$email = filter_input(INPUT_POST, "email");
$pass = filter_input(INPUT_POST, "pass");

/* バリデーション */
//passwordかemailが未入力
if (empty($email) || empty($pass)) {
  $errors['pass'] ='パスワードとメールアドレスを入力してください!';
}

// バリデーションクリア（エラーメッセージなし）の場合
if (empty($errors)) {
  
  $dbUserName = "root";
  $dbPassword = "password";
  $pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

  $sql = "SELECT * FROM users WHERE email = :email ORDER BY id DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':email', $email);
  $stmt->execute(); 
  $member = $stmt->fetchAll(PDO::FETCH_ASSOC);

  //指定したハッシュがパスワードにマッチしているかチェック
  if (password_verify($_POST['pass'] , $member[0]["password"])) {
    //DBのユーザー情報をセッションに保存
    $_SESSION['id'] = $member[0]['id'];
    $_SESSION['name'] = $member[0]['name'];

    //トップページへリダイレクト
    header('Location: index.php');
    exit;
  }
  //メールアドレスまたはパスワードが違う
  $errors['pass'] = 'メールアドレスまたはパスワードが違います!';
  // バリデーションを持ってログインページへ
  include 'user/siginin.php';
  exit;
} 
// バリデーションを持ってログインページへ
include 'user/siginin.php';
exit;
 