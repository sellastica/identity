<?php
namespace Sellastica\Identity\Presentation;

/**
 * {@inheritdoc}
 * @property \Sellastica\Identity\Model\BillingAddress $parent
 */
class BillingAddressProxy extends \Sellastica\Identity\Presentation\AddressProxy
{
	/**
	 * @return bool
	 */
	public function getIs_company(): bool
	{
		return $this->parent->isCompany();
	}

	/**
	 * @return null|string
	 */
	public function getCin(): ?string
	{
		return $this->parent->getCin();
	}

	/**
	 * @return string|null
	 */
	public function getTin(): ?string
	{
		return $this->parent->getTin();
	}

	/**
	 * @return string
	 */
	public function getShortName(): string
	{
		return 'billing_address';
	}

	/**
	 * @return array
	 */
	public function getAllowedProperties(): array
	{
		return array_merge(parent::getAllowedProperties(), [
			'is_company',
			'cin',
			'tin',
		]);
	}
}