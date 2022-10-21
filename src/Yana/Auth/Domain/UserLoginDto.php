<?php

declare(strict_types=1);

namespace Yana\Auth\Domain;

abstract class UserLoginDto
{
	private string $email;
	private string $password;

	public function __construct(
		string $email,
		string $password
	) {
		$this->email = $email;
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function email(): string
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function password(): string
	{
		return $this->password;
	}
}
