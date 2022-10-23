<?php

declare(strict_types=1);

class ApiUserValidationException extends Exception
{
	private array $errors;

	public function __construct(array $errors = [])
	{
		$this->errors = $errors;
		parent::__construct();
	}

	/**
	 * @return array
	 */
	public function errors(): array
	{
		return $this->errors;
	}
}
