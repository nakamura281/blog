<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\UserName;

final class UserNameTest extends TestCase
{
    /**
     * @test
     */
    public function ユーザー名が1文字以上20文字以下の場合_例外が発生しないこと(): void
    {
        $userName = '12345678901234567890';

        $actual = new UserName($userName);

        $this->assertSame($userName, $actual->value());
    }

    /**
     * @test
     */
    public function ユーザー名が21文字以上の場合_例外が発生すること(): void
    {
        $this->expectException(\Exception::class);

        $userName = '123451234512345123451';

        new UserName($userName);
    }

    /**
     * @test
     */
    public function ユーザー名が0文字の場合_例外が発生すること(): void
    {
        $this->expectException(\Exception::class);

        $userName = '';

        new UserName($userName);
    }
}