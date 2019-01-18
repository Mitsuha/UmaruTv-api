<?php

namespace App\Exceptions;

use Exception;

/**
 * 
 */
class HttpException extends Exception
{
	protected $message;

	function __construct($message, int $code)
	{
		$this->code = $code;
		$this->message = $message;
	}

	// public function render($request, HttpResponseException $e)
	// {
		# code...
	// }
}