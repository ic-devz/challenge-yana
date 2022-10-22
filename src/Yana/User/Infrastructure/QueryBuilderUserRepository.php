<?php
declare(strict_types=1);

namespace Yana\User\Infrastructure;

use Yana\User\Domain\User;
use Yana\User\Domain\UserDto;
use Yana\User\Domain\UserRepository;

class QueryBuilderUserRepository implements UserRepository
{
	public function findByEmail(string $email): ?User
	{
		$instance = get_instance();
		$instance->load->database();
		$query = $instance->db->query('SELECT * FROM users WHERE email = ?', [$email]);
		$row = $query->row();

		if (isset($row)) {
			return User::fromPrimitives(
				(int)$row->id,
				$row->email,
				$row->password
			);
		}
		return null;
	}

	public function create(UserDto $userDto): User
	{
		// TODO: Implement create() method.
	}
}
