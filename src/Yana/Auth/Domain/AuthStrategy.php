<?php
declare(strict_types=1);

namespace Yana\Auth\Domain;

interface AuthStrategy
{
	public function validate(UserLoginDto $authDto): Auth;
	public function register(UserLoginDto $authDto): Auth;
}
