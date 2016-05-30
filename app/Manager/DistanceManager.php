<?php
// namespace Manager;


namespace Manager;

class DistanceManager extends  \W\Manager\Manager 
{


	// Avoir la distance total de chaque utilisateurs
	public function getDistance($utilisateurs){
		// Afin de faire la somme des distance effectués 
		$sql = "SELECT SUM(distance) FROM " . $this->table." WHERE utilisateur_id = :id ";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id", $utilisateurs);
		$sth->execute();
		return $sth->fetch();
		
	}


	// Avoir la distance total de chaque utilisateurs
	public function getDuree($utilisateurs){
		// Afin de faire la somme des distance effectués 
		$sql = "SELECT SUM(duree) FROM " . $this->table." WHERE utilisateur_id = :id ";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id", $utilisateurs);
		$sth->execute();
		return $sth->fetch();
		
	}

	public function finder($val)
	{
		if (!is_numeric($val)){
			return false;
		}

		$sql = "SELECT * FROM compteurs WHERE palier = :valeur ";
		$mo = $this->dbh->prepare($sql);
		$mo->bindValue(":valeur", $val);
		$mo->execute();

		return $mo->fetch();
	}


public function inserter($utilisateur, $compteur, $stripTags = true)
	{


		$sql = "INSERT INTO " . $this->table . " (utilisateur_id, compteur_id) VALUES (:utilisateur,:compteur)";

		$sth = $this->dbh->prepare($sql);
		
			$sth->bindValue(":utilisateur", $utilisateur);
			$sth->bindValue(":compteur", $compteur);

		if (!$sth->execute()){
			return false;
		}
		return $this->find($this->lastInsertId());
	}


public function findcontro($id_compteur,$id_utilisateur)
	{
		if (!is_numeric($id_compteur) && !is_numeric($id_utilisateur)){
			return false;
		}

		$sql = "SELECT * FROM " . $this->table . " WHERE utilisateur_id = :id_utilisateur and compteur_id = :id_compteur ";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id_utilisateur", $id_utilisateur);
		$sth->bindValue(":id_compteur", $id_compteur);
		$sth->execute();

		return $sth->fetch();
	}

	// Pour enregistrer dans le forum

	public function insertu($utilisateur, $type_echange, $post, $date_pub, $titre, $stripTags = true)
	{


		$sql = "INSERT INTO " . $this->table . " (`utilisateur_id`, `type_echange_id`, `post`, `date_publication`, `nbvues`, `nbreponses`, `titre`) VALUES (:utilisateur, :type_echange, :post, :date_pub, :nbvues, :nbreponses, :titre)";

		$sth = $this->dbh->prepare($sql);
		
			$sth->bindValue(":utilisateur", $utilisateur);
			$sth->bindValue(":type_echange", $type_echange);
			$sth->bindValue(":post", $post);
			$sth->bindValue(":date_pub", $date_pub);
			$sth->bindValue(":nbvues", 0);
			$sth->bindValue(":nbreponses", 0);
			$sth->bindValue(":titre", $titre);

		if (!$sth->execute()){
			return false;
		}
		return $this->find($this->lastInsertId());
	}

}