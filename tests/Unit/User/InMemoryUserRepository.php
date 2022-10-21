<?php
declare(strict_types=1);

namespace Unit\User;

use Yana\User\Domain\User;
use Yana\User\Domain\UserDto;
use Yana\User\Domain\UserRepository;

class InMemoryUserRepository implements UserRepository
{
	public function findByEmail(string $email): ?User
	{
		return User::create(
			$email,
			"random"
		);
	}

	public function create(UserDto $userDto): User
	{
		return User::create(
			$userDto->email(),
			$userDto->password()
		);
	}
}
