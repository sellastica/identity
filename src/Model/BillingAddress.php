<?php
namespace Sellastica\Identity\Model;

class BillingAddress extends Address implements \Sellastica\Twig\Model\IProxable
{
	/** @var string|null */
	private $cin;
	/** @var string|null */
	private $tin;


	/**
	 * @return string|null
	 */
	public function getCin(): ?string
	{
		return $this->cin;
	}

	/**
	 * @param null|string $cin
	 */
	public function setCin(?string $cin): void
	{
		$this->cin = $cin ? \Sellastica\Utils\Strings::removeSpaces($cin) : null;
	}

	/**
	 * @return string|null
	 */
	public function getTin(): ?string
	{
		return $this->tin;
	}

	/**
	 * @param null|string $tin
	 */
	public function setTin(?string $tin): void
	{
		$this->tin = $tin ? \Sellastica\Utils\Strings::removeSpaces($tin) : null;
	}

	/**
	 * @return bool
	 */
	public function isCompany(): bool
	{
		return isset($this->cin) || isset($this->tin) || isset($this->company);
	}

	/**
	 * @return bool
	 */
	public function isEmpty(): bool
	{
		return parent::isEmpty()
			&& !$this->cin
			&& !$this->tin;
	}

	/**
	 * @param BillingAddress $billingAddress
	 * @return bool
	 */
	public function equals($billingAddress)
	{
		return $billingAddress == $this; //just ==
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return join(', ', array_filter([
			$this->company,
			$this->street,
			$this->city,
			$this->zip,
			$this->country->getTitle()
		]));
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge(
			parent::toArray(),
			[
				'cin' => $this->cin,
				'tin' => $this->tin,
			]
		);
	}

	/**
	 * @param array $array
	 * @return BillingAddress
	 */
	public function merge(array $array)
	{
		$address = new self();
		$address->setFirstName(array_key_exists('firstName', $array) ? $array['firstName'] : $this->firstName);
		$address->setLastName(array_key_exists('lastName', $array) ? $array['lastName'] : $this->lastName);
		$address->setCompany(array_key_exists('company', $array) ? $array['company'] : $this->company);
		$address->setStreet(array_key_exists('street', $array) ? $array['street'] : $this->street);
		$address->setCity(array_key_exists('city', $array) ? $array['city'] : $this->city);
		$address->setZip(array_key_exists('zip', $array) ? $array['zip'] : $this->zip);
		$address->setCountry(array_key_exists('countryCode', $array)
			? \Sellastica\Localization\Model\Country::from($array['countryCode'])
			: $this->country
		);
		$address->setCin(array_key_exists('cin', $array) ? $array['cin'] : $this->cin);
		$address->setTin(array_key_exists('tin', $array) ? $array['tin'] : $this->tin);

		return $address;
	}

	/**
	 * @param array|\ArrayAccess $array
	 * @return BillingAddress
	 */
	public static function fromArray($array)
	{
		$address = new self();
		$address->setFirstName($array['firstName'] ?? null);
		$address->setLastName($array['lastName'] ?? null);
		$address->setCompany($array['company'] ?? null);
		$address->setStreet($array['street'] ?? null);
		$address->setCity($array['city'] ?? null);
		$address->setZip($array['zip'] ?? null);
		$address->setCountry(isset($array['countryCode'])
			? \Sellastica\Localization\Model\Country::from($array['countryCode'])
			: null
		);
		$address->setCin($array['cin'] ?? null);
		$address->setTin($array['tin'] ?? null);

		return $address;
	}

	/**
	 * @return \Sellastica\Identity\Presentation\BillingAddressProxy
	 */
	public function toProxy()
	{
		return new \Sellastica\Identity\Presentation\BillingAddressProxy($this);
	}
}
