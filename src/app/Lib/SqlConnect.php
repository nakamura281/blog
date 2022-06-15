<?php
/**
 * データベースに接続するクラス
 */
class SqlConnect 
{
  const DBUSERNAME = "root";
  const DBPASSWORD = "password";
  function pdo()
  {
    $pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", self::DBUSERNAME, self::DBPASSWORD);
    return $pdo;
  }
}
?>