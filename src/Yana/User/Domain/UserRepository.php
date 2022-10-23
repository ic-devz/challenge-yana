<?php
declare(strict_types=1);

namespace Yana\User\Domain;

interface UserRepository
{
	/**
	 * @param string $email
	 * @return User|null
	 */
	public function findByEmail(string $email): ?User;

	/**
	 * @param UserDto $userDto
	 * @return User
	 */
	public function create(UserDto $userDto): User;

	/**
	 * @param int $userId
	 * @return Activity[]
	 */
	public function findActivitiesByUserId(int $userId): array;

	/**
	 * @param int $userId
	 * @return User|null
	 */
    public function findById(int $userId): ?User;
}
