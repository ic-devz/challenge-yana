<?php
declare(strict_types=1);

namespace Yana\Auth\Infrastructure\PasswordEncryptor;

use Yana\Auth\Domain\PasswordEncryptor;

class Base64PasswordEncryptor implements PasswordEncryptor
{
	public function encrypt(string $password): string
	{
		return base64_encode($password);
	}

	public function decrypt(string $passwordEncrypted): string
	{
		return base64_decode($passwordEncrypted);
	}
}
