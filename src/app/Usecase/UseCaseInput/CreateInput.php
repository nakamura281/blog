<?php
namespace App\Usecase\UseCaseInput;

use App\Domain\ValueObject\BlogContent;
use App\Domain\ValueObject\BlogTitle;

final class CreateInput
{
    private $user_id;
    private $title;
    private $content;


    public function __construct(string $user_id, BlogTitle $title, BlogContent $content)
    {
      $this->user_id = $user_id;
      $this->title = $title;
      $this->content = $content;
    }

    public function userId(): string
    {
      return $this->user_id;
    }

    public function title(): BlogTitle
    {
      return $this->title;
    }

    public function content(): BlogContent
    {
      return $this->content;
    }
}