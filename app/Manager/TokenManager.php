<?php
// namespace Manager;
namespace Manager;

class TokenManager extends  \W\Manager\Manager 
{

// ****************************************
// getToken
// ****************************************

	public function findToken($user_id, $token_id )
	{
			if (!is_numeric($user_id) || !is_numeric($token_id) ){
				return false;
			}

			$sql = $dbh->prepare("SELECT *  FROM tokens WHERE id_utilisateur= :id and token= :token and date_validite > now()");
			$sth->bindValue(':id',    $user_id,    PDO::PARAM_STR);
			$sth->bindValue(':token', $token_id, PDO::PARAM_STR);
			$sth->execute();
			return $sth->fetch();
		
	}

}

