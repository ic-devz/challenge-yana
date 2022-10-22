<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

use Yana\Auth\Application\Services\AuthService;
use Yana\Auth\Domain\AuthException;
use Yana\Auth\Domain\UserLoginDto;
use Yana\Http\Domain\JsonResponse;

class User extends CI_Controller
{
	private AuthService $authService;

	public function __construct(AuthService $authService)
	{
		parent::__construct();
		$this->authService = $authService;
	}

	public function login(): JsonResponse
	{
		$data = json_decode($this->input->raw_input_stream, true);

		$errors = [];
		if (!isset($data["email"])) {
			$errors[] = "The email is required";
		}
		if (!isset($data["password"])) {
			$errors[] = "The password is required";
		}

		if(!empty($errors)) {
			return new JsonResponse([
				"errors" => $errors
			], 422);
		}

		if ($this->input->method() !== 'post') {
			return new JsonResponse([
				"error" => "method invalid"
			]);
		}

		try {
			$auth = $this->authService->login(
				new UserLoginDto(
					$data["email"],
					$data["password"]
				)
			);
			return new JsonResponse([
				"user" => [
					"email" => $auth->user()
				]
			]);
		} catch (AuthException $exception) {
			return new JsonResponse([
				"error" => $exception->getMessage()
			], 401);
		}
	}
}
