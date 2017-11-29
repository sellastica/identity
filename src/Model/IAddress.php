<?php
namespace Sellastica\Identity\Model;

use Sellastica\Localization\Model\Country;

interface IAddress
{
	/**
	 * @return string
	 */
	function getFullName(): string;

	/**
	 * @return string
	 */
	function getStreet(): string;

	/**
	 * @return string
	 */
	function getCity(): string;

	/**
	 * @return string
	 */
	function getZip(): string;

	/**
	 * @return Country
	 */
	function getCountry(): Country;
}