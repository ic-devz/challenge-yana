<?php
declare(strict_types=1);

namespace Unit\Auth;

use Yana\Auth\Domain\Auth;
use Yana\Auth\Domain\AuthException;
use Yana\Auth\Domain\AuthStrategy;
use Yana\Auth\Domain\UserLoginDto;
use Yana\Auth\Domain\UserRegisterDto;

class FakeAuthLoginStrategy implements AuthStrategy
{
	/**
	 * @param UserLoginDto $authDto
	 * @return Auth
	 * @throws AuthException
	 */
	public function validate(UserLoginDto $authDto): Auth
	{
		throw new AuthException("This Login Strategy is invalid");
	}

	public function register(UserRegisterDto $userRegisterDto): Auth
	{
		// TODO: Implement register() method.
	}
}
