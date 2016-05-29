<?php
// namespace Manager;
namespace Manager;

class imageManager extends  \W\Manager\Manager 
{

	public function getPhotos()
	{
		$sql = "SELECT p.id_image , p.id_post, i.ref_image FROM echanges_images AS p INNER JOIN images AS i on(p.id_image = i.id)";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		return $sth->fetchAll();
	}

}

	