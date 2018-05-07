<?php
namespace Sellastica\Identity\Model;

class Sex
{
	const MALE = 'male',
		FEMALE = 'female';

	/** @var string */
	private $sex;

	/** @var array */
	private static $options = [
		self::MALE => 'system.customer.sex.male',
		self::FEMALE => 'system.customer.sex.female',
	];


	/**
	 * @param string $sex
	 */
	private function __construct(string $sex)
	{
		$this->sex = $sex;
	}

	/**
	 * @return string
	 */
	public function getSex(): string
	{
		return $this->sex;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return self::$options[$this->sex];
	}

	/**
	 * @param string $sex
	 * @return Sex
	 * @throws \InvalidArgumentException
	 */
	public static function from(string $sex): Sex
	{
		if (!array_key_exists($sex, self::$options)) {
			throw new \InvalidArgumentException(sprintf('Unknown sex "%s"', $sex));
		}

		return new self($sex);
	}

	/**
	 * @return Sex
	 */
	public static function male(): Sex
	{
		return new self(self::MALE);
	}

	/**
	 * @return Sex
	 */
	public static function female(): Sex
	{
		return new self(self::FEMALE);
	}
}