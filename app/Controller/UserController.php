<?php

namespace Controller;

use Model\UtilisateursModel;
use W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;
use \Respect\Validation\Exceptions\NestedValidationException;


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

			// On indique à respect validation que les règles de validation seront accessibles depuis le 
			// namespace Validation\Rules
			v::with("Validation\Rules");

			$validators = array(
				'pseudo' => v::length(3,50)->alnum()->noWhiteSpace()->usernameNotExists()->setName('Nom d\'utilisateur'), // Correspond aux champs bien écrit de t-chat
				'email'=> v::emailNotExists()->setName('Email'),
				'mot_de_passe'=> v::length(3,50)->alnum()->noWhiteSpace()->setName('Mot de passe'),
				'sexe'=> v::in(['femme', 'homme', 'non-défini']),
				'avatar'=> v::optional(v::image()->size('1MB')->uploaded())
			);

			$datas = $_POST;

			 // On ajoute le chemin vers le fichiier d'avatar qui a été uploadé (si il y en a un)

			if (!empty($_FILES['avatar']['tmp_name'])){
				// je stocke en données à valider le chemin vers la localisation temporaire de l'avatar
				$datas['avatar'] = $_FILES['avatar']['tmp_name'];
			}else{
				// sinon je laisse ce champ vide
				$datas['avatar'] = realpath('avatars/default.png');
			}
			// Je parcours la liste de mes validateurs en récupérant aussi le nom du champ en clé	

			foreach ($validators as $field => $validator) {
				// la méthode assert renvoie une exception de type NestedValidationException qui nous permet de        //recupérer le ou les messages d'erreur en cas d'erreur
				try{
					// On essaye de valider la donnée
					// Si une exception se produit, c'est le bloc catch qui sera exécuté
					$validator->assert(isset($datas[$field]) ? $datas[$field] : '');
				}catch (NestedValidationException $ex){
					$fullMessage = $ex->getFullMessage();
					$this->getFlashMessenger()->error($fullMessage);
				}

				if( ! $this->getFlashMessenger()->hasErrors()){
					// si on n' pas rencontré d'erreur, on procède à l'insertion du nouvel utilisateur

					// Avant l(insertion, on doit faire deux choses:
					// - déplacer l'avatar du fichier temporaire vers le dossier avatars/
					// - hâcher le mot de passe

					// On hâche d'abord le mot de passe. On utilise pour cela le modèle AuthentificationModel pour     // rester cohérent avec le framework
					$auth = new AuthentificationModel();

					$datas['mot_de_passe'] = $auth->hashPassword($datas['mot_de_passe']);

					// On déplace l'avatar vers le dossier avatars

					$intialAvatarPath = $_FILES['avatar']['tmp_name'];

					$avatarNewName = md5(time(). uniqid());

					$targetPath = realpath('assets/upload/'. md5(time(). uniqid()));

					move_uploaded_file($intialAvatarPath, $targetPath);

					// On met à jour le nouveau nom de l'avatar dans $datas
					$datas['avatar'] = $avatarNewName;

					$utilisateursModel = new UtilisateursModel();

					unset($datas['send']);

					$userInfos = $utilisateursModel->insert($datas); 

					$auth->logUserIn($userInfos);

					$this->getFlashMessenger()->success('Vous vous êtes bien inscrit ) T\'chat !');

					$this->redirectToRoute('default_home');
				} 
			}
		}	
		$this->show('users/register');
	}
}