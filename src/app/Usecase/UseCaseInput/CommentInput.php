<?php
namespace App\Usecase\UseCaseInput;

final class CommentInput
{
    private $commenter;
    private $comments;

    public function __construct(string $commenter, string $comments)
    {
      $this->commenter = $commenter;
      $this->comments = $comments;
    }

    public function commenter(): string
    {
      return $this->commenter;
    }

    public function comments(): string
    {
      return $this->comments;
    }
}