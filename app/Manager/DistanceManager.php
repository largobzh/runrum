<?php
// namespace Manager;


namespace Manager;

class DistanceManager extends  \W\Manager\Manager 
{

	public function getDistance($id){
		// Afin de 
		$sql="SELECT sum(distance) FROM carnets WHERE utilisateur_id ='".$id."' ";
		$mht = $this->dbh->prepare($sql);
		$mht->execute();
	}

}