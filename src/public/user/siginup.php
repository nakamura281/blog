<?php
if (isset($_SESSION['formInputs']['userId'])) {
  header('Location: index.php');
  exit;
}
?>
<?php
include_once __DIR__ . ('/../../app/Lib/Session.php');

session_start();

$session = Session::getInstance();
$errors = $session->popAllErrors();
$formInputs = $session->getFormInputs();

$userName = $formInputs['userName'] ?? '';
$mail = $formInputs['mail'] ?? '';
?>

<!DOCTYPE html
<html lang="ja">
<meta charset="UTF-8">
<body>
    <main>
      <div style="text-align: center">
        <h1>会員登録</h1>
        <?php foreach ($errors as $error): ?>
            <p class="text-red-600"><?php echo $error; ?></p>
        <?php endforeach; ?>
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