<?php
namespace App\Infrastructure;

include_once  __DIR__ . ('/../../vendor/autoload.php');
use App\Domain\ValueObject\User\NewUser;
use PDO;

if (class_exists("UserDao")) return;
/**
 * ユーザー情報を操作するDAO
 */
final class UserDao extends Dao
{
  /**
     * DBのテーブル名
     */
    const TABLE_NAME = 'users';

    /**
     * ユーザーを追加する
     */
    public function create(NewUser $user): void
    {
        $hashedPassword = $user->password()->hash();

        $sql = sprintf(
            'INSERT INTO %s (name, email, password, created_at, updated_at) VALUES (:name, :email, :password, now(), now())',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':name', $user->name()->value(), PDO::PARAM_STR);
        $statement->bindValue(':email', $user->email()->value(), PDO::PARAM_STR);
        $statement->bindValue(':password', $hashedPassword->value(), PDO::PARAM_STR);
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