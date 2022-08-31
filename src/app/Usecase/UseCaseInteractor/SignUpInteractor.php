<?php
namespace App\Usecase\UseCaseInteractor;

use App\Usecase\UseCaseInput\SignUpInput;
use App\Usecase\UseCaseOutput\SignUpOutput;
use App\Infrastructure\UserDao;
use App\Adapter\Repository\UserRepository;
use App\Domain\ValueObject\User\NewUser;

final class SignUpInteractor
{
    const ALLREADY_EXISTS_MESSAGE = 'すでに登録済みのメールアドレスです';
    const COMPLETED_MESSAGE = '登録が完了しました';

    private $useCaseInput;

    public function __construct(SignUpInput $useCaseInput)
    {
        $this->userRepository = new UserRepository();
        $this->useCaseInput = $useCaseInput;
    }

    public function handler(): SignUpOutput
    {
        $userDao = new UserDao();
        $user = $userDao->findByEmail($this->useCaseInput->email()->value());

        if (!is_null($user)) {
            return new SignUpOutput(false, self::ALLREADY_EXISTS_MESSAGE);
        }

        $this->signup();
        return new SignUpOutput(true, self::COMPLETED_MESSAGE);
    }

    private function signup(): void
     {
         $this->userRepository->insert(
             new NewUser(
                 $this->useCaseInput->name(),
                 $this->useCaseInput->email(),
                 $this->useCaseInput->password()
             )
         );
     }
}