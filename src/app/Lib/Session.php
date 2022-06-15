<?php
namespace App\Lib;

include __DIR__ . ('/../../vendor/autoload.php');

use App\Lib\SessionKey;
/**
  * セッションの操作を行うクラス
  */
final class Session
{
   
    private static $instance;

    private function __construct()
    {
    }

    /**
      * 1回目であれば自身のインスタンスを生成し、返す。
      * セッション処理の開始をする。
      * 
      * @return self
      */
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        self::start();
        return self::$instance;
    }

    /**
      * セッション処理が開始されていなければ開始する。
      * 
      * @return void
      */
    private static function start(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
      * セッションにエラー文を保存する。
      * 
      * @param string $errorMessage エラー文
      * @return void
      */
    public function appendError(string $errorMessage): void
    {
        $_SESSION[SessionKey::ERROR_KEY][] = $errorMessage;
    }

    /**
      * セッションに保存されているエラー文を返す。
      * セッションに保存されているエラー文を削除する。
      * 
      * @return array
      */
    public function popAllErrors(): array
    {
        $errors = $_SESSION[SessionKey::ERROR_KEY] ?? [];
        $errorKey = new SessionKey(SessionKey::ERROR_KEY);
        $this->clear($errorKey);
        return $errors;
    }

    /**
      * エラー文がセッションに保存されていたら「true」を返す。
      * エラー文がセッションに保存されていなければ「false」を返す。
      * 
      * @return bool
      */
    public function existsErrors(): bool
    {
        return !empty($_SESSION[SessionKey::ERROR_KEY]);
    }

    /**
      * 引数で受け取ったキーのセッションに保存されているデータを削除する。
      * 
      * $sessionKey 削除するセッションキー
      * @return void
      */
    public function clear(SessionKey $sessionKey): void
    {
      unset($_SESSION[$sessionKey->value()]);
    }

    /**
      * 入力されたフォームのデータをセッションに保存する。
      * ex.
      * フォーム送信時にエラーになった場合、入力されていた情報をフォームにセットし直す場合などに使用。
      * 
      * $formInputs 入力されたフォームのデータ
      * @return void
      */
    public function setFormInputs(SessionKey $sessionKey, $value): void
	  {
		  $_SESSION[$sessionKey->value()] = $value;
	  }


    
     /**
      * セッションに保存されているフォームのデータを返す。
      * 
      * @return array
      */
    public function getFormInputs(): array
    {
        return $_SESSION[SessionKey::FORM_INPUTS_KEY] ?? [];
    }

   /**
      * セッションにメッセージを保存する。 
      */
    public function setMessage(SessionKey $sessionKey, $message): void
    {
      $_SESSION[$sessionKey->value()] = $message;
    }
    
    /**
      * セッションに保存されているメッセージデータを返す。
      * 
      * @return string
      */
    public function getMessage(): string
    {
        $message = $_SESSION[SessionKey::MESSAGE_KEY] ?? '';
        $messageKey = new SessionKey(SessionKey::MESSAGE_KEY);
        $this->clear($messageKey);
        return $message;
    }
}