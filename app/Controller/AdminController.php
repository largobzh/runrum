<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;
use \Manager\UtilisateurManager;
use Outils\Outils;


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
					$userInfo = $manager->getUserByUsernameOrEmail($email);
					if(!$userInfo)
					{
						$msg['erreur']['email']  = "Cet email n'existe pas";
					}
					else
						
					// on controle que le compte est bien actif
					if(!$userInfo['actif'])
					{
						$msg['erreur']['email']  = "Votre compte n'a pas été activé ou a été désactivé. Merci de vous inscrire sous un autre email" ;
					}
					else

					{
						// on vérifit les mots de passe
						$mdp = htmlspecialchars(trim($_POST['form']['password']));
						if(!password_verify($mdp, $userInfo['password']))
						{
							$msg['erreur']['password']  = "Le mot de passse est incorrect !";
						}
						elseif(!$userInfo['actif'])
						{
						// on controle que le compte est bien actif
							$$msg['erreur']['email']  = "Votre compte n'a pas été activé ou a été désactivé. Merci de vous inscrire sous un autre email";
						}
						else
						{
							$msg['info']  = "Vous êtes désormais connecté !";	
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
				$msg['erreur']['pseudo'] = 'Le pseudo est requis';
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

				 $id_utilisateur=$manager->insert(['email'=>$_POST['form']['email'], 'password'=>password_hash($_POST['form']['password'],PASSWORD_DEFAULT), 'pseudo'=> $_POST['form']['pseudo'], "actif"=>'0', 'role'=>'user']);
				
				if($id_utilisateur)
				{
					// l'inscription a réussi, on crée un token et on envoi un email pour activer le compte
					$tok    = new \Manager\tokenManager();
					$token  = md5(uniqid(rand(), true));
					$date_validite = date("Y-m-d H:i:s" , strtotime('+1 day'));
					$tok->insert(['id_utilisateur'=>$id_utilisateur['id'], 'token'=>$token, 'date_validite'=>$date_validite]);
					$lien = "<a href=\"runrum/login?&id=" . $id_utilisateur['id'] . "&token=" . $token . "\">Lien</a>";
				 	$mail->Subject = 'Activer votre compte sur runrum';
									 	
				   	$subject ="Inscription à runrum";
					$body ="Bonjour, Valider votre inscription  : " .  $lien  ;
				 	if(Outils::envoiMail($lien, 'yvan.lebrigand@gmail.com', $_POST['form']['email'], $subject, $body))
				 	{

						$msg['info'] = "Vous êtes désormais inscrit sur le site. Pour activer votre compte, cliquer sur le lien dans le msg qui vous a été envoyé. ";
						
				 		$this->show('default/inscription', ['msg' => $msg]);
				 		
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
					$userInfo = $manager->getUserByUsernameOrEmail($email);
					if(!$userInfo)
					{
						$msg['erreur']['email']  = "Cet email n'existe pas";
					}
					else
					{		
					// on controle que le compte est bien actif
						if(!$userInfo['actif'])
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
				$tok->insert(['id_utilisateur'=>$userInfo['id'], 'token'=>$token, 'date_validite'=>$date_validite]);
				$lien = "<a href=\"runrum/initPassword?&id=" . $userInfo['id'] . "&token=" . $token . "\">Lien</a>";
			 		

			 	$subject ="changer votre mot de passe";
				$body ="Bonjour, changer votre mot de passe : " .  $lien  ;
				if(Outils::envoiMail($lien, 'yvan.lebrigand@gmail.com', $_POST['form']['email'], $subject, $body))
				{
					$msg['info']  = "Un mail vous a été envoyé avec un lien pour changer votre mot de passe";
					$this->show('default/oubliPassword', ['msg' => $msg]);
				}
			 	
			}
							
		}//if(isset($_POST['submit'])) 
								
		$this->show('default/oubliPassword', ['msg' => $msg]);

	} //oubliPassword



//******************************************************************************************************************************************************************	


public function reinitPassword($id)
	{
		$manager = new \Manager\UtilisateurManager();
		$msg = array();
		

		// ****************************************
		// test d du token
		// ****************************************
		$id    = $_GET['id'];
		$token = $_GET['token'];
		$tok   = new \Manager\tokenManager();
		

		$stmt = $dbh->prepare("SELECT *  FROM tokens WHERE id_utilisateur= :id and token= :token and date_validite > now()");
		$stmt->bindValue(':id',    $id,    PDO::PARAM_STR);
		$stmt->bindValue(':token', $token, PDO::PARAM_STR);

		$stmt->execute();
		$token = $stmt->fetchall(PDO::FETCH_ASSOC);
		if($token)
		{
			$flag = true ;
		}




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
					$userInfo = $manager->getUserByUsernameOrEmail($email);
					if(!$userInfo)
					{
						$msg['erreur']['email']  = "Cet email n'existe pas";
					}
					else
					{		
					// on controle que le compte est bien actif
						if(!$userInfo['actif'])
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
				$tok->insert(['id_utilisateur'=>$userInfo['id'], 'token'=>$token, 'date_validite'=>$date_validite]);
				$lien = "<a href=\"runrum/initPassword?&id=" . $userInfo['id'] . "&token=" . $token . "\">Lien</a>";
			 		

			 	$subject ="changer votre mot de passe";
				$body ="Bonjour, changer votre mot de passe : " .  $lien  ;
				if(Outils::envoiMail($lien, 'yvan.lebrigand@gmail.com', $_POST['form']['email'], $subject, $body))
				{
					$msg['info']  = "Un mail vous a été envoyé avec un lien pour changer votre mot de passe";
					$this->show('default/oubliPassword', ['msg' => $msg]);
				}
			 	
			}
							
		}//if(isset($_POST['submit'])) 
								
		$this->show('default/oubliPassword', ['msg' => $msg]);

	} //oubliPassword




}