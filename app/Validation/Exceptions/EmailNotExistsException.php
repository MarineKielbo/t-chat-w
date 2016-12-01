<?php
namespace Validation\Exceptions;
/**
* Description of UsernameNotExistsException 
* @author Admin
*/

use Respect\Validation\Exceptions\ValidationException;

class EmailNotExistsException extends ValidationException
{
	public static $defaultTemplates = array(
		self::MODE_DEFAULT=>[
		'l\'email existe déjà'
		],
		self::MODE_NEGATIVE=> [
			'L\'email est déjà existant'
		]
	);
}