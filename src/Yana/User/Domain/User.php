<?php

declare(strict_types=1);

namespace Yana\User\Domain;

class User
{
	private ?int $id;
	private string $email;
	private string $password;

	private function __construct(
		?int $id,
		string $email,
		string $password
	) {
		$this->id = $id;
		$this->email = $email;
		$this->password = $password;
	}

	public static function create(string $email, string $password): User
	{
		return new User(
			null,
			$email,
			$password
		);
	}

	public static function fromPrimitives(int $id, string $email, string $password): User
	{
		return new User(
			$id,
			$email,
			$password
		);
	}

	/**
	 * @return int
	 */
	public function id(): ?int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function email(): string
	{
		return $this->email;
	}

	public function equals(string $password): bool
	{
		return $this->password === $password;
	}
}
