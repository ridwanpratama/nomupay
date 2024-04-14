<?php

namespace App\Helpers;

class GenerateRandomString
{
	/**
	 * Generates a random string of specified length containing letters (both uppercase and lowercase) and numbers.
	 *
	 * @param int $length The length of the random string to generate.
	 * @return string The generated random string.
	 */
	function create(int $length = 10): string
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';

		$charactersLength = strlen($characters);
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}
}
