<?php
// namespace Manager;


namespace Manager;

class AfficheCarnetManager extends  \W\Manager\Manager 
{

public function trouvAll($orderBy = "", $orderDir = "DESC", $limit = null, $offset = null)
	{

		$sql = "SELECT * FROM carnets GROUP BY id DESC";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
	}

}