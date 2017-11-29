<?php
namespace Sellastica\Identity\Model;

use Sellastica\Localization\Model\Country;

class ShippingAddress extends Address
{
	/**
	 * @param ShippingAddress $shippingAddress
	 * @return bool
	 */
	public function equals($shippingAddress)
	{
		return $shippingAddress == $this; //just ==
	}

	/**
	 * @param array $array
	 * @return ShippingAddress
	 */
	public function modify(array $array): ShippingAddress
	{
		return new self(
			$array['company'] ?? $this->company,
			$array['street'] ?? $this->street,
			$array['city'] ?? $this->city,
			$array['zip'] ?? $this->zip,
			isset($array['countryCode']) ? Country::from($array['countryCode']) : $this->country
		);
	}

	/**
	 * @param array|\ArrayAccess $array
	 * @return ShippingAddress
	 */
	public static function fromArray($array): ShippingAddress
	{
		return new self(
			$array['company'],
			$array['street'],
			$array['city'],
			$array['zip'],
			Country::from($array['countryCode'])
		);
	}
}