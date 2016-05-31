<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\CarnetManager;
use \Manager\EpreuveManager;
use \Manager\ExerciceManager;
use \Manager\AfficheCarnetManager;
use \Manager\ModifierCarnetManager;
use \Manager\SupprimerCarnetManager;
use \Manager\DistanceManager;

class CarnetController extends Controller
{
	// afin d'afficher la page creation carnet
	public function creationCarnet(){

		$alert = "";
		$noalert= "";
		$alurt = "";
		$noalurt = "";


		// Afin d'afficher les données Epreuves de la base de données dans le select
		$n = new EpreuveManager();
		$n->setTable('type_epreuve');
		$epreuves = $n->findAll();

		// afin d'afficher les données Exercice de la base de données dans le select
		$h= new ExerciceManager();
		$h->setTable('type_exercice');
		$exercices = $h->findAll();

		// Afin d'enregistrer les données entrer 
		if (isset($_POST['submit'])) {
			// var_dump($_POST['form']);
			// die();
			$erreur = False;
			if (empty($_POST['form']['datenote']) || empty($_POST['form']['heuredepart']) || empty($_POST['form']['distance']) || empty($_POST['heure'])  || empty($_POST['minute'])  || empty($_POST['secondes'])  || empty($_POST['form']['lieu']) || empty($_POST['form']['conditionmeteo']) || empty($_POST['form']['commentaire'])) {
				
				foreach($_POST['form'] as $key => $value){
					if ($key == "submit") {
						continue;
					}
					if(empty($value)){
						echo "le champs ".$key." est obligatoire ! </br>";
						$erreur = True;

					}
				}
			} 
			else {
				if (!is_numeric($_POST['heure']) || !is_numeric($_POST['minute']) || !is_numeric($_POST['secondes']) || !is_numeric($_POST['form']['distance'])) {

					if (!is_numeric($_POST['form']['heure']) || !is_numeric($_POST['form']['minute']) || !is_numeric($_POST['form']['secondes'])) {
						echo "Le champs 'durée' n'est pas ecrit sous forme de chiffre !<br> ";

					} 
					if(!is_numeric($_POST['form']['distance'])){
						echo "Le champs 'distance effectué' n'est pas ecrit sous forme de chiffre ! ";
					}
				}

				else{
					
					$m = new CarnetManager();
				// Enregistrement de note avec l'id de l'utilisateur 
					$_POST['form']['utilisateur_id'] = $_SESSION["user"]['id'];
					$_POST['form']['moyenne'] = $_POST['form']['distance']/2;
					// afin de convertir les trois champs en secondes et les enregistrer dans le champ de la base de données
					$_POST['form']['duree']= $_POST['heure']*60*60+$_POST['minute']*60+$_POST['secondes'];
					$m->insert($_POST['form']);

					// La partie Compteur 
					if ($m) {
						

						// Partie Kilométrage
						
							// ne pa oublier le controlle pour savoir si il à déja eu le badge
						$util= $_SESSION["user"]['id'];
							//  somme des valeurs du champ "distance" dans la base de données  
						$k = new DistanceManager();
						$k->setTable('carnets');
						$listeCarnet = $k->getDistance($util);



						if ($listeCarnet["SUM(distance)"] >= 10 && $listeCarnet["SUM(distance)"] < 21) {
								// mettre un controlle pour savoir si le badge à était obtenu



								// recherche du badge
							$badge = 10;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$compteur = $compt->finder($badge);

								// Verifier si l'utilisateur a déja obtenu ce badge
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opt = $optention->findcontro($compteur["id"],$_SESSION["user"]['id']);

							if ($opt == True) {
								$noalert = "Note enregistrée, Vous avez déjà obtenu le badge $badge km";
							} else{

								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$compteur["id"]);
								$alert = "Note enregistrée, Bravo vous obtenez un badge de 10 km au total de vos activités ";

								// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 10  Kilomètres au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Kilomètres";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$posta = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);
							}

						}
						elseif ($listeCarnet["SUM(distance)"] >= 21 && $listeCarnet["SUM(distance)"] < 42) {
							// mettre un controlle pour savoir si le badge à était obtenu

								// recherche du badge
							$badge = 21;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$compteur = $compt->finder($badge);

							// Verifier si l'utilisateur a déja obtenu ce badge
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opt = $optention->findcontro($compteur["id"],$_SESSION["user"]['id']);

							if ($opt == True) {
								$noalert = "Note enregistrée, Vous avez déjà obtenu le badge $badge km";
							} else{

								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$compteur["id"]);
								$alert = "Note enregistrée, Bravo vous obtenez un badge de 21 km au total de vos activités ";

								// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 21 Kilomètres au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Kilomètres";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$posta = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);
							}
						}
						elseif ($listeCarnet["SUM(distance)"] >= 42 && $listeCarnet["SUM(distance)"] < 100) {
							// mettre un controlle pour savoir si le badge à était obtenu

								// recherche du badge
							$badge = 42;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$compteur = $compt->finder($badge);

							// Verifier si l'utilisateur a déja obtenu ce badge
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opt = $optention->findcontro($compteur["id"],$_SESSION["user"]['id']);

							if ($opt == True) {
								$noalert = "Note enregistrée, Vous avez déjà obtenu le badge $badge km";
							} else{


								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$compteur["id"]);
								$alert = "Note enregistrée, Bravo vous obtenez un badge de 42 km au total de vos activités ";

								// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 42 Kilométres au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Kilomètres";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$posta = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);
							}
						}
						elseif ($listeCarnet["SUM(distance)"] >= 100 && $listeCarnet["SUM(distance)"] < 1000) {
							// mettre un controlle pour savoir si le badge à était obtenu

								// recherche du badge
							$badge = 100;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$compteur = $compt->finder($badge);

							// Verifier si l'utilisateur a déja obtenu ce badge
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opt = $optention->findcontro($compteur["id"],$_SESSION["user"]['id']);

							if ($opt == True) {
								$noalert = "Note enregistrée, Vous avez déjà obtenu le badge $badge km";
							} else{

								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$compteur["id"]);
								$alert = "Note enregistrée, Bravo vous obtenez un badge de 100 km au total de vos activités ";

									// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 100 Kilomètres au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Kilomètres";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$posta = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);
							}
						}
						elseif ($listeCarnet["SUM(distance)"] == 1000) {
							// mettre un controlle pour savoir si le badge à était obtenu

								// recherche du badge
							$badge = 1000;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$compteur = $compt->finder($badge);

							// Verifier si l'utilisateur a déja obtenu ce badge
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opt = $optention->findcontro($compteur["id"],$_SESSION["user"]['id']);

							if ($opt == True) {
								$noalert = "Note enregistrée, Vous avez déjà obtenu le badge $badge km";
							} else{

								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$compteur["id"]);
								$alert = "Note enregistrée, Bravo vous obtenez un badge de 1000 km au total de vos activités ";

									// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 1000 Kilomètres au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Kilomètres";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$posta = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);
								
							}
						}
						else{
							$noalert = "Note enregistrée. Encore un effort. pour obtenir le prochain badge Kilomètres, Vous avais couru ".$listeCarnet["SUM(distance)"]." Km au total";
						}




						
						// Partie durée (temps) *******************************************************

