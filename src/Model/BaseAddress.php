<?php
namespace Sellastica\Identity\Model;

class BaseAddress implements \Sellastica\Api\Model\IPayloadable, \Sellastica\Twig\Model\IProxable
{
	/** @var string|null */
	protected $street;
	/** @var string|null */
	protected $houseNumber;
	/** @var string|null */
	protected $city;
	/** @var string|null */
	protected $zip;
	/** @var \Sellastica\Localization\Model\Country|null */
	protected $country;


	/**
	 * @return null|string
	 */
	public function getStreet(): ?string
	{
		return $this->street;
	}

	/**
	 * @param null|string $street
	 */
	public function setStreet(?string $street): void
	{
		$this->street = $street;
	}

	/**
	 * @return null|string
	 */
	public function getHouseNumber(): ?string
	{
		return $this->houseNumber;
	}

	/**
	 * @param null|string $houseNumber
	 */
	public function setHouseNumber(?string $houseNumber): void
	{
		$this->houseNumber = $houseNumber;
	}

	/**
	 * @return null|string
	 */
	public function getCity(): ?string
	{
		return $this->city;
	}

	/**
	 * @param null|string $city
	 */
	public function setCity(?string $city): void
	{
		$this->city = $city;
	}

	/**
	 * @return null|string
	 */
	public function getZip(): ?string
	{
		return $this->zip;
	}

	/**
	 * @param null|string $zip
	 */
	public function setZip(?string $zip): void
	{
		$this->zip = $zip ? \Sellastica\Utils\Strings::removeSpaces($zip) : null;
	}

	/**
	 * @return null|\Sellastica\Localization\Model\Country
	 */
	public function getCountry(): ?\Sellastica\Localization\Model\Country
	{
		return $this->country;
	}

	/**
	 * @param null|\Sellastica\Localization\Model\Country $country
	 */
	public function setCountry(?\Sellastica\Localization\Model\Country $country): void
	{
		$this->country = $country;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return join(', ', array_filter([
			$this->street,
			$this->houseNumber,
			$this->city,
			$this->zip
		]));
	}

	/**
	 * @return bool
	 */
	public function isEmpty(): bool
	{
		return !$this->street
			&& !$this->houseNumber
			&& !$this->city
			&& !$this->zip
			&& !$this->country;
	}

	/**
	 * @param $address
	 * @return bool
	 */
	public function equals($address) //do not typehint it, we can send e.g. stdClass here
	{
		return $address == $this; //just ==
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'street' => $this->street,
			'houseNumber' => $this->houseNumber,
			'city' => $this->city,
			'zip' => $this->zip,
			'countryCode' => $this->country ? $this->country->getCode() : null,
		];
	}

	/**
	 * @param array|\ArrayAccess $array
	 * @return BaseAddress
	 */
	public static function fromArray($array)
	{
		$address = new self();
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
	 * @return \Sellastica\Identity\Presentation\BaseAddressProxy
	 */
	public function toProxy()
	{
		return new \Sellastica\Identity\Presentation\BaseAddressProxy($this);
	}

	/**
	 * @return \Api\Payload\SimpleAddress
	 */
	public function toPayloadObject(): \Api\Payload\SimpleAddress
	{
		return new \Api\Payload\SimpleAddress($this);
	}
}