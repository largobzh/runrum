<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Manager\Manager;
use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;
use \Manager\UtilisateurManager;
use \Manager\TokenManager;
use Outils\Outils;

define("actif", 1);
define("inactif", 0);

class AdminController extends Controller
{

	public function login()
	{
		$manager = new UtilisateurManager();
		$msg = array();
		
		if(isset($_POST['submit'])) 
		{

			// on verifie si l'email est valide
			if(empty($_POST['form']['email']))
			{
				$msg['erreur']['email'] = 'L\'email est obligatoire';
			}
			else
			{
				$email = strip_tags(trim($_POST['form']['email']));
				$email = filter_var($email, FILTER_SANITIZE_EMAIL);

				// le mail est-il valide ?

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
				{
					$msg['erreur']['email']  = "Votre email n'est pas correct";
				}
				else
				{ 
					// récupére les infos de l'utilisateur
					$user = $manager->getUserByUsernameOrEmail($email);
					if(!$user)
					{
						$msg['erreur']['email']  = "Cet email n'existe pas";
					}
					else
						
					// on controle que le compte est bien actif
						if(!$user['actif'])
						{
							$msg['erreur']['email']  = "Votre compte n'a pas été activé ou a été désactivé. Merci de vous inscrire sous un autre email" ;
						}
						else

						{
						// on vérifit les mots de passe
							$mdp = htmlspecialchars(trim($_POST['form']['password']));
							if(!password_verify($mdp, $user['password']))
							{
								$msg['erreur']['password']  = "Le mot de passse est incorrect !";
							}
							elseif(!$user['actif'])
							{
						// on controle que le compte est bien actif
								$$msg['erreur']['email']  = "Votre compte n'a pas été activé ou a été désactivé. Merci de vous inscrire sous un autre email";
							}
							else
							{
								$_SESSION["user"]['id'] = $user['id'];
								$_SESSION["user"]['email'] = $user['email'];
								$_SESSION["user"]['pseudo'] = $user['pseudo'];
								$msg['info']  = "Vous êtes désormais connecté !";	
								$this->show('default/home',['msg' => $msg]);
								$this->redirectToRoute('home');

							}
						} 
				} // le mail est-il valide

			} // on verifie si l'eamil est valide

		} //if(isset($_POST['submit'])) 

		$this->show('default/login',['msg' => $msg]);
	}

//******************************************************************************************************************************************************************
//******************************************************************************************************************************************************************
//******************************************************************************************************************************************************************	

	public function inscription()
	{
		$manager = new \Manager\UtilisateurManager();
		$msg = array();
		

		if(isset($_POST['submit'])) 
		{

			//***************************************************************
			// validation des champs du formulaire inscription
			//***************************************************************

			// controle de l'email

			
			if(empty($_POST['form']['email'])){
				$msg['erreur']['email'] = 'L\'email est obligatoire';
			}
			else
			{
				$email = strip_tags(trim($_POST['form']['email']));
				$email = filter_var($email, FILTER_SANITIZE_EMAIL);

				// le mail est-il valide
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
				{
					$msg['erreur']['email']  = "Votre email n'est pas correct";
				}
				elseif($manager->emailExists($email))
				{
					$msg['erreur']['email']  = "Cet email existe déjà";
				}
				
			}

			// controle du pseudo
			if(empty($_POST['form']['pseudo']))
			{
				$msg['erreur']['pseudo'] = 'Le pseudo est obligatoire';
			}
			elseif($manager->usernameExists(strip_tags(trim($_POST['form']['pseudo']))))
			{
				$msg['erreur']['pseudo']  = "Ce pseudo existe déjà";
			}
			
			
			if(!empty($msg['erreur']))
			{
				$this->show('default/inscription', ['msg' => $msg]);
			}
			else
			{

				//***************************************************
				//	Aucune msg dans le forumulaire	
				//***************************************************

				// on crée le nouvel utilisateur

				$id_utilisateur=$manager->insert(['email'=>$_POST['form']['email'], 'password'=>password_hash($_POST['form']['password'],PASSWORD_DEFAULT), 'pseudo'=> $_POST['form']['pseudo'], "actif"=> actif, 'role'=>'user']);
				
				if($id_utilisateur)
				{
					// l'inscription a réussi, on crée un token et on envoi un email pour activer le compte
					$tok    = new \Manager\tokenManager();
					$token  = md5(uniqid(rand(), true));
					$date_validite = date("Y-m-d H:i:s" , strtotime('+1 day'));
					$tok->insert(['id_utilisateur'=>$id_utilisateur['id'], 'token'=>$token, 'date_validite'=>$date_validite]);
					$lien = "<a href=\"runrum/login?&id=" . $id_utilisateur['id'] . "&token=" . $token . "\">Lien</a>";
					$subject = 'Activer votre compte sur runrum';

					$subject ="Inscription à runrum";
					$body ="Bonjour, Valider votre inscription  : " .  $lien  ;
					if(Outils::envoiMail($lien, 'yvan.lebrigand@gmail.com', $_POST['form']['email'], $subject, $body))
					{

						$msg['info'] = "Vous êtes désormais inscrit sur le site. Pour activer votre compte, cliquer sur le lien dans le msg qui vous a été envoyé. ";
												
						// $this->show('default/home',['msg' => $msg]);
					$this->redirectToRoute('activerCompte', ['user_id' => $id_utilisateur['id'],  'token_id' =>$token] );
						
				
					}

				}
			}
		} //if(isset($_POST['submit']))

		$this->show('default/inscription', ['msg' => $msg]);

	} //public function inscription()

//******************************************************************************************************************************************************************
//******************************************************************************************************************************************************************
//******************************************************************************************************************************************************************	


