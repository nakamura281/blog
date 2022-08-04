<?php
namespace App\Domain\ValueObject;
use Exception;

final class BlogContent
{
  const INVALID_MESSAGE = '本文は100文字以下にしてください';

  private $content;

  public function __construct(string $content)
  {
      if ($this->isInvalid($content)) {
        throw new Exception(self::INVALID_MESSAGE);
      }

      $this->content = $content;
  }

  public function content(): string
  {
      return $this->content;
  }

  private function isInvalid(string $content): bool
  {
      return mb_strlen($content) > 100;
  }
}