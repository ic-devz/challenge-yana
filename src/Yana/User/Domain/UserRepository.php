<?php
declare(strict_types=1);

namespace Yana\User\Domain;

interface UserRepository
{
	public function findByEmail(string $email): ?User;
	public function create(UserDto $userDto): User;
}
