<?php
declare(strict_types=1);

class Migrate extends CI_Controller
{
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->current() === false) {
			show_error($this->migration->error_string());
		}
	}
}
