<?php
namespace Sellastica\Identity\Model;

class InvalidLogin
{
	/** @var \DateTime|null */
	private $date;
	/** @var int */
	private $totalCount;

	/**
	 * @param \DateTime $date
	 * @param int $totalCount
	 */
	public function __construct(\DateTime $date = null, $totalCount = 0)
	{
		$this->date = $date;
		$this->totalCount = $totalCount;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getDate()
	{
		return $this->date;
	}

	/**
	 * @return int
	 */
	public function getTotalCount(): int
	{
		return $this->totalCount;
	}

	/**
	 * @return self
	 */
	public function add(): self
	{
		return new self(new \DateTime(), $this->totalCount + 1);
	}

	/**
	 * @return self
	 */
	public function reset(): self
	{
		return new self();
	}
}