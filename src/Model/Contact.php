<?php
namespace Sellastica\Identity\Model;

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
	/** @var string|null */
	private $phone2;
	/** @var string|null */
	private $degree;
	/** @var Sex|null */
	private $sex;



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
	public function setPhone(?string $phone): void
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
	public function setEmail(Email $email): void
	{
		$this->email = $email;
	}

	/**
	 * @return null|string
	 */
	public function getPhone2(): ?string
	{
		return $this->phone2;
	}

	/**
	 * @param null|string $phone2
	 */
	public function setPhone2(?string $phone2): void
	{
		$this->phone2 = $phone2;
	}

	/**
	 * @return null|string
	 */
	public function getDegree(): ?string
	{
		return $this->degree;
	}

	/**
	 * @param null|string $degree
	 */
	public function setDegree(?string $degree): void
	{
		$this->degree = $degree;
	}

	/**
	 * @return null|\Sellastica\Identity\Model\Sex
	 */
	public function getSex(): ?\Sellastica\Identity\Model\Sex
	{
		return $this->sex;
	}

	/**
	 * @param null|\Sellastica\Identity\Model\Sex $sex
	 */
	public function setSex(?\Sellastica\Identity\Model\Sex $sex): void
	{
		$this->sex = $sex;
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
			'phone2' => $this->phone2,
			'degree' => $this->degree,
			'sex' => $this->sex ? $this->sex->getSex() : null,
		];
	}

	/**
	 * @param array $array
	 * @return Contact
	 */
	public function merge(array $array): Contact
	{
		$contact = new self(
			$array['firstName'] ?? $this->firstName,
			$array['lastName'] ?? $this->lastName,
			isset($array['email']) ? new Email($array['email']) : $this->email,
			$array['phone'] ?? $this->phone
		);
		$contact->setPhone2($array['phone2'] ?? $this->phone2);
		$contact->setDegree($array['degree'] ?? $this->degree);
		$contact->setSex(isset($array['sex']) ? Sex::from($array['sex']) : $this->sex);

		return $contact;
	}

	/**
	 * @param array|\ArrayAccess $array
	 * @return Contact
	 */
	public static function fromArray($array): Contact
	{
		$contact = new self(
			$array['fullName'],
			new Email($array['email']),
			$array['phone'] ?? null
		);
		$contact->setPhone2($array['phone2'] ?? null);
		$contact->setDegree($array['degree'] ?? null);
		$contact->setSex(isset($array['sex']) ? Sex::from($array['sex']) : null);

		return $contact;
	}
}