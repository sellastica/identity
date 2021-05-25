<?php
namespace Sellastica\Identity\Model;

class ShippingAddress extends Address implements \Sellastica\Twig\Model\IProxable
{
    /** @var string|null */
    protected $phone;

    /**
     * @return null|string
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
	 * @return bool
	 */
	public function isEmpty(): bool
	{
		return parent::isEmpty()
			&& !$this->phone;
	}

	/**
	 * @param ShippingAddress $shippingAddress
	 * @return bool
	 */
	public function equals($shippingAddress)
	{
		return $shippingAddress == $this; //just ==
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
            $this->zip,
            $this->phone
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
				'phone' => $this->phone,
			]
		);
	}

	/**
	 * @param array $array
	 * @return ShippingAddress
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
        $address->setPhone(array_key_exists('phone', $array) ? $array['phone'] : $this->phone);
        return $address;
	}

	/**
	 * @param array|\ArrayAccess $array
	 * @return ShippingAddress
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
        $address->setPhone($array['phone'] ?? null);
        return $address;
	}

	/**
	 * @return \Sellastica\Identity\Presentation\ShippingAddressProxy
	 */
	public function toProxy()
	{
		return new \Sellastica\Identity\Presentation\ShippingAddressProxy($this);
	}
}
