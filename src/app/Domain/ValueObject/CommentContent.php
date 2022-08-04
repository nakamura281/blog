<?php
namespace App\Domain\ValueObject;
use Exception;

final class CommentContent
{
  const INVALID_MESSAGE = '本文は100文字以下にしてください';

  private $content;

  public function __construct(String $content)
  {
      if ($this->isInvalid($content)) {
        throw new Exception(self::INVALID_MESSAGE);
      }

      $this->content = $content;
  }

  public function commentContent(): String
  {
      return $this->content;
  }

  private function isInvalid(string $content): bool
  {
      return mb_strlen($content) > 100;
  }
}