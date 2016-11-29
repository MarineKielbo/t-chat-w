<?php

namespace Controller;


class DefaultController extends BaseController
{

/**
 * Page d'accueil par défaut
 */
public function home(){
	$this->show('default/home');
}

}