	public function oubliPassword()
	{
		$manager = new \Manager\UtilisateurManager();
		$msg = array();
		

		if(isset($_POST['submit'])) 
		{

			//***************************************************************
			// validation des champs du formulaire inscription
			//***************************************************************

			// controle de l'email
			if(empty($_POST['form']['email'])){
				$msg['erreur']['email'] = 'L\'email est obligatoire';
			}
			else
			{
				$email = strip_tags(trim($_POST['form']['email']));
				$email = filter_var($email, FILTER_SANITIZE_EMAIL);

				// le mail est-il valide
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
				{
					$msg['erreur']['email']  = "Votre email n'est pas correct";
				}
				else
				{
					$user = $manager->getUserByUsernameOrEmail($email);
					if(!$user)
					{
						$msg['erreur']['email']  = "Cet email n'existe pas";
					}
					else
					{		
					// on controle que le compte est bien actif
						if(!$user['actif'])
						{
							$msg['erreur']['email']  = "Votre compte n'a pas été activé ou a été désactivé. Merci de vous inscrire sous un autre email" ;
						}
					}
				}
			}
			
			if(!empty($msg['erreur']))
			{
				$this->show('default/oubliPassword', ['msg' => $msg]);
			}
			else
			{

				//***************************************************
				//	on envoie un email pour pouvoir changer son mot de passe
				//***************************************************

				$tok   = new \Manager\tokenManager();
				$token  = md5(uniqid(rand(), true));
				$date_validite = date("Y-m-d H:i:s" , strtotime('+1 day'));
				$tok->insert(['id_utilisateur'=>$user['id'], 'token'=>$token, 'date_validite'=>$date_validite]);
				$lien = "<a href=\"runrum/initPassword?&id=" . $user['id'] . "&token=" . $token . "\">Lien</a>";


				$subject ="changer votre mot de passe";
				$body ="Bonjour, changer votre mot de passe : " .  $lien  ;
				if(Outils::envoiMail($lien, 'yvan.lebrigand@gmail.com', $_POST['form']['email'], $subject, $body))
				{
					$msg['info']  = "Un mail vous a été envoyé avec un lien pour changer votre mot de passe";
					// $this->show('default/home',['msg' => $msg]);

					$this->redirectToRoute('reinitPassword', ['user_id' => $user['id'],  'token_id' =>$token] );

				}

			}

		}//if(isset($_POST['submit'])) 

		$this->show('default/oubliPassword', ['msg' => $msg]);

	} //oubliPassword


//***************************************************************************************************************************************
// après oubliPassword, un mail est envoyé.
// on arrive ici pour changer son mot de passe.
//***************************************************************************************************************************************

	public function reinitPassword($user_id, $token_id )
	{
			$tok    = new \Manager\tokenManager();
			// on controle l'id du user et l'id du token
			if(!empty($user_id) && !empty($token_id))
			{
				$tokenInfo=($tok->findToken($user_id, $token_id ));
				if($tokenInfo)
				{
					 $this->show('default/reinitPasswordForm', ['user_id' => $user_id]);
					// $this->redirectToRoute('reinitPasswordForm');
				}
				// aucun token récen de trouvé
				else
				{
					$msg['erreur']['email']  = "Ce lien est périmé, veuillez reesayer";
					$this->show('default/oubliPassword');
				}
			}
			$msg['erreur']['email']  = "Ce lien n'est pas valide";
			$this->show('default/home');
		}
		



//***************************************************************************************************************************************
// après oubliPassword, un mail est envoyé.
// on arrive ici pour changer son mot de passe.
//***************************************************************************************************************************************

