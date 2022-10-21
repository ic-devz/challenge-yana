<?php

declare(strict_types=1);

namespace Yana\Auth\Domain;

use Yana\User\Domain\User;

class Auth
{
	private User $user;

	public function __construct(
		User $user
	) {
		$this->user = $user;
	}

	/**
	 * @return User
	 */
	public function user(): User
	{
		return $this->user;
	}
}
