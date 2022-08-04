<?php
namespace App\Usecase\UseCaseInput;

use App\Domain\ValueObject\CommenterName;
use App\Domain\ValueObject\CommentContent;

final class CommentInput
{
    private $commenter;
    private $comments;

    public function __construct(CommenterName $commenter, CommentContent $comments)
    {
      $this->commenter = $commenter;
      $this->comments = $comments;
    }

    public function commenter(): CommenterName
    {
      return $this->commenter;
    }

    public function comments(): CommentContent
    {
      return $this->comments;
    }
}