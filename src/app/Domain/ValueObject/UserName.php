<?php
 namespace App\Domain\ValueObject;
 use Exception;
 /**
  * ユーザーの名前用のValueObject
  */
 final class UserName
 {
   
     const INVALID_MESSAGE = 'ユーザー名は20文字以下でお願いします!';

     private $value;

     public function __construct(string $value)
     {
         if ($this->isInvalid($value)) {
             throw new Exception(self::INVALID_MESSAGE);
         }

         $this->value = $value;
     }

     public function value(): string
     {
         return $this->value;
     }

     private function isInvalid(string $value): bool
     {
         return mb_strlen($value) === 0 || mb_strlen($value) > 20;
     }
 }
