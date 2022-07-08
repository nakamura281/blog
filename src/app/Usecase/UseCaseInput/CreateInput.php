<?php
namespace App\Usecase\UseCaseInput;

final class CreateInput
{
    private $user_id;
    private $title;
    private $content;


    public function __construct(string $user_id, string $title, string $content)
    {
      $this->user_id = $user_id;
      $this->title = $title;
      $this->content = $content;
    }

    public function userId(): string
    {
      return $this->user_id;
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