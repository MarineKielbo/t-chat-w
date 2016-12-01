<?php
namespace Validation\Rules;
/**
* Description of UsernameNotExists
* Cettz classe sert à etendre les fonctionnalités de la bibliothèque respect/validation
* en y ajoutant un nouveau validateur
* @author Admin
*/

use Respect\Validation\Rules\AbstractRule;
use W\Model\UsersModel;

class EmailNotExists extends AbstractRule
{
	public function validate($email){
		$userModel = new UsersModel();
		return ! $userModel->emailExists($email);
	}
}
