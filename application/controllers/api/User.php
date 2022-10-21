<?php
declare(strict_types=1);
defined('BASEPATH') OR exit('No direct script access allowed');

use Yana\Auth\Application\Services\AuthService;

class User extends CI_Controller
{
	private AuthService $authService;

	public function __construct(AuthService $authService)
	{
		parent::__construct();
		$this->authService = $authService;
	}

	public function login()
	{
		if ($this->input->method() !== 'post') {
			return $this
				->output
				->set_content_type('application/json')
				->set_output(json_encode([
					"error" => "method invalid"
				]));
		}

		return $this
			->output
			->set_content_type('application/json')
			->set_output(json_encode([
				"message" => "ok"
			]));
	}
}
