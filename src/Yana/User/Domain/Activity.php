<?php

declare(strict_types=1);

namespace Yana\User\Domain;

class Activity
{
	private int $id;
	private string $messageType;
	private string $value;
	private string $timestamp;
	public function __construct(
		int $id,
		string $messageType,
		string $value,
		string $timestamp
	) {
		$this->id = $id;
		$this->messageType = $messageType;
		$this->value = $value;
		$this->timestamp = $timestamp;
	}

	/**
	 * @return int
	 */
	public function id(): int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function messageType(): string
	{
		return $this->messageType;
	}

	/**
	 * @return string
	 */
	public function value(): string
	{
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function timestamp(): string
	{
		return $this->timestamp;
	}
}
