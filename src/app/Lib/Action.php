<?php
/**
 * リダイレクトを行うクラス
 */
class Action
{
  function redirect(string $redirectPath): void
  {
	  header("Location:" . $redirectPath);
	  exit;
  }
  function redirect1(string $redirectPath): void
  {
    include "$redirectPath";
    exit;
  }
}
?>