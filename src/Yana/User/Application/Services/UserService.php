<?php

declare(strict_types=1);

namespace Yana\User\Application\Services;

use Yana\User\Domain\Activity;
use Yana\User\Domain\User;
use Yana\User\Domain\UserDto;
use Yana\User\Domain\UserRepository;

class UserService
{
	private UserRepository $userRepository;

	public function __construct(
		UserRepository $userRepository
	) {
		$this->userRepository = $userRepository;
	}

	public function findByEmail(string $email): ?User
	{
		return $this->userRepository->findByEmail($email);
	}

	public function create(string $email, string $password): User
	{
		return $this->userRepository->create(
			new UserDto(
				$email,
				$password
			)
		);
	}

	/**
	 * @param int $userId
	 * @return Activity[]
	 */
	public function findActivitiesByUserId(int $userId): array
	{
		return $this->userRepository->findActivitiesByUserId($userId);
	}

    public function findById(int $userId): ?User
    {
		return $this->userRepository->findById($userId);
    }
}
