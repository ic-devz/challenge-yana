<?php
declare(strict_types=1);

namespace Unit\User;

use PHPUnit\Framework\TestCase;
use Yana\User\Application\Services\UserService;
use Yana\User\Domain\User;

class UserTest extends TestCase
{
	public function testAnUserCanFindOtherUserByEmail()
	{
		$userService = new UserService(new InMemoryUserRepository());
		$user = $userService->findByEmail('ichavez9001@gmail.com');

		$this->assertInstanceOf(User::class, $user);
	}
}
