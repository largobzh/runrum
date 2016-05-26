<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\PostManager;
use \Manager\ReponseManager;
use \Manager\Type_echangeManager;
use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;
use \Eventviva\ImageResize;
use Outils\Outils;



// Constantes
define('TARGET', 'img/runrum/');    // Repertoire cible pour les photos
define('MAX_SIZE', 100000);    // Taille max en octets du fichier 
define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels
 
// Tableaux de donnees
$tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees

class ForumController extends Controller
{


	// ***************************************************
	// Page d'accueil par défaut - les 20 premiers posts
	// ***************************************************
	public function forumListePosts($techange="")
	{


		print_r($techange);
		$user = $this->getUser();
		$manager = new PostManager();
		$posts = $manager->getPosts("", 'date_publication', 'DESC', $techange);
		$type_echange_short = $manager->getTypeEchange();
		$this->show('default/forumListePosts', ['posts' => $posts, 'user' => $user, 'type_echange_short' => $type_echange_short]);
	}
	

	// ***************************************************
	// Afficher toutes les répones du poste sélectionné dans forumListePosts
	// ***************************************************
	public function forumListeReponses($id)
	{
		$msg = array();
		$manager = new PostManager();
		$post = $manager->find($id);
		// ========================================
		// on incrémente le nombre de vues
		$post['nbvues']++; 
		$manager->update($post,$id);
		
		// ========================================

		if(isset($_POST['submit']))
		{
			if(empty($_POST['form']['reponse'])){
				$msg['erreur']['reponse'] = 'La réponse doit etre renseignée';
			}
				
			if(!empty($msg['erreur']))
			{
				// on réaffiche toutes les réponses  et le message d'erreur 
				$manager = new PostManager();
				$posts = $manager->getPosts($id, 'date_publication', 'DESC');
		
				if($posts)
				{
					$reponseManager = new ReponseManager();
					$reponses = $reponseManager->getReponses($id, 'date_publication', 'DESC');
				}

				$this->show('default/forumListeReponses', ['posts' => $posts, 'reponses'=> $reponses, 'msg' => $msg]);
			}
			else
				// on enregistre la réponse et on réaffcihe toutes les questions

			{
				$reponseManager = new ReponseManager();
				$user = $this->getUser();
				$tbNewPost = ['utilisateur_id'=>$user['id'] , 'post_id'=>$id];
				$_POST['form']['date_publication']=date('Y-m-d') ;
				$reponseManager->insert(array_merge($_POST['form'],$tbNewPost));
				$this->redirectToRoute('forumListePosts');
			}
			
		}
		else
		{
			$manager = new PostManager();
			$posts = $manager->getPosts($id, 'date_publication', 'DESC');
			if($posts)
			{
				$reponseManager = new ReponseManager();
				$reponses = $reponseManager->getReponses($id, 'date_publication', 'DESC');
			}
		
		}
		$this->show('default/forumListeReponses', ['posts' => $posts, 'reponses'=> $reponses, 'msg' => $msg]);
	}
	
	

	public function forumAjouterPost()
	{
		$msg = array();

		// Afficher les données type-echange de la base de données dans le select
		$n = new Type_echangeManager();

		$n->setTable('Type_echange');
		$type_echange = $n->findAll();
		

		if(isset($_POST['submit'])) 
		{
			if(empty($_POST['form']['titre'])){
				$msg['erreur']['titre'] = 'Le titre est obligatoire';
			}
			if(empty($_POST['form']['type_echange_id'])){
				$msg['erreur']['type_echange_id'] = 'La catégorie est obligatoire';
			}

// ============  gestion de l'ajout de photo ======================
			// if(!is_dir(TARGET))
			// {echo "le répertoire n'existe pas";}


   //        print_r($_FILES);
   //          $tmp_name  = $_FILES['photo']['tmp_name'];
   //          $extension = pathinfo($_FILES['photo']['name'])['extension'];
   //          $hash      = md5_file($_FILES['photo']['tmp_name']) ;

   //          $fichier = "$hash.$extension"; // extension avec le point
   //          echo $fichier;
   //          move_uploaded_file($tmp_name, "img/runrum/$fichier");

   //          $image = new ImageResize("img/runrum/$fichier");
   //          $image->resizeToBestFit(100, 100 );
   //          $image->saveImage("img/runrum/$fichier");

        
        



//========================================
			if(!empty($msg['erreur']))
			{
				$this->show('default/forumAjouterPost',['msg' => $msg, 'type_echange' => $type_echange]);
			}
			else
			{
				$manager = new PostManager();
				$user = $this->getUser();
				$tbNewPost = ['utilisateur_id'=>$user['id'] , 'nbvues'=>0, 'nbreponses'=>0];
				$_POST['form']['date_publication']=date('Y-m-d') ;
				// $_POST['form']['type_echange']=1;
						
				$manager->insert(array_merge($_POST['form'],$tbNewPost));
				// $this->show('default/forumHome');
				$this->redirectToRoute('forumListePosts');
			}
			
		}
		$this->show('default/forumAjouterPost',['msg' => $msg, 'type_echange' => $type_echange]);
		
	}



	public function forumModifierPost($id)
	{
		$msg = array();
		// 1. on vien de cliquer sur un post pour me modifier
		if(!isset($_POST['submit'])) 
		{
			if(!empty($id))
			{
				$manager = new PostManager();
				$post = $manager->find($id);
				if($post)
				{
					$n = new Type_echangeManager();
					$n->setTable('Type_echange');  // tous les type d echange pour la liste
					$type_echange = $n->findAll();
					$this->show('default/forumModifierPost' , ['msg' => $msg, 'type_echange' => $type_echange, 'post'=>$post]);
				}
			}
		}
		// 2. on valide le formulaire
		else
		{				
			if(empty($_POST['form']['titre'])){
				$msg['erreur']['titre'] = 'Le titre est obligatoire';
			}
			if(empty($_POST['form']['type_echange_id'])){
				$msg['erreur']['type_echange_id'] = 'La catégorie est obligatoire';
			}
			if(!empty($msg['erreur']))
			{
				$this->show('default/forumModifierPost' , ['msg' => $msg, 'type_echange' => $type_echange]);
			}
			
		// 3. on renregistre les modifications
			
			$manager = new PostManager();
			$manager->setTable('posts');
			$id =intval($_POST['form']['post_id']);

			$post = $manager->find($id);
			$post['titre'] =$_POST['form']['titre'];
			$post['post'] =$_POST['form']['post'];
			$post['type_echange_id'] =$_POST['form']['type_echange_id'];
			$manager->update($post, $id);
			$this->redirectToRoute('forumListePosts');
			
		}
		
	}

	public function check_extension($extension, $liste)
	{
    	return in_array(explode('/',$extension)[1], $liste);
	}

		
	
}