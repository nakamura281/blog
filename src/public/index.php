<?php 
session_start();
include __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Infrastructure\BlogDao;

//ログインしていない時の処理
if (!isset($_SESSION['formInputs']['userId'])) {
  $request = new Action;
  $action = $request->redirect('user/siginin.php');
}
?>
<?php
$obj = new BlogDao();

//検索機能
$search_word = filter_input(INPUT_POST, "word");
$contacts = $obj->searchWord($search_word);

//並び替え機能
foreach ($contacts as $value) {
  $array[] = $value['created_at'];
}
if ($_GET["order"] === "desc") {
  array_multisort($array, SORT_DESC, $contacts);
} elseif ($_GET["order"] === "asc") {
  array_multisort($array, SORT_ASC, $contacts);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">  
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('header.php'); ?>
    <main>
      <span style="text-align: center">
        <h1>blog一覧</h1>
          <form action="index.php" method="post">
          <input type="text" name="word" placeholder="search...">
          <input type="submit" name="search" value="検索">
          </form>
          <a href="index.php?order=desc">新しい順</a>
          <a href="index.php?order=asc">古い順</a>
      </span>
      <div class="blog">
        <?php foreach ($contacts as $row) : ?>
        <li class="blog1">
        <img src="image/world.jpeg" title="空と城">
          <h2><?php echo $row['title']  ; ?></h2>
          <h5><?php echo $row['created_at'] ; ?></h5>
          <p><?php  if (mb_strlen($row['content']) > 15){
                      echo mb_substr($row['content'] , 0 , 15) . "..." ;
                    } else {
                      echo $row['content'] ;
                    } ; ?></p>
          <form action="detail.php" method="post">
            <input type="submit" name="detail" value="記事詳細へ">
            <input type="hidden" name="id" value="<?= $row['id']?>">
          </form>
        </li>
        <?php endforeach; ?>
      </div>
    </main>
</body>