<?php
namespace App\Infrastructure;

include_once  __DIR__ . ('/../../vendor/autoload.php');

use PDO;

if (class_exists("BlogDao")) return;
/**
 * コメントのDBを操作する
 */
final class BlogDao extends Dao
{
  /**
   * DBのテーブル名 
   */
  const TABLE_NAME = 'blogs';

  /**
   * blogを取得する
   */
  public function searchWord($search_word)
  {
    if ($search_word == "") {
      $sql = "SELECT * FROM blogs";
    } else {
      $sql = "SELECT * FROM blogs WHERE content LIKE '%" . $search_word . "%' OR title LIKE '%" . $search_word . "%'";
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }

  public function searchById($id)
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE id = :id",
      self::TABLE_NAME
    );
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }

  public function searchByUserId($user_id)
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE user_id = :user_id ORDER BY id DESC",
      self::TABLE_NAME
    );
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":user_id", $user_id, PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }

  /**
   * blogを削除する
   */
  public function delete($id)
  {
    $sql = sprintf(
      "DELETE FROM %s WHERE id = :id",
      self::TABLE_NAME
    );
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }

  /**
   * blogを追加する
   */
  public function insert($user_id, $title, $content)
  { 
    $sql = sprintf(
      "INSERT INTO %s (
        user_id, title, content, created_at, updated_at	
        ) VALUES (
        :user_id, :title, :content, now(), now()
      )",
      self::TABLE_NAME
    );
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":user_id", $user_id, PDO:: PARAM_STR);
    $stmt->bindParam(":title", $title, PDO:: PARAM_STR);
    $stmt->bindParam(":content", $content, PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }

  /**
   * blogを編集する
   */
  public function update($id, $title, $content)
  {
    $sql = sprintf(
      "UPDATE %s SET title = :title, content = :content, updated_at = now() WHERE  id = :id",
      self::TABLE_NAME
    );
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":id", $id , PDO:: PARAM_STR);
    $stmt->bindParam(":title", $title , PDO:: PARAM_STR);
    $stmt->bindParam(":content", $content , PDO:: PARAM_STR);
    $stmt->execute(); 
    return $stmt;
  }

}  