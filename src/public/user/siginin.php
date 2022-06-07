<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">

<body>
  <div style="text-align: center">
    <h1>ログインページ</h1>
    <form action="/../siginin-complete.php" method="post">
      <div>
        <input type="text" name="email" placeholder="Emailアドレス">
      </div>
      <div>
          <input type="password" name="pass" placeholder="パスワード">
      </div>
      <div>
        <p><?php echo $errors['pass']; ?></p>
      </div>
      <input type="submit" value="ログイン">
    </form>
    <div>
      <a href="./siginup.php">アカウント作成</a>
    </div>
  </div>
</body>