<?php
namespace App\Usecase\UseCaseInput;

final class SearchInput
{
    private $search_word;

    public function __construct(string $search_word)
    {
      $this->search_word = $search_word;
    }

    public function search(): string
    {
      return $this->search_word;
    }
}