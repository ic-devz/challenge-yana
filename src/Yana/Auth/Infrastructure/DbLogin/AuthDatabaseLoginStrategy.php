<?php
declare(strict_types=1);

namespace Yana\Auth\Infrastructure\DbLogin;

use Yana\Auth\Domain\Auth;
use Yana\Auth\Domain\AuthException;
use Yana\Auth\Domain\AuthStrategy;
use Yana\Auth\Domain\PasswordEncryptor;
use Yana\Auth\Domain\UserLoginDto;
use Yana\Auth\Domain\UserRegisterDto;
use Yana\User\Application\Services\UserService;

class AuthDatabaseLoginStrategy implements AuthStrategy
{
	private UserService $userService;
	private PasswordEncryptor $passwordEncryptor;

	public function __construct(UserService $userService, PasswordEncryptor $passwordEncryptor)
	{
		$this->userService = $userService;
		$this->passwordEncryptor = $passwordEncryptor;
	}

	/**
	 * @param UserLoginDto $authDto
	 * @return Auth
	 * @throws AuthException
	 */
	public function validate(UserLoginDto $authDto): Auth
	{
		$user = $this->userService->findByEmail($authDto->email());
		if ($user === null) {
			throw new AuthException("The user dont exists");
		}
		$passwordEncrypted = $this->passwordEncryptor->encrypt($authDto->password());
		if (!$user->equals($passwordEncrypted)) {
			throw new AuthException("The password is incorrect");
		}

		return new Auth($user);
	}

	/**
	 * @param UserRegisterDto $userRegisterDto
	 * @return Auth
	 * @throws AuthException
	 */
	public function register(UserRegisterDto $userRegisterDto): Auth
	{
		$user = $this->userService->findByEmail($userRegisterDto->email());
		if ($user !== null) {
			throw new AuthException("The user already exists");
		}
		$user = $this->userService->create(
			$userRegisterDto->email(),
			$this->passwordEncryptor->encrypt($userRegisterDto->password()),
		);

		return new Auth($user);
	}
}
