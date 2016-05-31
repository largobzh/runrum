<?php
// namespace Manager;
namespace Manager;

class Echanges_imageManager extends  \W\Manager\Manager 
{
// tous les photos d'un post pour les supprimer	
	public function getPhotosByPostId($id)
	{
		$sql = "SELECT i.id, i.ref_image, e.id_post FROM `images` as i INNER JOIN echanges_images as e on (e.id_image = i.id)
		 WHERE e.id_post = :id ";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id',    $id);
		$sth->execute();
		return $sth->fetchAll();
	}

	// suppresion de toutes les enreg selon un post
	public function deleteEchanges_Images($id)
	{
		if (!is_numeric($id)){
			return false;
		}


		$sql = "DELETE FROM echanges_images WHERE id_post = :id";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":id", $id);
		$sth->execute();
		return $sth->execute();
	}
	// suppresion de toutes les enreg selon un post
	public function InsertEchanges_Images($id_post,$id_image)
	{
		if (!is_numeric($id_post) && !is_numeric($id_image)){
			return false;
		}


		$sql = "INSERT INTO echanges_images (id_post, id_image) VALUES ($id_post, $id_image)";
		
		$sth = $this->dbh->prepare($sql);
		return $sth->execute();
	}
}	