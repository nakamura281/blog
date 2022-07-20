<?php
namespace App\Usecase\UseCaseInteractor;

use App\Usecase\UseCaseInput\SearchInput;
use App\Usecase\UseCaseOutput\SearchOutput;
use App\Infrastructure\BlogDao;


final class SearchInteractor
{
    const FAILED_MESSAGE = '検索できません!';
    const COMPLETED_MESSAGE = 'search...';

    private $searchInput;

    public function __construct(SearchInput $searchInput)
    {
        $this->searchInput = $searchInput;
    }

    public function handler(): SearchOutput
    {
        $blogDao = new BlogDao();
        $search = $this->searchInput->search();
        $contacts = $blogDao->searchWord($search);

        if (empty($contacts)) {
          return new SearchOutput(false, self::FAILED_MESSAGE);
        }

        return new SearchOutput(true, self::COMPLETED_MESSAGE);
    }
}