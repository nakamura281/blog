<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\UserName;

final class UserNameTest extends TestCase
{
    /**
     * @test
     */
    public function ユーザー名が0文字以上20文字以下の場合_例外が発生しないこと(): void
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
        $userName = '123451234512345123451';
        
        $this->expectException(\Exception::class);

        new UserName($userName);
    }

    /**
     * @test
     */
    public function ユーザー名が0文字の場合_例外が発生すること(): void
    {
        $userName = '';
        
        $this->expectException(\Exception::class);

        new UserName($userName);
    }
}