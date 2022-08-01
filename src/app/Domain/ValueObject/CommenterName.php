<?php
namespace App\Domain\ValueObject;
use Exception;

final class CommenterName
{

  const INVALID_MESSAGE = '名前は20文字以下にしてください';

  private $commenterName;

  public function __construct(String $commenterName)
  {
      if ($this->isInvalid($commenterName)) {
        throw new Exception(self::INVALID_MESSAGE);
      }

      $this->commenterName = $commenterName;
  }

  public function commenterName(): String
  {
      return $this->commenterName;
  }

  private function isInvalid(string $commenterName): bool
  {
      return mb_strlen($commenterName) > 20;
  }
}