						//  somme des valeurs du champ "duree" dans la base de données  
						$k = new DistanceManager();
						$k->setTable('carnets');
						$listeCarnets = $k->getDuree($util);



						if ($listeCarnets["SUM(duree)"] >= 60 && $listeCarnets["SUM(duree)"] < 120) {
								// mettre un controlle pour savoir si le badge à était obtenu



								// recherche du badge
							$badge = 60;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$duree = $compt->finder($badge);

								// Verifier si l'utilisateur a déja obtenu ce badge
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opts = $optention->findcontro($duree["id"],$_SESSION["user"]['id']);

							if ($opts == True) {
								$noalurt = "Note enregistrée, Vous avez déjà obtenu le badge 1 heure";
							} else{

								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$duree["id"]);
								$alurt = "Note enregistrée, Bravo vous obtenez un badge de 1 heure au total de vos activités ";

								// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 1 heure au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Durée";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$postb = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);
							}

						}
						elseif ($listeCarnets["SUM(duree)"] >= 120 && $listeCarnets["SUM(duree)"] < 180) {
							// mettre un controlle pour savoir si le badge à était obtenu

								// recherche du badge
							$badge = 120;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$duree = $compt->finder($badge);

							// Verifier si l'utilisateur a déja obtenu ce badge
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opts = $optention->findcontro($duree["id"],$_SESSION["user"]['id']);

							if ($opts == True) {
								$noalurt = "Note enregistrée, Vous avez déjà obtenu le badge 2 heures";
							} else{

								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$duree["id"]);
								$alurt = "Note enregistrée, Bravo vous obtenez un badge de 2 heures au total de vos activités ";

								// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 2 heures au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Durée";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$postb = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);

							}
						}
						elseif ($listeCarnets["SUM(duree)"] >= 180 && $listeCarnets["SUM(duree)"] < 360) {
							// mettre un controlle pour savoir si le badge à était obtenu

								// recherche du badge
							$badge = 180;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$duree = $compt->finder($badge);

							// Verifier si l'utilisateur a déja obtenu ce badge
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opts = $optention->findcontro($duree["id"],$_SESSION["user"]['id']);

							if ($opts == True) {
								$noalurt = "Note enregistrée, Vous avez déjà obtenu le badge 3 heures";
							} else{


								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$duree["id"]);
								$alurt = "Note enregistrée, Bravo vous obtenez un badge de 3 heures au total de vos activités ";

								// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 3 heures au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Durée";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$postb = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);
							}
						}
						elseif ($listeCarnets["SUM(duree)"] == 360 ) {
							// mettre un controlle pour savoir si le badge à était obtenu

								// recherche du badge
							$badge = 100;
								// afficher les données du compteur en fonction du badge rechercher
							$compt = new DistanceManager();
							$duree = $compt->finder($badge);

							// Verifier si l'utilisateur a déja obtenu ce badge duree
							$optention = new DistanceManager();
							$optention->setTable('notes_compteurs');
							$opts = $optention->findcontro($duree["id"],$_SESSION["user"]['id']);

							if ($opts == True) {
								$noalurt = "Note enregistrée, Vous avez déjà obtenu le badge 6 heures";
							} else{

								// enregistre le badge obtenu pour chaque utilisateur
								// Permet d'enregistrer dans le (note)user_compteur
								$u = new DistanceManager();
								$u->setTable('notes_compteurs');
								$compte = $u->inserter($_SESSION["user"]['id'],$duree["id"]);
								$alurt = "Note enregistrée, Bravo vous obtenez un badge de 6 heures au total de vos activités ";

								// afin de poster le badge dans le forum

								$utilisateur = $_SESSION["user"]['id'];
								$type_echange = 2;
								$post = "Bravo, ".$_SESSION["user"]['pseudo']." obtient un badge de 6 heures au total de ses activités";
								$date_pub = date('Y-m-d');
								$titre = "Badge Durée";


								$bg = new DistanceManager();
								$bg->setTable('posts');
								$postb = $bg->insertu($utilisateur, $type_echange, $post, $date_pub, $titre);
							}
						}
						
						else{
							$total = $listeCarnets["SUM(duree)"]; //ton nombre de secondes 


							$heure = intval(abs($total / 3600)); 


							$total = $total - ($heure * 3600); 


							$minute = intval(abs($total / 60)); 


							$total = $total - ($minute * 60); 


							$seconde = $total; 
							$noalurt = "Note enregistrée. Encore un effort. pour obtenir le prochain badge Durée, Vous êtes à ".$heure." heure(s) ".$minute." minute(s) ".$seconde." secondes de sport total";
						}

					}
				}

			}

		}

		
		$this->show('default/creationCarnet', ['epreuves'=> $epreuves, 'exercices'=> $exercices,'alert'=>$alert, 'noalert'=>$noalert, 'alurt'=>$alurt, 'noalurt'=>$noalurt]);
	}

