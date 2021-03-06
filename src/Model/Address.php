<?php
namespace Sellastica\Identity\Model;

class Address extends BaseAddress implements \Sellastica\Twig\Model\IProxable
{
	/** @var string|null */
	protected $firstName;
	/** @var string|null */
	protected $lastName;
	/** @var string|null */
	protected $company;


	/**
	 * @param bool $firstNameFirst
	 * @return null|string
	 */
	public function getCompanyOrFullName(bool $firstNameFirst = true): ?string
	{
		return $this->company ?: $this->getFullName($firstNameFirst);
	}

	/**
	 * @return null|string
	 */
	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	/**
	 * @param null|string $firstName
	 */
	public function setFirstName(?string $firstName): void
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return null|string
	 */
	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	/**
	 * @param null|string $lastName
	 */
	public function setLastName(?string $lastName): void
	{
		$this->lastName = $lastName;
	}

	/**
	 * @param bool $firstNameFirst
	 * @return null|string
	 */
	public function getFullName(bool $firstNameFirst = true): ?string
	{
		if (!$this->firstName && !$this->lastName) {
			return null;
		} elseif ($firstNameFirst) {
			return trim($this->firstName . ' ' . $this->lastName);
		} else {
			return trim($this->lastName . ' ' . $this->firstName);
		}
	}

	/**
	 * @return null|string
	 */
	public function getCompany(): ?string
	{
		return $this->company;
	}

	/**
	 * @param null|string $company
	 */
	public function setCompany(?string $company): void
	{
		$this->company = $company;
	}

	/**
	 * @return bool
	 */
	public function isEmpty(): bool
	{
		return parent::isEmpty()
			&& !$this->firstName
			&& !$this->lastName
			&& !$this->company;
	}

	/**
	 * @param Address $address
	 * @return bool
	 */
	public function equals($address)
	{
		return $address == $this; //just ==
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge(
			parent::toArray(),
			[
				'firstName' => $this->firstName,
				'lastName' => $this->lastName,
				'company' => $this->company,
			]
		);
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return join(', ', array_filter([
			$this->company,
			$this->firstName,
			$this->lastName,
			$this->street,
			$this->houseNumber,
			$this->city,
			$this->zip
		]));
	}

	/**
	 * @param array $array
	 * @return Address
	 */
	public function merge(array $array)
	{
		$address = new self();
		$address->setFirstName(array_key_exists('firstName', $array) ? $array['firstName'] : $this->firstName);
		$address->setLastName(array_key_exists('lastName', $array) ? $array['lastName'] : $this->lastName);
		$address->setCompany(array_key_exists('company', $array) ? $array['company'] : $this->company);
		$address->setStreet(array_key_exists('street', $array) ? $array['street'] : $this->street);
		$address->setHouseNumber(array_key_exists('houseNumber', $array) ? $array['houseNumber'] : $this->houseNumber);
		$address->setCity(array_key_exists('city', $array) ? $array['city'] : $this->city);
		$address->setZip(array_key_exists('zip', $array) ? $array['zip'] : $this->zip);
		$address->setCountry(array_key_exists('countryCode', $array)
			? \Sellastica\Localization\Model\Country::from($array['countryCode'])
			: $this->country
		);
		return $address;
	}

	/**
	 * @param array|\ArrayAccess $array
	 * @return Address
	 */
	public static function fromArray($array)
	{
		$address = new self();
		$address->setFirstName($array['firstName'] ?? null);
		$address->setLastName($array['lastName'] ?? null);
		$address->setCompany($array['company'] ?? null);
		$address->setStreet($array['street'] ?? null);
		$address->setHouseNumber($array['houseNumber'] ?? null);
		$address->setCity($array['city'] ?? null);
		$address->setZip($array['zip'] ?? null);
		$address->setCountry(isset($array['countryCode'])
			? \Sellastica\Localization\Model\Country::from($array['countryCode'])
			: null
		);
		return $address;
	}

	/**
	 * @return \Sellastica\Identity\Presentation\AddressProxy
	 */
	public function toProxy()
	{
		return new \Sellastica\Identity\Presentation\AddressProxy($this);
	}
}
