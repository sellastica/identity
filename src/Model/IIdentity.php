<?php
namespace Sellastica\Identity\Model;

use Nette\Security\User;
use Sellastica\Entity\Entity\IEntity;

interface IIdentity extends IEntity
{
	/**
	 * @return User $user
	 */
	function getUser();

	/**
	 * @return bool
	 */
	function isLoggedIn();

	/**
	 * @return Contact
	 */
	public function getContact(): Contact;

	/**
	 * @return InvalidLogin
	 */
	function getInvalidLogin(): InvalidLogin;

	/**
	 * @return void
	 */
	function addInvalidLogin();

	/**
	 * @return void
	 */
	function resetInvalidLogins();
}
