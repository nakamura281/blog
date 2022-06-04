<?php
include  __DIR__ . ('/function.php');
class Delete
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