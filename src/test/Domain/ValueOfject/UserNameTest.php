<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\UserName;

final class UserNameTest extends TestCase
{
    /**
     * @test
     */
    public function ユーザー名が20文字以下の場合_例外が発生しないこと(): void
    {
        $actual = new UserName('12345678901234567890');

        $this->assertSame('12345678901234567890', $actual->value());
    }

    /**
     * @test
     */
    public function ユーザー名が21文字以上の場合_例外が発生すること(): void
    {
        $this->expectException(\Exception::class);

        new UserName('123451234512345123451');
    }
}