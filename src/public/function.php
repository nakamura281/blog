<?php
class sql_connect 
{
  const DBUSERNAME = "root";
  const DBPASSWORD = "password";
  function pdo(){
    $pdo = new PDO("mysql:host=mysql; dbname=blog; charset=utf8", self::DBUSERNAME, self::DBPASSWORD);
    return $pdo;
  }
  //SELECT文のとき
  function select($sql)
  {
    $hoge=$this->pdo();
    $stmt = $hoge->prepare($sql);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }
  function select1($sql , $email)
  {
    $hoge=$this->pdo();
    $stmt = $hoge->prepare($sql);
    $stmt->bindParam(":email" , $email , PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }
  function select2($sql , $id)
  {
    $hoge=$this->pdo();
    $stmt = $hoge->prepare($sql);
    $stmt->bindParam(":id" , $id , PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }
  function select3($sql , $user_id)
  {
    $hoge=$this->pdo();
    $stmt = $hoge->prepare($sql);
    $stmt->bindParam(":user_id" , $user_id , PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }
  //INSERT文のとき
  function insert($sql , $user_id , $title , $content)
  {
    $hoge=$this->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(":user_id" , $user_id , PDO:: PARAM_STR);
    $stmt->bindParam(":title" , $title , PDO:: PARAM_STR);
    $stmt->bindParam(":content" , $content , PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }
  function insert1($sql , $user_id , $commenter_name , $comments)
  {
    $hoge=$this->pdo();
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
    $hoge=$this->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hash_pass, PDO::PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }
  //DERETE文の時
  function delete($sql , $id)
  {
    $hoge=$this->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(":id" , $id , PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }
  //update文の時
  function update($sql , $id , $title , $content)
  {
    $hoge=$this->pdo();
    $stmt=$hoge->prepare($sql);
    $stmt->bindParam(":id" , $id , PDO:: PARAM_STR);
    $stmt->bindParam(":title" , $title , PDO:: PARAM_STR);
    $stmt->bindParam(":content" , $content , PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
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