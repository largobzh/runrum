<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\PostManager;
use \Manager\Type_echangeManager;
use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;
use Outils\Outils;



class ForumController extends Controller
{


	// ***************************************************
	// Page d'accueil par défaut - les 20 premiers posts
	// ***************************************************
	public function forumListePosts()
	{
		$user = $this->getUser();
		$manager = new PostManager();
		$posts = $manager->getPosts('date_publication', 'DESC');
		
		$this->show('default/forumListePosts', ['posts' => $posts, 'user' => $user]);
	}
	public function forumPost($id)
	{
		$manager = new PostManager();
		$post = $manager->find($id);
		$this->show('default/forumPost', ['post' => $post]);
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

			print_r($_POST);
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
			print_r($_POST);

			if(empty($_POST['form']['titre'])){
				$msg['erreur']['titre'] = 'Le titre est obligatoire';
			}
			if(empty($_POST['form']['type_echange'])){
				$msg['erreur']['type_echange'] = 'La catégorie est obligatoire';
			}


			if(!empty($msg['erreur']))
			{
				$this->show('default/forumModifierPost' , ['msg' => $msg, 'type_echange' => $type_echange, 'post'=>$post]);
			}
			else
			{
				$user = $this->getUser();
				$tbNewPost = ['utilisateur_id'=>$user['id'] ];
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