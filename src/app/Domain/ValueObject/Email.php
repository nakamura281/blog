<?php
 namespace App\Domain\ValueObject;
 use Exception;
 /**
  * メールアドレス用のValueObject
  */
 final class Email
 {
     /**
      * メールアドレスの書式の正規表現
      */
     const EMAIL_REGULAR_EXPRESSIONS = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";

     const INVALID_MESSAGE = 'メールアドレスの形式が正しくありません';

     private $value;

     /**
      * コンストラクタ
      */
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
         return !preg_match(self::EMAIL_REGULAR_EXPRESSIONS, $value);
     }
 }