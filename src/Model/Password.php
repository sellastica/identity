<?php
namespace Sellastica\Identity\Model;

use Sellastica\Utils\Strings;

class Password
{
	const MIN_LENGTH = 4;

	/** @var string */
	private $password;


	/**
	 * @param string $password
	 * @throws \InvalidArgumentException
	 */
	public function __construct(string $password)
	{
		if (Strings::length($password) < self::MIN_LENGTH) {
			throw new \InvalidArgumentException('system.notices.invalid_password_length');
		}

		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->password;
	}
}