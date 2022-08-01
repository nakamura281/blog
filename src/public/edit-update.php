<?php 
include_once __DIR__ . ('/../app/Lib/Action.php');
include_once __DIR__ . ('/../vendor/autoload.php');

use App\Usecase\UseCaseInput\EditInput;
use App\Usecase\UseCaseInteractor\EditInteractor;
use App\Domain\ValueObject\BlogTitle;
use App\Domain\ValueObject\BlogContent;

session_start();
$request = new Action;

$blog_id = filter_input(INPUT_POST, "id");
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");

try {
  $blogTitle = new BlogTitle($title);
  $blogContent = new BlogContent($content);
  $editInput = new EditInput($blog_id, $blogTitle, $blogContent);
  $useCase = new EditInteractor($editInput);
  $editOutput = $useCase->handler();

  if (!$editOutput->isSuccess()) {
    throw new Exception($editOutput->message());
  } 
} catch (Exception $e) {
  $_SESSION['blog_id'] = $blog_id;
  $_SESSION['errors'][] = $e->getMessage();
  $request->redirect('edit.php');
}

$message = $editOutput->message();

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
          <p><?php echo $message; ?></p>
        <button type="submit">次へ</button>
      </li>  
    </div>
    <input type="hidden" name="id" value="<?= $blog_id ?>">
  </form> 
</body>