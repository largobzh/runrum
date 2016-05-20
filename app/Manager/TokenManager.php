<?php
// namespace Manager;


namespace Manager;

class TokenManager extends  \W\Manager\Manager 
{



/ ****************************************
// getToken
// ****************************************
$id    = $_GET['id'];
$token = $_GET['token'];

$sth = $dbh->prepare("SELECT *  FROM tokens WHERE id_utilisateur= :id and token= :token and date_validite > now()");
$sth->bindValue(':id',    $id,    PDO::PARAM_STR);
$sth->bindValue(':token', $token, PDO::PARAM_STR);

$sth->execute();
$token = $stmt->fetchall(PDO::FETCH_ASSOC);
return $sth->fetch();
	

}


public function findToken($user_id, $token_id )
	{
		if (!is_numeric($user_id) || !is_numeric($token_id) ){
			return false;
		}

		$sql = "SELECT * FROM " . $this->table . " WHERE $this->primaryKey = :id LIMIT 1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id", $id);
		$sth->execute();

		return $sth->fetch();
	}



	

		$stmt = $dbh->prepare("SELECT *  FROM tokens WHERE id_utilisateur= :id and token= :token and date_validite > now()");
		$stmt->bindValue(':id',    $user_id,    PDO::PARAM_STR);
		$stmt->bindValue(':token', $token_id, PDO::PARAM_STR);

		$stmt->execute();
		$token = $stmt->fetchall(PDO::FETCH_ASSOC);

