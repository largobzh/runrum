<?php
namespace Manager;

class PostManager extends \W\Manager\Manager 
{


	public function getPosts($orderBy = "", $orderDir = "ASC", $type_echange = "")
	{

		switch ($type_echange)
		{
			case 'Questions / Réponses': 
		        $sql = "SELECT p.id , p.titre, p.post, p.date_publication, p.nbvues, p.nbreponses, u.pseudo, c.type_echange, (SELECT DISTINCT post_id FROM `reponses` WHERE p.id=post_id) as nbreponses  FROM posts AS p INNER JOIN type_echange AS c on(p.type_echange_id = c.id) INNER JOIN utilisateurs as u on (p.utilisateur_id = u.id) WHERE c.type_echange like '%Questions / Réponses%' ";
		                break;

			case 'Compte-Rendus': 
		        $sql = "SELECT p.id , p.titre, p.post, p.date_publication, p.nbvues, p.nbreponses, u.pseudo, c.type_echange, (SELECT DISTINCT post_id FROM `reponses` WHERE p.id=post_id) as nbreponses  FROM posts AS p INNER JOIN type_echange AS c on(p.type_echange_id = c.id) INNER JOIN utilisateurs as u on (p.utilisateur_id = u.id)  WHERE c.type_echange like '%News%' ";
		                break;

		    case 'News': 
		        $sql = "SELECT p.id , p.titre, p.post, p.date_publication, p.nbvues, p.nbreponses, u.pseudo, c.type_echange, (SELECT DISTINCT post_id FROM `reponses` WHERE p.id=post_id) as nbreponses  FROM posts AS p INNER JOIN type_echange AS c on(p.type_echange_id = c.id) INNER JOIN utilisateurs as u on (p.utilisateur_id = u.id) WHERE c.type_echange like '%Compte-Rendus%'";
		                break;

		    default:
		         $sql = "SELECT p.id , p.titre, p.post, p.date_publication, p.nbvues, u.pseudo, c.type_echange, (SELECT DISTINCT post_id FROM `reponses` WHERE p.id=post_id) as nbreponses  FROM posts AS p INNER JOIN type_echange AS c on(p.type_echange_id = c.id) INNER JOIN utilisateurs as u on (p.utilisateur_id = u.id)" ;
		                break;
		 }

		 // coalesce(test5,0)

		 print_r($sql);
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

	
}