// *****************************************************************************



	// afin d'afficher la page afficher carnet
	public function afficherCarnet(){


	// afficher l'intituler de l'epreuve correspondante à chaque note du carnet enregistrer dans la base
		$c = new AfficheCarnetManager();
		$c->setTable('type_epreuve');
		$epreuves = $c->findAll();

	// afficher l'intituler de l'exercice correspondant à chaque note du carnet enregistrer dans la base
		$r = new AfficheCarnetManager();
		$r->setTable('type_exercice');
		$exercices = $r->findAll();

	// Afficher toute la liste des carnets enregistrer dans la base de données
		$p = new AfficheCarnetManager();
		$p->setTable('carnets');
		$listes = $p->trouvAll();

		$this->show('default/afficherCarnet', ['listes'=> $listes, 'epreuves'=> $epreuves, 'exercices'=> $exercices]);
	}

	// afin d'afficher la page modifier carnet
	public function modifierCarnet($id){

	// Afin d'afficher les données Epreuves de la base de données dans le select
		$n = new EpreuveManager();
		$n->setTable('type_epreuve');
		$epreuves = $n->findAll();

		// afin d'afficher les données Exercice de la base de données dans le select
		$h= new ExerciceManager();
		$h->setTable('type_exercice');
		$exercices = $h->findAll();

		// Recuperer les données dans la base en fonction de l'id
		$p = new AfficheCarnetManager();
		$p->setTable('carnets');
		$contenues = $p->find($id);

		// ******
		if (isset($_POST['submit'])) {
			// var_dump($_POST['form']);
			// die();

			$erreur = False;
			if (empty($_POST['form']['datenote']) || empty($_POST['form']['heuredepart']) || empty($_POST['form']['distance']) ||  empty($_POST['form']['lieu']) || empty($_POST['form']['conditionmeteo']) || empty($_POST['form']['commentaire'])) {
				echo "la<br>";
				foreach($_POST['form'] as $key => $value){
					echo "$key --> $value<br>";
					
					if(empty($value)){
						echo "le champs ".$key." est obligatoire ! </br>";
						$erreur = True;

					}
				}
			} 
			else {
				if (!is_numeric($_POST['heure']) || !is_numeric($_POST['minute']) || !is_numeric($_POST['secondes']) || !is_numeric($_POST['form']['distance'])) {

					if (!is_numeric($_POST['form']['heure']) || !is_numeric($_POST['form']['minute']) || !is_numeric($_POST['form']['secondes'])) {
						echo "Le champs 'durée' n'est ecrit sous forme de chiffre !<br> ";

					} 
					if(!is_numeric($_POST['form']['distance'])){
						echo "Le champs 'distance effectué' n'est ecrit sous forme de chiffre ! ";
					}
				}

				else{


					$d = new ModifierCarnetManager();
				// temporaire
					$_POST['form']['utilisateur_id'] = $_SESSION["user"]["id"];
					$_POST['form']['moyenne'] = $_POST['form']['distance']/2;
					// afin de convertir les trois champs en secondes et les enregistrer dans le champ de la base de données
					$_POST['form']['duree']= $_POST['heure']*60*60+$_POST['minute']*60+$_POST['secondes'];
					$d->setTable('carnets');
					$d->update($_POST['form'],$id);


					if ($d) {
						$this->redirectToRoute('afficherCarnet');
					}
					else{
						echo "Erreur";
					}
				}

			}

		}

		// ******

		$this->show('default/modifierCarnet', ['contenues'=> $contenues, 'epreuves'=> $epreuves, 'exercices'=> $exercices]);
	}

	// afin de supprimer une note du carnet
	public function supprimerCarnet($id){

		$manager = new SupprimerCarnetManager();
		$manager->setTable('carnets');
		$supprimer = $manager->delete($id);
		// redirige vers la page carnet
		$this->redirectToRoute('afficherCarnet');
	}

}