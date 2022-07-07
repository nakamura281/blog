<?php
namespace App\Usecase\UseCaseInteractor;

use App\Usecase\UseCaseInput\CreateInput;
use App\Usecase\UseCaseOutput\CreateOutput;
use App\Infrastructure\BlogDao;

final class CreateInteractor
{
    const FAILED_MESSAGE = 'タイトルまたは内容を入力してください';
    const COMPLETED_MESSAGE = '投稿しました';

    private $createInput;

    public function __construct(CreateInput $createInput)
    {
        $this->createInput = $createInput;
    }

    public function handler(): CreateOutput
    {
        $blogDao = new BlogDao();
        $user_id = $this->createInput->userId();
        $title = $this->createInput->title();
        $content = $this->createInput->content();

        if (empty($title) || empty($content)) {
          return new CreateOutput(false, self::FAILED_MESSAGE);
        }

        $blogDao->insert($user_id, $title, $content);
        return new CreateOutput(true, self::COMPLETED_MESSAGE);
    }
}