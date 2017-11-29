<?php
namespace Sellastica\Identity\Model;

use Sellastica\Api\Model\IPayloadable;
use Sellastica\Identity\Presentation\SimpleAddressProxy;
use Sellastica\Localization\Model\Country;
use Sellastica\Twig\Model\IProxable;
use Sellastica\Utils\Strings;

class Address implements IPayloadable, IProxable
{
	/** @var string */
	protected $company;
	/** @var string */
	protected $street;
	/** @var string */
	protected $city;
	/** @var string */
	protected $zip;
	/** @var \Sellastica\Localization\Model\Country */
	protected $country;


	/**
	 * @param string $company
	 * @param string $street
	 * @param string $city
	 * @param int $zip
	 * @param Country $country
	 */
	public function __construct(
		string $company,
		string $street,
		string $city,
		$zip,
		Country $country
	)
	{
		$this->company = $company;
		$this->street = $street;
		$this->city = $city;
		$this->zip = Strings::removeSpaces($zip);
		$this->country = $country;
	}

	/**
	 * @return string
	 */
	public function getCompany(): string
	{
		return $this->company;
	}

	/**
	 * @param string $company
	 */
	public function setCompany(string $company)
	{
		$this->company = $company;
	}

	/**
	 * @return string
	 */
	public function getStreet(): string
	{
		return $this->street;
	}

	/**
	 * @param string $street
	 */
	public function setStreet(string $street)
	{
		$this->street = $street;
	}

	/**
	 * @return string
	 */
	public function getCity(): string
	{
		return $this->city;
	}

	/**
	 * @param string $city
	 */
	public function setCity(string $city)
	{
		$this->city = $city;
	}

	/**
	 * @return string
	 */
	public function getZip(): string
	{
		return $this->zip;
	}

	/**
	 * @param string $zip
	 */
	public function setZip(string $zip)
	{
		$this->zip = $zip;
	}

	/**
	 * @return Country
	 */
	public function getCountry(): Country
	{
		return $this->country;
	}

	/**
	 * @param Country $country
	 */
	public function setCountry(Country $country)
	{
		$this->country = $country;
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
			$this->zip
		]));
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
			'company' => $this->company,
			'street' => $this->street,
			'city' => $this->city,
			'zip' => $this->zip,
			'countryCode' => $this->country->getCode(),
		];
	}

	/**
	 * @return \Sellastica\Identity\Presentation\SimpleAddressProxy
	 */
	public function toProxy(): SimpleAddressProxy
	{
		return new SimpleAddressProxy($this);
	}

	/**
	 * @return \Api\Payload\SimpleAddress
	 */
	public function toPayloadObject(): \Api\Payload\SimpleAddress
	{
		return new \Api\Payload\SimpleAddress($this);
	}
}