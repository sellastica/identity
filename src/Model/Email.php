<?php
namespace Sellastica\Identity\Model;

use Nette\Utils\Validators;

class Email
{
	/** @var string */
	private $email;


	/**
	 * @param string $email
	 * @throws \InvalidArgumentException
	 */
	public function __construct(string $email)
	{
		if (!Validators::isEmail($email)) {
			throw new \InvalidArgumentException('system.notices.invalid_email');
		}

		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->email;
	}
}