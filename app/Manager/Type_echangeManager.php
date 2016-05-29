<?php

namespace Manager;
// use UserManager;
class Type_echangeManager extends  \W\Manager\Manager 
{	
	public function getTypeEchange()
		{
			$sql = "SELECT distinct(type_echange_short) FROM `type_echange` ";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll();
		}
}

