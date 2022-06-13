<?php
include_once  __DIR__ . ('/SqlConnect.php');
class SqlDelete
{
  function delete($sql , $id)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(":id" , $id , PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }
}
?>