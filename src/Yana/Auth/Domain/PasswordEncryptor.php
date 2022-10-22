<?php
declare(strict_types=1);

namespace Yana\Auth\Domain;

interface PasswordEncryptor
{
	public function encrypt(string $password): string;
	public function decrypt(string $passwordEncrypted): string;
}
