<?php
namespace Sellastica\Identity\Model;

use Nette\Security\Passwords;
use Nette\Security\User;
use Sellastica\Entity\Entity\AbstractEntity;

abstract class Identity extends AbstractEntity implements IIdentity
{
	/** @var Contact @required */
	protected $contact;
	/** @var Password|null @optional */
	protected $password;
	/** @var InvalidLogin @optional */
	protected $invalidLogin;
	/** @var User|null */
	protected $user;


	/**
	 * @return Password|null
	 */
	public function getPassword(): ?Password
	{
		return $this->password;
	}

	public function hashPassword(): void
	{
		$this->password = new Password(Passwords::hash($this->password->getPassword()));
	}

	/**
	 * @param Password $password
	 */
	public function setPassword(Password $password)
	{
		$this->password = $password;
	}

	/**
	 * @return Contact
	 */
	public function getContact(): Contact
	{
		return $this->contact;
	}

	/**
	 * @param Contact $contact
	 */
	public function setContact(Contact $contact)
	{
		$this->contact = $contact;
	}

	/**
	 * @return InvalidLogin
	 */
	public function getInvalidLogin(): InvalidLogin
	{
		return $this->invalidLogin;
	}

	public function addInvalidLogin()
	{
		$this->invalidLogin = $this->invalidLogin->add();
	}

	public function resetInvalidLogins()
	{
		$this->invalidLogin = $this->invalidLogin->reset();
	}

	/**
	 * @return User|null
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * @param User $user
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}

	/**
	 * @return bool
	 */
	public function isLoggedIn(): bool
	{
		return $this->user && $this->user->isLoggedIn();
	}

	/**
	 * Hash used e.g. in the unsubscribe email, reset password URL etc.
	 * @param bool $limitedValidity If true, hash is valid till tomorrow midnight
	 * @return string
	 */
	public function getHashId($limitedValidity = false): string
	{
		if (true === $limitedValidity) {
			$timestamp = (new \DateTime('now + 1 day'))
				->setTime(23, 59, 59)
				->getTimestamp();
			return sha1($this->contact->getEmail() . $this->id . $timestamp);
		} else {
			return sha1($this->contact->getEmail() . $this->id);
		}
	}

	/**
	 * Returns time, the user is banned till
	 * @return \DateTime|null
	 */
	public function getBannedTill(): ?\DateTime
	{
		if (!$this->invalidLogin->getTotalCount() || !$this->invalidLogin->getDate()) {
			return null;
		} else {
			//3 tries and less => 0 seconds
			//4 tries => (4 - 3) * 5 = 5 seconds
			//5 tries => (5 - 3) * 5 = 10 seconds
			//6 tries => (6 - 3) * 5 = 15 seconds
			//maximum is 300 seconds
			$minDelay = min(max(($this->invalidLogin->getTotalCount() - 3), 0) * 5, 300);
			$isBannedTill = (new \DateTime())
				->setTimestamp($this->invalidLogin->getDate()->getTimestamp() + $minDelay);

			return $isBannedTill > new \DateTime() ? $isBannedTill : null;
		}
	}

	/**
	 * @return bool
	 */
	public function isBanned(): bool
	{
		return (bool)$this->getBannedTill();
	}

	/**
	 * @return array
	 */
	public function parentToArray(): array
	{
		return array_merge(
			parent::parentToArray(),
			$this->contact->toArray(),
			[
				'password' => $this->password ? $this->password->getPassword() : null,
				'lastInvalidLogin' => $this->invalidLogin->getDate(),
				'invalidLoginCount' => $this->invalidLogin->getTotalCount(),
			]
		);
	}
}