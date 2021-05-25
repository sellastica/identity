<?php
namespace Sellastica\Identity\Presentation;

/**
 * {@inheritdoc}
 * @property \Sellastica\Identity\Model\ShippingAddress $parent
 */
class ShippingAddressProxy extends \Sellastica\Identity\Presentation\AddressProxy
{
    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->parent->getPhone();
    }

	/**
	 * @return string
	 */
	public function getShortName(): string
	{
		return 'shipping_address';
	}

	/**
	 * @return array
	 */
	public function getAllowedProperties(): array
	{
		return array_merge(parent::getAllowedProperties(), [
            'phone',
		]);
	}
}
