<?php
include __DIR__ . ('/function.php');
$obj = new sql_connect();
$sql = "SELECT * FROM blogs WHERE id = :id ";
$contacts = $obj->select2($sql , $id);
?>
<!DOCTYPE html>
<html lang="ja">
<meta charset="utf-8">
<body>
<main>
  <?php foreach($contacts as $row) : ?>
    <form method=post action=edit-update.php>
      <div style="text-align: center">
        <li>
          <h3>編集</h3>
          <a>title</a><br>
          <input name="title" value="<?php echo $row["title"]; ?>"/><br>
          <a>内容</a><br>
          <textarea rows="10" cols="50" name="content" ><?php echo $row["content"]; ?></textarea><br>
          <button type="submit">編集</button>
        </li>  
      </div>
      <input type="hidden" name="id" value="<?= $row['id']?>">
    </form>
  <?php endforeach; ?>
</main>    
</body>