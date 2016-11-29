<?php

namespace Model;

use \W\Model\Model;
use \PDO;


class MessagesModel extends Model
{

	/**
	*Cette fonction selectionne tous les messages d'un salon en les associant avec les infos de leurs utilisateurs respectif;
	*@param int $idSalon l'id du salon dont on souhaite récupérer les messages
	*@return array la liste des messages avec les infos utilisateurs.
	*/

	public function searchAllWithUserInfos($idSalon){

		$query = "Select * FROM $this->table JOIN utilisateurs ON $this->table.id_utilisateur = utilisateurs.id WHERE id_salon = :id_salon";
	
		$stmt = $this->dbh->prepare($query);

		$stmt->bindParam(':id_salon', $idSalon, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}