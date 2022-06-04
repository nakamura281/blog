<?php
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

class action
{
  //リダイレクト
  function redirect(string $redirectPath): void
  {
	  header("Location: " . $redirectPath);
	  exit;
  }
  function redirect1(string $redirectPath): void
  {
    include "$redirectPath";
    exit;
  }
}

class validation
{
  function errors($user , $name , $email)
  {
    if ($user) {
      return $errors['email'] = '※このメールアドレスは既に使用されています';
    }
  
    //passwordとユーザー名が未入力
    if (empty($name)) {
      return $errors['name'] ='「ユーザー名」が記入されていません!';
    }
  
    if (empty($email)) {
      return $errors['email'] ='「Email」が記入されていません!';
    }
  
  }
}
?>