<?php

declare(strict_types=1);

namespace Yana\Auth\Application\Services;

use Yana\Auth\Domain\Auth;
use Yana\Auth\Domain\AuthStrategy;
use Yana\Auth\Domain\UserLoginDto;

class AuthService
{
	public function login(AuthStrategy $authStrategy, UserLoginDto $userLoginDto): Auth
	{
		return $authStrategy->validate($userLoginDto);
	}
}
