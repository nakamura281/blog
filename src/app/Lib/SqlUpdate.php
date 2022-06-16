<?php
/**
 * データベースのデータをアップデートする時に使うクラス
 */
include_once  __DIR__ . ('/SqlConnect.php');
class SqlUpdate
{
  function update($sql , $id , $title , $content)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(":id" , $id , PDO:: PARAM_STR);
    $stmt->bindParam(":title" , $title , PDO:: PARAM_STR);
    $stmt->bindParam(":content" , $content , PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }
}
?>