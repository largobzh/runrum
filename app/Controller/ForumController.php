<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\PostManager;
use \Manager\ReponseManager;
use \Manager\Type_echangeManager;
use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;
use Outils\Outils;



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

		// Afficher les données type-echange de la base de données dans le select
		$n = new Type_echangeManager();
		$n->setTable('Type_echange');
		$type_echange = $n->findAll();

		$manager = new PostManager();

		if(isset($_POST['submit']))
		{
		
			if(empty($_POST['form']['titre'])){
				$msg['erreur']['titre'] = 'Le titre est obligatoire';
			}
			if(empty($_POST['form']['type_echange_id'])){
				$msg['erreur']['type_echange_id'] = 'La catégorie est obligatoire';
			}


			if(!empty($msg['erreur']))
			{
				$this->show('default/forumModifierPost' , ['msg' => $msg, 'type_echange' => $type_echange, 'post'=>$post]);
			}
			else
			{
				$user = $this->getUser();
				$tbNewPost = ['utilisateur_id'=>$user['id'] ];
				$n->setTable('posts');
				$manager->update(array_merge($_POST['form'],$tbNewPost),$post['id']);
				$this->redirectToRoute('forumListePosts');
			}
			// $manager->update($_POST['myform'], $id);
			// $this->redirectToRoute('home');
		}
		$post = $manager->find($id);
		if($post)
		{
			$this->show('default/forumModifierPost' , ['msg' => $msg, 'type_echange' => $type_echange, 'post'=>$post]);
		}
		else
		{
			$msg['infos'] = 'ce post n\'existe plus';
			$this->redirectToRoute('forumListePosts');
		}
	}
}