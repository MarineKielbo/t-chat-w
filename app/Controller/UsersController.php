<?php

namespace Controller;

use Model\UtilisateursModel;
use Model\UsersModel;
use W\Security\AuthentificationModel;


class UsersController extends BaseController
{

	/**
	*Cette fonction sert à afficher la liste des utilisateurs.
	*/
	public function listUsers(){

		//La ligne suivante affiche la vu présente dans app/views/users/List.php
		//Et y inject le tableau $userList sous un nouveau nom $listUsers

		/*
			Commentaires : 

				> Ici j'instancie depuis  l'action du controlleur un modele d'utilisateurs pour pouvoir accéder à la liste des utilisateurs.


		*/
				$userModel = new UtilisateursModel();

				$usersList = $userModel->findAll();

				$this->show('Users/liste', array('listUsers' => $usersList));
			}


			public function login(){

		// On va utiliser le model d'authenfication et plus particulierement 
		// la méthode isValidLoginInfos à laquelle on passera en param
		// le pseudo/email  et le password envoyées en post par l'utilisateur
		// une fois cette vérification faite, on récupère l'utilisateur en bdd
		// et on le redirige vers la page d'acceuil.



		//Si le pseudo est vide on ajoute un message d'erreur .
					if(empty($_POST['pseudo'])){

						$this->getFlashMessenger()->error('veuillez rentrer un pseudo');
					}

		//Si le mot de passe est vide on ajoute un message d'erreur
					if(empty($_POST['mdp'])){

					$this->getFlashMessenger()->error('veuillez rentrer un Mot de passe');

					}

					$auth = new AuthentificationModel();

					if(!$this->getFlashMessenger()->hasErrors()){

						$idUser = $auth->isValidLoginInfo($_POST['pseudo'], $_POST['mot_de_passe']);

						if($idUser !== 0 ){

							$utilisateurModel = new UtilisateursModel();

							//... je récupère les infos de l'utilisateur et je m'en sert pour le connecter au site à l'aide de $auth->logUserIn
							$userInfos = $utilisateurModel->find($idUser);
							$auth->logUserIn($userInfos);
							$this->redirectToRoute('default_home');

						}

					}

				
			$this->show('users/login', array('datas'=>isset($_POST) ? $_POST : array()));

	}

	public function logout(){
		$auth = new AuthentificationModel();
		$auth->logUserOut();
		$this->redirectToRoute('login');
	}

}