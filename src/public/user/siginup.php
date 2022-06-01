<?php
if (isset($_SESSION['id'])) {
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<body>
    <main>
      <div style="text-align: center">
        <h1>会員登録</h1>
        <p><?php echo $errors; ?></p>
        <form method="post" action="/../siginup-complete.php">
            <div>
                <input type="text" name="name" id="name" placeholder="ユーザー名" >
            </div>
            <div>
                <input type="email" name="email" id="email" placeholder="Emailアドレス" >
            </div>
            <div>
                <input type="password" name="pass" id="pass" placeholder="パスワード" >
            </div>
            <div>
                <input type="password" name="pass_check" id="pass_check" placeholder="パスワード（確認用）" >
            </div>
            <div>
                <button type="submit">アカウント作成</button>
            </div>
            <div>
                <a href="./siginin.php">ログイン画面へ</a>
            </div>
        </form>
      </div>   
    </main>
</body>

</html>