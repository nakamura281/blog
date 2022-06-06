<?php
include  __DIR__ . ('/Sqlconnect.php');
class SqlInsert
{
  function insert($sql , $user_id , $title , $content)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(":user_id" , $user_id , PDO:: PARAM_STR);
    $stmt->bindParam(":title" , $title , PDO:: PARAM_STR);
    $stmt->bindParam(":content" , $content , PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }
  function insert1($sql , $user_id , $commenter_name , $comments)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(":user_id" , $user_id , PDO:: PARAM_STR);
    $stmt->bindParam(':blog_id', $blog_id, PDO::PARAM_STR);
    $stmt->bindParam(":commenter_name", $commenter_name , PDO:: PARAM_STR);
    $stmt->bindParam(":comments", $comments , PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }
  function insert2($sql , $name , $email , $hash_pass)
  {
    $obj = new SqlConnect();
    $hoge = $obj->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hash_pass, PDO::PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }
}