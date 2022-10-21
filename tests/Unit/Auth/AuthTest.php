<?php
declare(strict_types=1);

namespace Unit\Auth;

use PHPUnit\Framework\TestCase;
use Yana\Auth\Application\Services\AuthService;
use Yana\Auth\Domain\Auth;

class AuthTest extends TestCase
{
	public function testAnUserCanDoLogin()
	{
		$authService = new AuthService();
		$auth = $authService->login(new FakeAuthLoginStrategy());

		$this->assertInstanceOf(Auth::class, $auth);
	}
}
