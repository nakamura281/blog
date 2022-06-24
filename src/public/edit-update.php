<?php 
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Infrastructure\BlogDao;

$id = filter_input(INPUT_POST, "id");
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

$obj = new BlogDao();
$stmt = $obj->update($id, $title, $content);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
</head>
<body>
  <form method=post action=myArticledetail.php>
    <div style="text-align: center">
      <li>
        <button type="submit">次へ</button>
      </li>  
    </div>
    <input type="hidden" name="id" value="<?= $id ?>">
  </form> 
</body>