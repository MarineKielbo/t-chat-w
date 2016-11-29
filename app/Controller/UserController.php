<?php

namespace Controller;

use Model\UtilisateursModel;
use W\Security\AuthentificationModel;
use Respect\Validation\Validator as v;

class UserController extends BaseController
{
	//Cette fonction sert à afficher la liste des utilisateurs
	public function listUsers(){
		//$usersList = array(
			//'Googleman', 'Pausewoman', 'Pauseman', 'Roland'
		//);

		// Ici j'instancie depuis l'action du controleur, un modele d''utilisateurs pour pouvoir accéder à la liste des utilisteurs

		$usersModel = new UtilisateursModel();

		$usersList = $usersModel->findAll();

		/*
		La ligne suivante affiche la vue présente dans app/Views/users/list.php et y injecte le tableau $usersList sous un nouveau nom $listUsers
		*/
		$this->show('users/list', array('listUsers' => $usersList));
	}

	public function login(){
		// On va utiliser le modèle d'authentification et plus particulièrement la méthode isValideLoginInfos à       // laquelle on passera en paramètre le pseudo/email et le password envoyés en post par l'utilisateur.
		// Une fois cette verification faite, on récupère l'utilisateur en bdd, on le connecte et on le redirige vers  // la page d'accueil
		if(!empty($_POST)){
			// Je verifie la non-vacuité du pseudo en POST
			if(empty($_POST['pseudo'])){
			// si le pseudo est vide on ajoute un message d'erreur
			}
			// je veirifie la non-vacuité du mot de passe en POST
			if (empty($_POST['mot_de_passe'])){
			// si le mot de passe est vide on ajoute un message d'erreur
			}

			$auth = new AuthentificationModel();	

			if(!empty($_POST['pseudo']) && !empty($_POST['mot_de_passe'])){
				// Vérification de l'existence de l'utilisateur
				$idUser = $auth->isValidLoginInfo($_POST['pseudo'], $_POST['mot_de_passe']);

				// si l'utilisateur existe bel et bien
				if($idUser !== 0){
					$UtilisateurModel = new UtilisateursModel();

					// Je recupère les infos de l'utilisateur et je m'en sert pour le connecter au site à l'aide de 
					// $auth->logUserIn
					$userInfos = $UtilisateurModel->find($idUser);
					$auth->logUserIn($userInfos);

					// Une fois l'utilisateur connecté, je le redirige vers l'accueil
					$this->redirectToRoute('default_home');
				}else{
					// les infos de connexion sont incorrectes, on avertit l'utilisateur

					$this->getFlashMessenger()->error('Vos informations de connexion sont incorrectes');
				}
			}
		}

		$this->show('users/login', array('datas'=> isset($_POST) ? $_POST : array()));
	}

	public function logout(){
		$auth = new AuthentificationModel();
		$auth->logUserOut();
		$this->redirectToRoute('login');
	}

	public function register(){
		if(!empty($_POST)){
			$validators = array(
				'pseudo' => v::length(3,50)->alnum()->noWhiteSpace()->setName('Nom d\'utilisateur'), // Correspond aux champs bien écrit de t-chat
				'email'=> v::email()->setName('Email'),
				'mot_de_passe'=> v::length(3,50)->alnum()->noWhiteSpace()->setName('Mot de passe'),
				'avatar'=> v::optional(v::image()->size('1MB')->uploaded())
			);
		}	
		$this->show('users/register');
	}
}