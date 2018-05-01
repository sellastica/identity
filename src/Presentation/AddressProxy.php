<?php
namespace Sellastica\Identity\Presentation;

/**
 * {@inheritdoc}
 * @property \Sellastica\Identity\Model\Address $parent
 */
class AddressProxy extends \Sellastica\Twig\Model\ProxyEntity
{
	/**
	 * @return string|null
	 */
	public function getFirst_name(): ?string
	{
		return $this->parent->getFirstName();
	}

	/**
	 * @return string|null
	 */
	public function getLast_name(): ?string
	{
		return $this->parent->getLastName();
	}

	/**
	 * @return string|null
	 */
	public function getCompany(): ?string
	{
		return $this->parent->getCompany();
	}

	/**
	 * @return string|null
	 */
	public function getStreet(): ?string
	{
		return $this->parent->getStreet();
	}

	/**
	 * @return string|null
	 */
	public function getCity(): ?string
	{
		return $this->parent->getCity();
	}

	/**
	 * @return string|null
	 */
	public function getZip(): ?string
	{
		return $this->parent->getZip();
	}

	/**
	 * @return \Sellastica\Localization\Presentation\CountryProxy
	 */
	public function getCountry(): \Sellastica\Localization\Presentation\CountryProxy
	{
		return $this->parent->getCountry()
			? $this->parent->getCountry()->toProxy()
			: null;
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
			'id',
			'company',
			'first_name',
			'last_name',
			'street',
			'city',
			'zip',
			'country',
		];
	}
}