	public function reinitPasswordForm()
	{

		if(isset($_POST['submit'])) 
		{
			$manager = new \Manager\UtilisateurManager();
			$tok    = new \Manager\tokenManager();
			$msg = array();
			
		
				
			//***************************************************************
			// validation des champs du formulaire inscription
			//***************************************************************

			// controle de l'email
				$password      = htmlentities(strip_tags(trim($_POST['form']['password'])));
				$confPassword  = htmlentities(strip_tags(trim($_POST['form']['confPasswsord'])));


				if(empty($_POST['form']['Password'])){
					$msg['erreur']['password'] = 'Le mot de passe est obligatoire';
				}
				if(empty($_POST['form']['confPassword'])){
					$msg['erreur']['confPassword'] = 'Le mot de passe est obligatoire';
				}
				
				if($password !== $confPassword)
				{
					$msg['erreur']['Password']     = 'Vos mots de passe sont différents';
					$msg['erreur']['confPassword'] = 'Vos mots de passe sont différents';
				}
				
									

				if(!empty($msg['erreur']))
				{
					$this->show('default/reinitPasswordForm', ['msg' => $msg]);
				}
				else

				// ****************************************
				// mise à jour du mot de passe dans la table utilisateurs
				// ****************************************
				{
					setTable('utilisateurs');
					$user_id= intval($_POST['form']['user_id']);
					if($manager->find($user_id))
					{
						$user = $manager->update(['password' => $password_hash($password,PASSWORD_DEFAULT)], $user_id);
								
						if($user)
						{
							// =============================
							// on supprime le token correspondant 
							// =============================
							setTable('tokens');
							$tokenInfo=($tok->findToken($user_id, $token_id ));
							if($tokenInfo)
							{
								$manager->delete($tokenInfo['id']);
								$msg['info']  = "Votre mot de passe a été changé avec succès";

								$_SESSION["user"]['id']     = $user['id'];
								$_SESSION["user"]['email']  = $user['email'];
								$_SESSION["user"]['pseudo'] = $user['pseudo'];
								
								$msg['info']  = "Vous êtes désormais connecté !";
								$this->show('default/home', ['msg' => $msg]);

							}
							// =============================

						}
						else
						{
							$msg['info'] = "Incident 1 !!  Un pobleme est survenut durant la mise à jour de votre mot de passe";
							$this->show('default/reinitPasswordForm', ['msg' => $msg]);
						}
					}
					else // l'ID utilisateur est introuvable
					{
						$msg['info'] = "Incident 2 !!  Un pobleme est survenut durant la mise à jour de votre mot de passe";
						$this->show('default/reinitPasswordForm', ['msg' => $msg]);
					}	
				}
					

			}//if(isset($_POST['submit'])) 

			
		$this->show('default/oubliPassword', ['msg' => $msg]);
	} //oubliPassword


//***************************************************************************************************************************************
// après une inscription au site , un mail est envoyé.
// on arrive ici pour activer le compte (champ 'actif' de la table utilisateur à 1 ) 
//***************************************************************************************************************************************



	public function activerCompte($user_id, $token_id )
	{
		
		$manager = new \Manager\UtilisateurManager();
		$tok    = new \Manager\tokenManager();
		$msg = array();


	// on controle l'id du user et l'id du token
		if(!empty($user_id) && !empty($token_id))
		{
		//***************************************************************
		// on active le compte utilisateur
		//***************************************************************

			$manager->setTable('utilisateurs');
			if($manager->find($user_id))
			{
				$user = $manager->update(['actif' => actif], $user_id);
				if($user)
				{
					// =============================
					// on supprime le token correspondant 
					// =============================
					$manager->setTable('tokens');

					$tokenInfo=($tok->findToken($user_id, $token_id ));
					if($tokenInfo)
					{
						$manager->delete($tokenInfo['id']);
						$msg['info']  = "Votre compte a été activé  avec succès";
						$_SESSION["user"]['id']     = $user['id'];
						$_SESSION["user"]['email']  = $user['email'];
						$_SESSION["user"]['pseudo'] = $user['pseudo'];
						$this->show('default/home', ['msg' => $msg]);
					}
					// =============================

					else
					{
						$msg['info'] = "Incident 1 !! Un poblème est survenut durant l\'activation de votre compte.Merci de vous réinscrire";
						$this->show('default/home', ['msg' => $msg]);
					}
				}
				else // l'ID utilisateur est introuvable
				{
					$msg['info'] = "Incident 2 !! Un poblème est survenut durant l\'activation de votre compte.Merci de vous réinscrire";
					$this->show('default/home', ['msg' => $msg]);
				}	
			}
					
		}

			$this->show('default/home', ['msg' => $msg]);
	} 

}