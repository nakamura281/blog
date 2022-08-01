<?php
namespace App\Domain\ValueObject;
use Exception;

final class BlogTitle
{

  const INVALID_MESSAGE = 'タイトルは20文字以下にしてください';

  private $title;

  public function __construct(String $title)
  {
      if ($this->isInvalid($title)) {
        throw new Exception(self::INVALID_MESSAGE);
      }

      $this->title = $title;
  }

  public function title(): String
  {
      return $this->title;
  }

  private function isInvalid(string $title): bool
  {
      return mb_strlen($title) > 20;
  }
}