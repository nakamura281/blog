<?php
include_once __DIR__ . ('/../../vendor/autoload.php');

use App\Lib\Session;

$session = Session::getInstance();
$errors = $session->popAllErrors();
$successRegistedMessage = $session->getMessage();
?>
<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">

<body>
  <div style="text-align: center">
    <h1>ログインページ</h1>
    <h3 class="mb-5 text-xl"><?php echo $successRegistedMessage; ?></h3>
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <p class="text-red-600"><?php echo $error; ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
    <form action="/../siginin-complete.php" method="post">
      <div>
        <input type="text" name="name" placeholder="ユーザー名">
      </div>
      <p>
        <input type=“text” name="email" type="email" placeholder="Email">
      </p>
      <div>
          <input type="password" name="pass" placeholder="パスワード">
      </div>
      <input type="submit" value="ログイン">
    </form>
    <div>
      <a href="./siginup.php">アカウント作成</a>
    </div>
  </div>
</body>