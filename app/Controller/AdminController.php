<?php

namespace Controller;

use \W\Controller\Controller;
use Outils\Outils;

class AdminController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	// public function home()
	// {

	
		// if(isset($_POST['submit'])) {

		// 	$dateCreation = date('Y-m-d' );
		// 	$m = new \Manager\UrlManager();
		// 	$code = $m ->genererUnCodeUnique($_POST['url']);
		// 	$m->insert(['urlshort'=>$code, 'urllong'=>$_POST['url'], 'date'=>$dateCreation, 'pseudo'=>$_POST['pseudo'], 'nbacces'=>1]);

		// 	// $this->show('default/home');
		// }

	// $this->show('default/home');

	// }
	// public function login()
	// {

	// 	if(isset($_POST['submit'])) 
	// 	{
	// 	 	$m = new \Manager\UtilisateurManager();
	// 	 	$email  = htmlentities(strip_tags(trim($_POST['email'])));
	// 	 	$m->isValidLoginInfo($email, $_POST['password']);
		 			
	// 	}

	// 	if(isset($_POST['inscription'])) 
	// 	{
	// 	 $this->show('default/inscription');
 	
	// 	}

		
		
	// }


	public function inscription()
	{
	

		if(isset($_POST['submit'])) 
		{
			$manager = new \Manager\UtilisateurManager();
			
 
			$erreurs = array();
			$info = array();

			//***************************************************************
			// validation des champs du formulaire inscription
			//***************************************************************

			// controle de l'email
			if(empty($_POST['email'])){
					$erreurs['email'] = 'L\'email est obligatoire';
			}
			else
			{
				$email = strip_tags(trim($_POST['email']));
				$email = filter_var($email, FILTER_SANITIZE_EMAIL);

				// le mail est-il valide

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    			{
					$erreurs['email']  = "Votre email n'est pas correct";
				}
				elseif($manager->emailExists($email))
				{
					$erreurs['email']  = "Cet email existe déjà";
				}
			}

			// controle du pseudo
			if(empty($_POST['pseudo']))
			{
				$erreurs['pseudo'] = 'Le pseudo est requis';
			}
			elseif($manager->usernameExists($strip_tags(trim($_POST['pseudo']))))
			{
				$erreurs['pseudo']  = "Ce pseudo existe déjà";
			}
			
			
			if(!empty($erreurs['pseudo'] )== "" )
		
			{
				$this->show('AdminController/inscription', ['erreurs'=>$erreurs]);
			}

			else

			{



				//***************************************************
				//	Aucune erreur dans le forumulaire	
				//***************************************************


				// on crée le nouvel utilisateur

				 $id_utilisateur=$manager->insert(['email'=>$_POST['finscription']['email'], 'password'=>password_hash($_POST['finscription']['password'],PASSWORD_DEFAULT), 'pseudo'=> $_POST['finscription']['pseudo'], "actif"=>'0', 'role'=>'user']);
				
				if($id_utilisateur)
				{
					// l'inscription a réussi, on cré un token et on envoi un email pour activer le compte
					$tok    = new \Manager\tokenManager();
					$token  = md5(uniqid(rand(), true));
					$date_validite = date("Y-m-d H:i:s" , strtotime('+1 day'));
					$tok->insert(['id_utilisateur'=>$id_utilisateur['id'], 'token'=>$token, 'date_validite'=>$date_validite]);

					$lien = "<a href=\"runrum/login?&id=" . $id_utilisateur['id'] . "&token=" . $token . "\">Lien</a>";
				 				
				 	print_r($lien); 	
				 	if(Outils::envoiMail($lien, 'yvan.lebrigand@gmail.com', $_POST['finscription']['email']))
				 	{
				 		print_r($tok);
				 	}
							
				}
			}
		}
			// $tok->redirectToRoute('inscription');

			
			$this->show('default/inscription');

	}


//************* on clique sur inscription
	
	// public function contact()
	// {
	// 	$this->show('default/contact');
	// }

	// public function find($id)
	// public function liste()
	// {
	// 	// $user = $this->getUser();
	// 	// $manager = new PostManager();
	// 	$urlliste = $m->findAll();
	// 	$this->show('default/liste', ['urlshort', 'urllong']);
	// 	// public function findAll($orderBy = "", $orderDir = "ASC", $limit = null, $offset = null)

	// 	// public function find($id)
		
	// 	// $this->show('default/liste');
	// }

	
}