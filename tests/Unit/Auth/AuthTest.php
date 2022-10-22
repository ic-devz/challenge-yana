<?php
declare(strict_types=1);

namespace Unit\Auth;

use PHPUnit\Framework\TestCase;
use Yana\Auth\Application\Services\AuthService;
use Yana\Auth\Domain\AuthException;
use Yana\Auth\Domain\UserLoginDto;

class AuthTest extends TestCase
{
	public function testAnUserCanDoLogin()
	{
		$this->expectException(AuthException::class);
		$authService = new AuthService(new FakeAuthLoginStrategy(),);
		$authService->login(
			new UserLoginDto(
				'ichavez9001@gmail.com',
				'123456789.'
			)
		);
	}
}
