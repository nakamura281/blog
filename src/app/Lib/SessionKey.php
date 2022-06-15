<?php
namespace App\Lib;
/**
 * Sessionで扱うことができるキーの一覧
 */
if(class_exists("SessionKey")) return; //sessionkeyのクラスが定義されていたらreturnする。
final class SessionKey
{
	public const ERROR_KEY = 'errors';
	public const FORM_INPUTS_KEY = 'formInputs';
	public const MESSAGE_KEY = 'message';

	const KEYS = [
		self::ERROR_KEY,
		self::FORM_INPUTS_KEY,
		self::MESSAGE_KEY
	];

	private $value;

	public function __construct(String $value)
	{
		if (!in_array($value, self::KEYS)) {
			throw new Exception('使用不可能なキーです');// PHPで用意されているExceptionクラスを投げる
		}
		$this->value = $value;
	}

	public function value(): string
	{
		return $this->value;
	}
}