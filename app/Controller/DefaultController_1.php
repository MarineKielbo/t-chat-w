<?php

namespace Controller;

class TestController extends BaseController
{

	/**
	 * Page d'accueil par défaut
	 */
	public function monAction()
	{
		$this->show('test/home');
	}

}