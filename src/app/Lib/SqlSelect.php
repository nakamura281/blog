<?php
/**
 * データベースからデータを取得する時に使うクラス
 */
include_once  __DIR__ . ('/Sqlconnect.php');
class SqlSelect
{
  function select($sql)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt = $hoge->prepare($sql);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }
  function select1($sql , $email)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt = $hoge->prepare($sql);
    $stmt->bindParam(":email" , $email , PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }
  function select2($sql , $id)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt = $hoge->prepare($sql);
    $stmt->bindParam(":id" , $id , PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }
  function select3($sql , $user_id)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt = $hoge->prepare($sql);
    $stmt->bindParam(":user_id" , $user_id , PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }
}
?>