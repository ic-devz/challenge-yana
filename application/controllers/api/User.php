<?php

declare(strict_types=1);
defined('BASEPATH') or exit('No direct script access allowed');

use Yana\Auth\Application\Services\AuthService;
use Yana\Auth\Domain\AuthException;
use Yana\Auth\Domain\UserLoginDto;
use Yana\Auth\Domain\UserRegisterDto;
use Yana\Http\Domain\JsonResponse;
use Yana\User\Application\Services\UserService;
use Yana\User\Domain\Activity;

class User extends CI_Controller
{
	private AuthService $authService;
	private UserService $userService;

	public function __construct(AuthService $authService, UserService $userService)
	{
		parent::__construct();
		$this->authService = $authService;
		$this->userService = $userService;
	}

	public function login(): JsonResponse
	{
		$data = json_decode($this->input->raw_input_stream, true);
		try {
			$this->validateRequest($data);
			if ($this->input->method() !== 'post') {
				return new JsonResponse([
					"error" => "method invalid"
				]);
			}

			$auth = $this->authService->login(
				new UserLoginDto(
					$data["email"],
					$data["password"]
				)
			);
			return new JsonResponse([
				"user" => [
					"email" => [
						"id" => $auth->user()->id(),
						"email" => $auth->user()->email(),
					]
				]
			]);
		} catch (AuthException $exception) {
			return new JsonResponse([
				"error" => $exception->getMessage()
			], 401);
		} catch (ApiUserValidationException $exception) {
			return new JsonResponse([
				"errors" => $exception->errors()
			], 422);
		}
	}

	public function register(): JsonResponse
	{
		$data = json_decode($this->input->raw_input_stream, true);
		try {
			$this->validateRequest($data);
			$auth = $this->authService->register(
				new UserRegisterDto(
					$data["email"],
					$data["password"]
				)
			);

			return new JsonResponse([
				"user" => [
					"email" => [
						"id" => $auth->user()->id(),
						"email" => $auth->user()->email(),
					]
				]
			]);
		} catch (ApiUserValidationException $ex) {
			return new JsonResponse([
				"errors" => $ex->errors()
			], 422);
		} catch (AuthException $ex) {
			return new JsonResponse([
				"error" => $ex->getMessage()
			], 400);
		}
	}

	public function activities(int $userId): JsonResponse
	{
		$user = $this->userService->findById($userId);
		if ($user === null) {
			return new JsonResponse(
				["error" => "User not found"],
				404
			);
		}

		$activities = $this->userService->findActivitiesByUserId($userId);
		return new JsonResponse(
			[
				"code" => 200,
				"payload" => collect($activities)
					->map(function (Activity $activity) {
						return [
							"id" => $activity->id(),
							"messageType" => $activity->messageType(),
							"value" => $activity->value(),
							"timestamp" => $activity->timestamp(),
						];
					})
			]
		);
	}

	/**
	 * @param $data
	 * @return void
	 * @throws ApiUserValidationException
	 */
	public function validateRequest($data): void
	{
		$errors = [];
		if (!isset($data["email"])) {
			$errors[] = "The email is required";
		}
		if (!isset($data["password"])) {
			$errors[] = "The password is required";
		}

		if (!empty($errors)) {
			throw new ApiUserValidationException($errors);
		}
	}
}
