<?php
class Validation
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