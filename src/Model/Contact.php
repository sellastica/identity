<?php
namespace Sellastica\Identity\Model;

use Nette\Utils\Strings;

class Contact
{
	/** @var string */
	private $firstName;
	/** @var string */
	private $lastName;
	/** @var Email */
	private $email;
	/** @var string|null */
	private $phone;


	/**
	 * @param string $firstName
	 * @param string $lastName
	 * @param Email $email
	 * @param string|null $phone
	 */
	public function __construct(
		string $firstName,
		string $lastName,
		Email $email,
		string $phone = null
	)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->phone = $phone;
	}

	/**
	 * @return string
	 */
	public function getFirstName(): string
	{
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName(string $firstName): void
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName(): string
	{
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName(string $lastName): void
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getFullName(): string
	{
		return $this->firstName . ' ' . $this->lastName;
	}

	/**
	 * @return string|null
	 */
	public function getPhone(): ?string
	{
		return $this->phone;
	}

	/**
	 * @param null|string $phone
	 */
	public function setPhone(?string $phone)
	{
		$this->phone = $phone;
	}

	/**
	 * @return Email
	 */
	public function getEmail(): Email
	{
		return $this->email;
	}

	/**
	 * @param Email $email
	 */
	public function setEmail(Email $email)
	{
		$this->email = $email;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'firstName' => $this->firstName,
			'lastName' => $this->lastName,
			'email' => $this->email->getEmail(),
			'phone' => $this->phone,
		];
	}

	/**
	 * @param array $array
	 * @return self
	 */
	public function merge(array $array)
	{
		return new self(
			$array['firstName'] ?? $this->firstName,
			$array['lastName'] ?? $this->lastName,
			isset($array['email']) ? new Email($array['email']) : $this->email,
			$array['phone'] ?? $this->phone
		);
	}

	/**
	 * @param array|\ArrayAccess $array
	 * @return self
	 */
	public static function fromArray($array): self
	{
		return new self(
			$array['fullName'],
			new Email($array['email']),
			$array['phone'] ?? null
		);
	}
}