<?php
namespace App\Usecase\UseCaseInteractor;

use App\Domain\Entity\User;
use App\Usecase\UseCaseInput\SignInInput;
use App\Usecase\UseCaseOutput\SignInOutput;
use App\Adapter\QueryServise\UserQueryServise;

final class SignInInteractor
{
    const FAILED_MESSAGE = 'メールアドレスまたは<br />パスワードが間違っています';
    const SUCCESS_MESSAGE = 'ログインしました';

    private $input;

    public function __construct(SignInInput $input)
    {
        $this->userQueryServise = new UserQueryServise();
        $this->input = $input;
    }

    public function handler(): SignInOutput
    {
        $userMapper = $this->findUser();

        if ($this->notExistsUser($userMapper)) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        if ($this->isInvalidPassword($userMapper->password()->value())) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        $this->saveSession($userMapper);

        return new SignInOutput(true, self::SUCCESS_MESSAGE);
    }

    private function findUser(): ?User
    {
        return $this->userQueryServise->findByEmail($this->input->email());
    }

    private function notExistsUser(?User $user): bool
    {
        return is_null($user);
    }

    private function isInvalidPassword(string $password): bool
    {
        return !password_verify($this->input->password()->value(), $password);
    }

    private function saveSession(User $user): void
    {
      $_SESSION['formInputs']['userId'] = $user->id();
      $_SESSION['formInputs']['name'] = $user->name();
    }
}