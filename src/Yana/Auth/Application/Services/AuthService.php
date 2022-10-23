<?php

declare(strict_types=1);

namespace Yana\Auth\Application\Services;

use Yana\Auth\Domain\Auth;
use Yana\Auth\Domain\AuthStrategy;
use Yana\Auth\Domain\UserLoginDto;
use Yana\Auth\Domain\UserRegisterDto;

class AuthService
{
	private AuthStrategy $authStrategy;
	public function __construct(AuthStrategy $authStrategy)
	{
		$this->authStrategy = $authStrategy;
	}

	public function login(UserLoginDto $userLoginDto): Auth
	{
		// TODO: estrategia para bloquear intentos de login fallidos
		// TODO: estrategia para agregar segundo factor de auth
		return $this->authStrategy->validate($userLoginDto);
	}

    public function register(UserRegisterDto $userRegisterDto): Auth
    {
		// TODO: proveedor de correo para notificar al usuario
		return $this->authStrategy->register($userRegisterDto);
    }
}
