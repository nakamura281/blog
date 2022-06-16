<?php
include_once  __DIR__ . ('/../Lib/Sqlconnect.php');
if(class_exists("UserDao")) return;
/**
 * ユーザー情報を操作するDAO
 */
final class UserDao
{
  /**
     * DBのテーブル名
     */
    const TABLE_NAME = 'users';
    private $hoge;

    public function __construct()
    {
        try {
          $obj = new SqlConnect();
          $this->pdo = $obj->pdo();
        } catch (PDOException $e) {
            exit('DB接続エラー:' . $e->getMessage());
        }
    }

    /**
     * ユーザーを追加する
     * @param  string $name
     * @param  string $mail
     * @param  string $password
     */
    public function create(string $name, string $email, string $pass): void
    {
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $sql = sprintf(
            'INSERT INTO %s (name, email, password , created_at , updated_at) VALUES (:name, :email, :password , now() , now())',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * ユーザーを検索する
     * @param  string $mail
     * @return array | null
     */
    public function findByEmail(string $email): ?array
    {
        $sql = sprintf(
            'SELECT * FROM %s WHERE email = :email',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $user ? $user : null;
    }
}