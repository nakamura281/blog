<?php
namespace App\Usecase\UseCaseInteractor;

use App\Usecase\UseCaseInput\CommentInput;
use App\Usecase\UseCaseOutput\CommentOutput;

final class CommentInteractor
{
    const FAILED_MESSAGE = '名前または<br />内容を入力してください！';

    private $input;

    public function __construct(CommentInput $input)
    {
        $this->input = $input;
    }

    public function handler(): CommentOutput
    {
        $commenter = $this->input->commenter();
        $comments = $this->input->comments();

        if ($commenter === "" || $comments === "") {
            return new CommentOutput(false, self::FAILED_MESSAGE);
        }

        return new CommentOutput(true, "");
    }
    
}