<?php
namespace Sellastica\Identity\Model;

use Nette\Utils\Strings;

class Contact
{
	/** @var string */
	private $fullName;
	/** @var Email */
	private $email;
	/** @var string|null */
	private $phone;


	/**
	 * @param string $fullName
	 * @param Email $email
	 * @param string|null $phone
	 */
	public function __construct(
		string $fullName,
		Email $email,
		string $phone = null
	)
	{
		$this->fullName = $fullName;
		$this->email = $email;
		$this->phone = $phone;
	}

	/**
	 * @return string
	 */
	public function getFullName(): string
	{
		return $this->fullName;
	}

	/**
	 * @param string $fullName
	 */
	public function setFullName(string $fullName)
	{
		$this->fullName = $fullName;
	}

	/**
	 * @return array
	 */
	public function parseFullNameToFirstAndLastName(): array
	{
		if (strpos($this->fullName, ' ') !== false) {
			$firstName = Strings::before($this->fullName, ' ');
			$lastName = Strings::after($this->fullName, ' ');
		} else {
			$firstName = null;
			$lastName = $this->fullName;
		}

		return [$firstName, $lastName];
	}

	/**
	 * @return null|string
	 */
	public function parseFirstName(): ?string
	{
		return $this->parseFullNameToFirstAndLastName()[0];
	}

	/**
	 * @return null|string
	 */
	public function parseLastName(): ?string
	{
		return $this->parseFullNameToFirstAndLastName()[1];
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
			'fullName' => $this->fullName,
			'email' => $this->email->getEmail(),
			'phone' => $this->phone,
		];
	}

	/**
	 * @param array $array
	 * @return self
	 */
	public function modify(array $array)
	{
		return new self(
			$array['fullName'] ?? $this->fullName,
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