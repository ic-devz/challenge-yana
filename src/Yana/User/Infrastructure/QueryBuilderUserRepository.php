<?php
declare(strict_types=1);

namespace Yana\User\Infrastructure;

use Yana\User\Domain\Activity;
use Yana\User\Domain\User;
use Yana\User\Domain\UserDto;
use Yana\User\Domain\UserRepository;

class QueryBuilderUserRepository implements UserRepository
{
	/**
	 * @param string $email
	 * @return User|null
	 */
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

	/**
	 * @param UserDto $userDto
	 * @return User
	 */
	public function create(UserDto $userDto): User
	{
		$instance = get_instance();
		$instance->load->database();
		$instance->db->insert('users', [
			"email" => $userDto->email(),
			"password" => $userDto->password()
		]);
		$userId = $instance->db->insert_id();
		return User::fromPrimitives(
			$userId,
			$userDto->email(),
			$userDto->password()
		);
	}

	/**
	 * @param int $userId
	 * @return Activity[]
	 */
	public function findActivitiesByUserId(int $userId): array
	{
		$instance = get_instance();
		$instance->load->database();
		$query = $instance->db->query('SELECT * FROM user_activities WHERE uid = ?', [$userId]);
		return collect($query->result())
			->map(function($activity) {
				return new Activity(
					(int)$activity->id,
					$activity->message_from,
					$activity->message_text,
					$activity->timestamp
				);
			})
			->toArray();
	}

	public function findById(int $userId): ?User
	{
		$instance = get_instance();
		$instance->load->database();
		$query = $instance->db->query('SELECT * FROM users WHERE id = ?', [$userId]);
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
}
