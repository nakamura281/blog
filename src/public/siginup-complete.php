<?php
include __DIR__ . ('/Validation.php');
include __DIR__ . ('/Action.php');
include __DIR__ . ('/SqlSelect.php');
include __DIR__ . ('/SqlInsert.php');

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
  $obj = new SqlSelect();
  $sql = "SELECT * from users where email=:email";
  $user = $obj->select1($sql , $email);
  
  $validations = new Validation;
  $errors = $validations->errors($user , $name , $email);

  // バリデーションクリア（エラーメッセージなし）の場合
  if (empty($errors)) {
    // パスワードの暗号化
    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

    // ユーザー登録処理
    $obj = new SqlInsert();
    $sql = "INSERT INTO users (
    name , email , password , created_at , updated_at	
    ) VALUES (
    :name , :email , :password , now() , now()
    )";
    $contacts = $obj->insert2($sql , $name , $email , $hash_pass);

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