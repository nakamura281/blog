<?php 
include_once __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Usecase\UseCaseInput\EditInput;
use App\Usecase\UseCaseInteractor\EditInteractor;

session_start();

$blog_id = filter_input(INPUT_POST, "id");
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

$createInput = new EditInput($blog_id, $title, $content);
$useCase = new EditInteractor($createInput);
$createOutput = $useCase->handler();

$request = new Action;

if (!$createOutput->isSuccess()) {
  $_SESSION['blog_id'] = $blog_id;
  $action = $request->redirect('edit.php');
  exit;
} 

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
    <input type="hidden" name="id" value="<?= $blog_id ?>">
  </form> 
</body>