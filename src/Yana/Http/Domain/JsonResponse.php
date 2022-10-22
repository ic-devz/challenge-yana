<?php
declare(strict_types=1);

namespace Yana\Http\Domain;

class JsonResponse extends \CI_Controller
{
	private $payload;
	public function __construct($payload, $code = 200)
	{
		parent::__construct();
		$this->payload = $payload;
		$this->output
			->set_content_type('application/json')
			->set_output(
				json_encode($this->payload)
			);
	}
}
