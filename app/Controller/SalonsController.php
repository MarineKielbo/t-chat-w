<?php

namespace Controller;

use Model\SalonsModel;
use Model\MessagesModel;


class SalonsController extends BaseController
{



	public function viewSalon($id){

		
		$salonsModel = new SalonsModel();
		$salon = $salonsModel->find($id);


		$messagesModel = new MessagesModel();
		
		
		$messages = $messagesModel -> searchAllWithUserInfos($id);



		$this->show('salons/see', array('salon'=>$salon, 'messages' => $messages));

	}

}

			
	/*
		Commentaires :

			> Cette Action permet de voir la liste des messages d'un salons.

			> On instancie le model des salons de façon à récupérer les informations du salon dont l'id est $id (passé dans l'url);
			
			> On instancie le modèle des messages pour récupérer les messages du salons dont l'id est $id

			> Search est egale à = Select * From messages WHERE id_salon = id

			> J'utilise une methode propre au model message qui permet de recuperer les messages avec les infos utilisateurs associées.

	*/