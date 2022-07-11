<?php
namespace App\Usecase\UseCaseInput;

final class EditInput
{
    private $blog_id;
    private $title;
    private $content;

    public function __construct(string $blog_id, string $title, string $content)
    {
      $this->blog_id = $blog_id;
      $this->title = $title;
      $this->content = $content;

    }

    public function blogId(): string
    {
      return $this->blog_id;
    }

    public function title(): string
    {
      return $this->title;
    }

    public function content(): string
    {
      return $this->content;
    }
}