<?php
namespace App\Usecase\UseCaseInteractor;

use App\Usecase\UseCaseInput\EditInput;
use App\Usecase\UseCaseOutput\EditOutput;
use App\Infrastructure\BlogDao;

final class EditInteractor
{
    const FAILED_MESSAGE = 'タイトルまたは内容を入力してください';
    const COMPLETED_MESSAGE = '投稿を編集しました';

    private $createInput;

    public function __construct(EditInput $createInput)
    {
        $this->createInput = $createInput;
    }

    public function handler(): EditOutput
    {
        $blogDao = new BlogDao();
        $blog_id = $this->createInput->blogId();
        $title = $this->createInput->title();
        $content = $this->createInput->content();

        if (empty($title) || empty($content)) {
          return new EditOutput(false, self::FAILED_MESSAGE);
        }

        $blogDao->update($blog_id, $title, $content);
        return new EditOutput(true, self::COMPLETED_MESSAGE);
    }
}