<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">  
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>こんにちは！</h1>
      <?php if (isset($_SESSION['formInputs']['userId'])) : ?>
        <ul>
        <li><a href="index.php">ホーム</a></li>
        <li><a href="mypage.php">マイページ</a></li>
        <li><a href="user/siginout.php">ログアウト</a></li>
        </ul>
      <?php else : ?>
        <ul>
        <li><a href="user/login.php">ログイン</a></li>
        <li><a href="user/signup.php">ユーザー登録</a></li>
        </ul>
      <?php endif ?>
  </header>
</body>  