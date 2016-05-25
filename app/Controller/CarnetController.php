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
				// temporaire
					$_POST['form']['utilisateur_id'] = 1;
					$_POST['form']['moyenne'] = $_POST['form']['distance']/2;
					// afin de convertir les trois champs en secondes et les enregistrer dans le champ de la base de données
					$_POST['form']['duree']= $_POST['heure']*60*60+$_POST['minute']*60+$_POST['secondes'];
					$m->insert($_POST['form']);

					// La partie Compteur 
					if ($m) {
						echo "Note enregistrer <br>";
						// Partie Kilométrage
						if ($_POST['form']['distance'] >= 10 && $_POST['form']['distance'] < 21) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 10 km ";
						}
						elseif ($_POST['form']['distance'] >= 21 && $_POST['form']['distance'] < 42.195) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 21 km ";
						}
						elseif ($_POST['form']['distance'] >= 42.195 && $_POST['form']['distance'] < 100) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 42.195 km ";
						}
						elseif ($_POST['form']['distance'] >= 100 && $_POST['form']['distance'] < 1000) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 100 km ";
						}
						elseif ($_POST['form']['distance'] == 1000) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 1000 km ";
						}
						else{

							// ne pa oublier le controlle pour savoir si il à déja eu le badge

							// Faire la somme des valeurs du champ "distance" dans la base de données
							$id= 1; // a changer ? OUI
							$k = new DistanceManager();
							$k->setTable('carnets');
							$listeCarnet = $k->getDistance($id);

							// en fonction de la base de données 

							if ($listeCarnet >= 10 && $listeCarnet < 21) {
								// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 10 km au total de vos activités ";
						}
						elseif ($listeCarnet >= 21 && $listeCarnet < 42.195) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 21 km au total de vos activités ";
						}
						elseif ($listeCarnet >= 42.195 && $listeCarnet < 100) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 42.195 km au total de vos activités ";
						}
						elseif ($listeCarnet >= 100 && $listeCarnet < 1000) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 100 km au total de vos activités ";
						}
						elseif ($listeCarnet == 1000) {
							// mettre un controlle pour savoir si le badge à était obtenu
							echo "Bravo vous obtenez un badge de 1000 km au total de vos activités ";
						}
						else{
							echo "Encore un effort, pour obtenir le prochain badge ";
						}



						
						}
						// Partie durée (temps)

					}
				}

			}

		}


		$this->show('default/creationCarnet', ['epreuves'=> $epreuves, 'exercices'=> $exercices]);
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
		$listes = $p->findAll();

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
					$_POST['form']['utilisateur_id'] = 1;
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