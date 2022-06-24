<?php
namespace App\Infrastructure;

include_once  __DIR__ . ('/../../vendor/autoload.php');

use PDO;

if (class_exists("CommentDao")) return;
/**
 * コメントのDBを操作する
 */
final class CommentDao extends Dao
{
  /**
   * DBのテーブル名 
   */
  const TABLE_NAME = 'comments';

  /**
   * コメントを取得
   */
  public function searchById(int $id): array
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE blog_id = :id",
      self::TABLE_NAME
    );
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO:: PARAM_STR);
    $stmt->execute(); 
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
  }

  /**
   * コメントの追加
   */
  public function addToDb(int $user_id, int $blog_id, string $commenter_name, string $comments): void
  {
    $sql = sprintf(
      "INSERT INTO %s (
        user_id, blog_id, commenter_name, comments, created_at, updated_at	
        ) VALUES (
        :user_id, :blog_id, :commenter_name, :comments, now(), now()
      )",
      self::TABLE_NAME
    );
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":user_id", $user_id, PDO:: PARAM_STR);
    $stmt->bindParam(':blog_id', $blog_id, PDO::PARAM_STR);
    $stmt->bindParam(":commenter_name", $commenter_name, PDO:: PARAM_STR);
    $stmt->bindParam(":comments", $comments, PDO:: PARAM_STR);
    $stmt->execute(); 
  }

}
