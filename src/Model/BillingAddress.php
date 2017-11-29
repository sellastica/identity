<?php
namespace Sellastica\Identity\Model;

use Sellastica\Localization\Model\Country;
use Sellastica\Utils\Strings;

class BillingAddress extends Address
{
	/** @var string|null */
	private $cin;
	/** @var string|null */
	private $tin;


	/**
	 * @param string $company
	 * @param string $street
	 * @param string $city
	 * @param string $zip
	 * @param Country $country
	 * @param string $cin
	 * @param string $tin
	 */
	public function __construct(
		string $company,
		string $street,
		string $city,
		string $zip,
		Country $country,
		string $cin = null,
		string $tin = null
	)
	{
		parent::__construct($company, $street, $city, $zip, $country);
		if (isset($cin)) {
			$this->cin = Strings::removeSpaces($cin);
		}

		if (isset($tin)) {
			$this->tin = Strings::removeSpaces($tin);
		}
	}

	/**
	 * @return string|null
	 */
	public function getCin(): ?string
	{
		return $this->cin;
	}

	/**
	 * @return string|null
	 */
	public function getTin(): ?string
	{
		return $this->tin;
	}

	/**
	 * @return bool
	 */
	public function isCompany(): bool
	{
		return isset($this->cin) || isset($this->tin);
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
	public function modify(array $array): BillingAddress
	{
		return new self(
			$array['company'] ?? $this->company,
			$array['street'] ?? $this->street,
			$array['city'] ?? $this->city,
			$array['zip'] ?? $this->zip,
			isset($array['countryCode']) ? Country::from($array['countryCode']) : $this->country,
			$array['cin'] ?? $this->cin,
			$array['tin'] ?? $this->tin
		);
	}

	/**
	 * @param array|\ArrayAccess $array
	 * @return BillingAddress
	 */
	public static function fromArray($array): BillingAddress
	{
		return new self(
			$array['company'],
			$array['street'],
			$array['city'],
			$array['zip'],
			Country::from($array['countryCode']),
			$array['cin'] ?? null,
			$array['tin'] ?? null
		);
	}
}
