<?php
namespace Sellastica\Identity\Presentation;

/**
 * {@inheritdoc}
 * @property \Sellastica\Identity\Model\BaseAddress $parent
 */
class BaseAddressProxy extends \Sellastica\Twig\Model\ProxyEntity
{
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
	 * @return \Sellastica\Localization\Presentation\CountryProxy
	 */
	public function getCountry(): \Sellastica\Localization\Presentation\CountryProxy
	{
		return $this->parent->getCountry()->toProxy();
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return (string)$this->parent;
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
			'street',
			'city',
			'zip',
			'country',
		];
	}
}