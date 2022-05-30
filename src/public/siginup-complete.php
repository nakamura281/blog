<?php
//データベース接続
$dbUserName = "root";
$dbPassword = "password";
$pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", $dbUserName, $dbPassword);

// フォームから値が入力された場合
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = filter_input(INPUT_POST, 'name');
  $email = filter_input(INPUT_POST, 'email');
  $pass = filter_input(INPUT_POST, 'pass');
  $pass_check = filter_input(INPUT_POST, 'pass_check');

  /* バリデーション */
  // 確認用パスワードとの一致
  if ($pass !== $pass_check) {
    $errors['pass_check'] = '※確認用パスワードが一致しません';
  }

  // メールアドレスの重複
  $sql = 'select * from users where email=:email';
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':email', $email, PDO::PARAM_STR);
  $statement->execute();
  $user = $statement->fetch();

  if ($user) {
    $errors['email'] = '※このメールアドレスは既に使用されています';
  }

  //passwordとユーザー名が未入力
  if (empty($name)) {
    $errors['name'] ='「ユーザー名」が記入されていません!';
  }

  if (empty($email)) {
    $errors['email'] ='「Email」が記入されていません!';
  }


  // バリデーションクリア（エラーメッセージなし）の場合
  if (empty($errors)) {
    // パスワードの暗号化
    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

    // ユーザー登録処理
    $sql = "INSERT INTO users (
    name , email , password , created_at , updated_at	
    ) VALUES (
    :name , :email , :password , now() , now()
    )";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $hash_pass, PDO::PARAM_STR);
    $stmt->execute();

    // サインインページへリダイレクト
    header('Location: user/siginin.php');
    exit;
  } else {
    // バリデーションを持って登録画面へ
    include 'user/siginup.php';
    exit;
  }
}
?>