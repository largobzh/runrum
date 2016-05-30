<?php

namespace Manager;
// use UserManager;
class ReponseManager extends  \W\Manager\Manager 
{
	
	public function getReponses($post_id, $orderBy = "", $orderDir = "ASC")
	{
		if (!is_numeric($post_id)){return false;
	}
	else
	{
		$sql = "SELECT r.id, r.utilisateur_id, r.post_id, r.reponse, r.date_publication,u.pseudo FROM reponses AS r INNER JOIN utilisateurs as U on (r.utilisateur_id = u.id) AND r.post_id = $post_id";
	}

		 // coalesce(test5,0)

	if (!empty($orderBy))
		{
			//sécurisation des paramètres, pour éviter les injections SQL
			if(!preg_match("#^[a-zA-Z0-9_$]+$#", $orderBy))
			{
				die("invalid orderBy param");
			}
			$orderDir = strtoupper($orderDir);
			if($orderDir != "ASC" && $orderDir != "DESC")
			{
				die("invalid orderDir param");

				$sql .= " ORDER BY $orderBy $orderDir";
			}
		}
		else
		{
			$sql .= " ORDER BY date_publication DESC";
		}	
 

		
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll();
			
	}

// suppresion de toutes les réponses d'un post
	public function deleteReponses($id)
	{
		if (!is_numeric($id)){
			return false;
		}


		$sql = "DELETE FROM reponses WHERE post_id = :id";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id", $id);
		$sth->execute();
		return $sth->execute();
	}
}
	