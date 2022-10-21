<?php

declare(strict_types=1);

namespace Yana\User\Application\Services;

use Yana\User\Domain\User;
use Yana\User\Domain\UserRepository;

class UserService
{
	private UserRepository $userRepository;

	public function __construct(
		UserRepository $userRepository
	) {
		$this->userRepository = $userRepository;
	}

	public function findByEmail(string $email): User
	{
		return $this->userRepository->findByEmail($email);
	}

	public function create()
	{

	}
}
