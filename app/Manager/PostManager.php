<?php
namespace Manager;

class PostManager extends \W\Manager\Manager 
{


	public function getPosts($post_id = "", $orderBy = "", $orderDir = "ASC", $type_echange = "")
	{

	    $sql = "SELECT p.id , p.titre, p.post, p.date_publication, p.nbvues, p.utilisateur_id, u.pseudo, c.type_echange, c.type_echange_short, (SELECT COUNT(post_id) FROM `reponses` WHERE p.id=post_id) as nbreponses  FROM posts AS p INNER JOIN type_echange AS c on(p.type_echange_id = c.id) INNER JOIN utilisateurs as u on (p.utilisateur_id = u.id)" ;
		
	
		// on cible le type d'écahnge 

		if(!empty($type_echange))
		{
			$sqlId= " WHERE c.type_echange_short= " . '"'.  $type_echange . '"';
			$sql .= $sqlId;
		}



		 // on cible un post ou tous les posts
		if(!empty($post_id) && is_numeric($post_id))
		{
			$sqlId= " WHERE p.id = $post_id";
			$sql .= $sqlId;
		}

		 // coalesce(test5,0)

		 // print_r($sql);
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
 print_r($sql);
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll();
				
	}
		


public function getTypeEchange()
	{
		$sql = "SELECT distinct(type_echange_short) FROM `type_echange` ";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll();
	}
		

	
}
