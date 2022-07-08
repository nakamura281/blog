<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<body>
    <main>
      <div style="text-align: center">
        <h1>新規記事</h1>
        <?php if (!empty($errors)): ?>
          <?php foreach ($errors as $error): ?>
            <p class="text-red-600"><?php echo $error; ?></p>
          <?php endforeach; ?>
        <?php endif; ?>
          <form method="post" action="/../create-complete.php">
            <div>
                <p>タイトル</p>
                <input type="text" name="title" >
            </div>
            <div>
                <p>内容</p>
                <textarea rows="10" cols="50" name="content"></textarea>
            </div>
            <div>
                <button type="submit">新規作成</button>
            </div>
          </form>
      </div>   
    </main>
</body>

</html>