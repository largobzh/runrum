<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\PostManager;
use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;
use Outils\Outils;


class ForumController extends Controller
{


	// ***************************************************
	// Page d'accueil par défaut - les 20 premiers posts
	// ***************************************************
	public function forumHome()
	{
		$user = $this->getUser();
		$manager = new PostManager();
		$posts = $manager->getPosts('date_publication', 'DESC');
		$this->show('default/forumHome', ['posts' => $posts, 'user' => $user]);
	}
	public function forumPost($id)
	{
		$manager = new PostManager();
		$post = $manager->find($id);
		$this->show('default/forumPost', ['post' => $post]);
	}


	public function addPost()
	{
		$msg = array();

		// $this->allowTo('admin');
		// controle des champs obligatoires à la saisie(titre et catégorie)
		if(isset($_POST['submit'])) 
		{

			print_r($_POST);
			if(empty($_POST['form']['titre'])){
				$msg['erreur']['titre'] = 'L\'email est obligatoire';
			}
			if(empty($_POST['form']['type_echange_id'])){
				$msg['erreur']['type_echange_id'] = 'Le catégorie est obligatoire';
			}


			if(!empty($msg['erreur']))
			{
				$this->show('default/forumAddPost',['msg' => $msg]);
			}
			else
			{
				$manager = new PostManager();
				$user = $this->getUser();
				$tbNewPost = ['utilisateur_id'=>$user['id'] , 'nbvues'=>0, 'nbreponses'=>0];
				$_POST['form']['date_publication']=date('Y-m-d') ;
				$_POST['form']['type_echange_id']=1;
						
				$manager->insert(array_merge($_POST['form'],$tbNewPost));
				$this->redirectToRoute('forumhome');
			}
			
		}
		$this->show('default/forumAddPost',['msg' => $msg]);
		
	}



public function editPost($id)
	{
		// $this->allowTo('admin');
		$manager = new PostManager();
		// print_r($msg);

		$msg = array();
		if(isset($_POST['valider']))
		{

			if(empty($_POST['form']['titre'])){
				$msg['erreur']['titre'] = 'L\'email est obligatoire';
			}
			if(empty($_POST['form']['type_echange_id'])){
				$msg['erreur']['type_echange_id'] = 'Le catégorie est obligatoire';
			}


			if(!empty($msg['erreur']))
			{
				$this->show('default/forumEditPost', ['post' => $post,'msg' => $msg]);
			}
			else
			{
				$user = $this->getUser();
				$tbNewPost = ['utilisateur_id'=>$user['id'] ];
				$_POST['form']['type_echange_id']=1;
				$manager->update(array_merge($_POST['form'],$tbNewPost),$post['id']);
				$this->redirectToRoute('forumhome');
			}
			// $manager->update($_POST['myform'], $id);
			// $this->redirectToRoute('home');
		}
		$post = $manager->find($id);
		echo '<pre>';
		print_r($post);
		echo '</pre>';
		$this->show('default/forumEditPost', ['post' => $post,'msg' => $msg]);
	}
}