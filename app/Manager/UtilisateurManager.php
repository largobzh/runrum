<?php
// namespace Manager;


namespace Manager;

class UtilisateurManager extends  \W\Manager\Manager 
{
	

/**
	 * Ajoute une ligne
	 * @param array $data Un tableau associatif de valeurs à insérer
	 * @param boolean $stripTags Active le strip_tags automatique sur toutes les valeurs
	 * @return mixed false si erreur, les données insérées mise à jour sinon
	 */
	public function insertUser(array $data, $stripTags = true)
	{

		$colNames = array_keys($data);
		$colNamesString = implode(", ", $colNames);

		$sql = "INSERT INTO " . $this->table . " ($colNamesString) VALUES (";
		foreach($data as $key => $value){
			$sql .= ":$key, ";
		}
		$sql = substr($sql, 0, -2);
		$sql .= ")";

		$sth = $this->dbh->prepare($sql);
		foreach($data as $key => $value){
			$value = ($stripTags) ? strip_tags($value) : $value;
			// print_r($value);
			if($key=="password")
			{
 				$value = password_hash($value,PASSWORD_DEFAULT);
 			}
			$sth->bindValue(":".$key, $value);

		}
		

		if (!$sth->execute()){
			return false;
		}
		return $this->find($this->lastInsertId());
	}
	
}

