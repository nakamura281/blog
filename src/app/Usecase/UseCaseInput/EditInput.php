<?php
namespace App\Usecase\UseCaseInput;

use App\Domain\ValueObject\BlogContent;
use App\Domain\ValueObject\BlogTitle;

final class EditInput
{
    private $blog_id;
    private $title;
    private $content;

    public function __construct(string $blog_id, BlogTitle $title, BlogContent $content)
    {
      $this->blog_id = $blog_id;
      $this->title = $title;
      $this->content = $content;

    }

    public function blogId(): string
    {
      return $this->blog_id;
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