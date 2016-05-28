<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\PostManager;
use \Manager\ReponseManager;
use \Manager\Type_echangeManager;
use \Manager\ImageManager;
use \Manager\echanges_imageManager;


use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;
use \Eventviva\ImageResize;

use Outils\Outils;



// Constantes
define('TARGET', 'assets/img/runrum/');    // Repertoire cible pour les photos
define('MAX_SIZE', 200000);    // Taille max en octets du fichier 
define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels
 

class ForumController extends Controller
{


	// ***************************************************
	// Page d'accueil par défaut - les 20 premiers posts
	// ***************************************************
	public function forumListePosts($techange="")
	{


		
		$user = $this->getUser();

		$manager = new PostManager();
		$photos = $manager->getPhotos();
		$posts = $manager->getPosts("", 'date_publication', 'DESC', $techange);
		$type_echange_short = $manager->getTypeEchange();
		$this->show('default/forumListePosts', ['posts' => $posts, 'user' => $user, 'type_echange_short' => $type_echange_short, 'photos' =>$photos]);
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
		$image = false;

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
 		//========================================
 		// controle si on sélectionne un fichier
		//========================================
			if (is_uploaded_file($_FILES['photo']['tmp_name']))
			{

				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(strrchr($_FILES['photo']['name'], '.')  ,1)  );
				if (!in_array($extension_upload,$extensions_valides) )
				{
					$msg['erreur']['photo'] = "L'extension est invalide. ( jpg - jpeg - gif - png)";
				}


				$image_sizes = getimagesize($_FILES['photo']['tmp_name']);
				if ($image_sizes[0] > MAX_SIZE OR $image_sizes[1] > MAX_SIZE) 
				{
					$msg['erreur']['photo'] = "La taille de l'image est trop grande ";
				}
			}

//========================================
			if(!empty($msg['erreur']))
			{
				$this->show('default/forumAjouterPost',['msg' => $msg, 'type_echange' => $type_echange]);
			}
			else
			{

				// ============  gestion de l'ajout de photo ======================
		     
	          // pour une photo on en crée 2 photos 
	          	//  - 1 photo mignature : hauteur de 100  préfixe min)
	            //  - 1 photo grande : hauteur de 600  préfixe max)
          	if (is_uploaded_file($_FILES['photo']['tmp_name']))
          	{
	            $tmp_name  = $_FILES['photo']['tmp_name'];
	            $extension = pathinfo($_FILES['photo']['name'])['extension'];
	            $hash      = md5_file($_FILES['photo']['tmp_name']) ;

	            $fichierMin = "min_"."$hash.$extension"; // extension avec le point
	            $fichierMax = "max_"."$hash.$extension"; // extension avec le point
	            
				$targetMin = TARGET . $fichierMin ;
				$targetMax = TARGET . $fichierMax ;
				
	            move_uploaded_file($tmp_name, $targetMin);
	            if (file_exists($targetMin))
	            {
	            	copy($targetMin, $targetMax);
	            	$imageMin = new ImageResize($targetMin);
		            $imageMin->resizeToHeight(100 );
		            $imageMin->save($targetMin);

					$imageMax= new ImageResize($targetMax);
		            $imageMax->resizeToHeight(600 );
		            $imageMax->save($targetMax);
		            $image = true;
            	}
	        }


	        	// ajout d'un post
				$manager = new PostManager();
				$user = $this->getUser();
				print_r($user);
				$tbNewPost = ['utilisateur_id'=>$user['id'] , 'nbvues'=>0, 'nbreponses'=>0];
				$_POST['form']['date_publication']=date('Y-m-d') ;
				$lastUserId = $manager->insert(array_merge($_POST['form'],$tbNewPost));
				// ajout des images dans la table images 
				
				if($lastUserId && $image)
				{
					$managerImg = new ImageManager();
					$managerImg->setTable('images');
					$lastImgIdMin = $managerImg->insert(['ref_image'=>$targetMin]);
					$lastImgIdMax = $managerImg->insert(['ref_image'=>$targetMax]);
					// ajout lien post/images dans  echanges_imageManager
					$managerPostImg = new echanges_imageManager();
					$managerPostImg->setTable('echanges_images');
					
					$managerPostImg->insert(['id_post'=>$lastUserId['id'], 'id_image'=>$lastImgIdMin['id']]);
					$managerPostImg->insert(['id_post'=>$lastUserId['id'], 'id_image'=>$lastImgIdMax['id']]);
				}

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

	// afin de supprimer un post du forum
	public function forumSupprimerPost($id){
		$manager = new PostManager();
		$manager->setTable('posts');
		$supprimer = $manager->delete($id);
		// redirige vers la  liste des posts
		$this->redirectToRoute('forumListePosts');
	}

	// on envoie un mail aux modérateurs du forum ()
	public function forumSignalerPost($id)
	{
		$msg = array();
		if(isset($_POST['submit'])) 
		{
			if(empty($_POST['form']['raison'])){
				$msg['erreur']['raison'] = 'La raison est obligatoire à la saisie';
			}
			// la raison est obligatoire	 	
			if(!empty($msg['erreur']))
			{
				$this->show('default/forumSignalerPost',['msg' => $msg]);
			}
			else
			{
				// on récupére les infos du post signalé
				if(!empty($id))
				{
					$manager = new PostManager();
					$post = $manager->find($id);
					if($post)
					{
						$subject ="Alerte sur le forum runrum émit par : " .  $_SESSION["user"]['pseudo'] . " pour le poste : " . $id ;
						$body =   nl2br("Alerte sur le forum runrum !!  \n" );
						$body .=  nl2br("Titre du post : " . $post['titre'] . "\n");
						$body .=  nl2br("Raison du signalement  :" . $_POST['form']['raison']) . " \n";
						if(Outils::envoiMail($lien, 'yvan.lebrigand@gmail.com', 'yvan.lebrigand@gmail.com', $subject, $body))
						{
							$msg['info']  = $_SESSION["user"]['pseudo']. ", Votre message d\'alerte a bien été envoyé aux modérateurs et sera étudié." ;
							$this->redirectToRoute('forumListePosts', ['msg' => $msg]);
						}
					}
				}
			}
		}
		$this->show('default/forumSignalerPost',['msg' => $msg]);
	}
	
}