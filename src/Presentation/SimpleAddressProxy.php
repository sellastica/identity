<?php
namespace Sellastica\Identity\Presentation;

use Sellastica\Identity\Model\Address;
use Sellastica\Localization\Presentation\CountryProxy;
use Sellastica\Twig\Model\ProxyEntity;

/**
 * {@inheritdoc}
 * @property Address $parent
 */
class SimpleAddressProxy extends ProxyEntity
{
	/**
	 * @return string
	 */
	public function getCompany(): string
	{
		return $this->parent->getCompany();
	}

	/**
	 * @return string
	 */
	public function getStreet(): string
	{
		return $this->parent->getStreet();
	}

	/**
	 * @return string
	 */
	public function getCity(): string
	{
		return $this->parent->getCity();
	}

	/**
	 * @return string
	 */
	public function getZip(): string
	{
		return $this->parent->getZip();
	}

	/**
	 * @return CountryProxy
	 */
	public function getCountry(): CountryProxy
	{
		return $this->parent->getCountry()->toProxy();
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return '[' . $this->getShortName() . ']';
	}

	/**
	 * @return string
	 */
	public function getShortName(): string 
	{
		return 'address';
	}

	/**
	 * @return array
	 */
	public function getAllowedProperties(): array
	{
		return [
			'company',
			'street',
			'city',
			'zip',
			'country',
		];
	}
}