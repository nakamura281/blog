<?php
namespace App\Usecase\UseCaseInteractor;

use App\Domain\Entity\User;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\HashedPassword;
use App\Usecase\UseCaseInput\SignInInput;
use App\Usecase\UseCaseOutput\SignInOutput;
use App\Infrastructure\UserDao;

final class SignInInteractor
{
    const FAILED_MESSAGE = 'メールアドレスまたは<br />パスワードが間違っています';
    const SUCCESS_MESSAGE = 'ログインしました';

    private $userDao;
    private $input;

    public function __construct(SignInInput $input)
    {
        $this->userDao = new UserDao();
        $this->input = $input;
    }

    public function handler(): SignInOutput
    {
        $userMapper = $this->findUser();

        if ($this->notExistsUser($userMapper)) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        $user = $this->buildUserEntity($userMapper);

        if ($this->isInvalidPassword($user->password()->value())) {
            return new SignInOutput(false, self::FAILED_MESSAGE);
        }

        $this->saveSession($user);

        return new SignInOutput(true, self::SUCCESS_MESSAGE);
    }

    private function findUser(): ?array
    {
        return $this->userDao->findByEmail($this->input->email()->value());
    }

    private function notExistsUser(?array $user): bool
    {
        return is_null($user);
    }

    private function buildUserEntity(array $user): User
     {
         return new User(
             new UserId($user['id']), 
             new UserName($user['name']), 
             new Email($user['email']), 
             new HashedPassword($user['password']));
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