<?php

declare(strict_types=1);

namespace Yana\Auth\Application\Services;

use Yana\Auth\Domain\Auth;
use Yana\Auth\Domain\AuthStrategy;
use Yana\Auth\Domain\UserLoginDto;

class AuthService
{
	private AuthStrategy $authStrategy;
	public function __construct(AuthStrategy $authStrategy)
	{
		$this->authStrategy = $authStrategy;
	}

	public function login(UserLoginDto $userLoginDto): Auth
	{
		return $this->authStrategy->validate($userLoginDto);
	}
}
